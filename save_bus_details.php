<?php 
 
 //Constants for database connection
 define('DB_HOST','localhost');
 define('DB_USER','root');
 define('DB_PASS','');
 define('DB_NAME','autobus');
 
 //We will upload files to this folder
 //So one thing don't forget, also create a folder named uploads inside your project folder i.e. MyApi folder
 define('UPLOAD_PATH', 'uploads/');
 
 //connecting to database 
 $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Unable to connect');
 
 
 //An array to display the response
 $response = array();
 
 //if the call is an api call 
 if(isset($_GET['apicall'])){
 
 //switching the api call 
 switch($_GET['apicall']){
 
 //if it is an upload call we will upload the image
 case 'uploadpic':
 
 //first confirming that we have the image and tags in the request parameter
 if(isset($_FILES['pic']['name']) 
 && isset($_POST['bus_number'])
 && isset($_POST['bus_total_seats'])
 && isset($_POST['bus_available_seats'])
 && isset($_POST['bus_from'])
 && isset($_POST['bus_to'])
 && isset($_POST['bus_leaving_time'])
 && isset($_POST['bus_reaching_time'])
 && isset($_POST['bus_driver_name'])
 && isset($_POST['bus_ticketchecker_name'])
 && isset($_POST['bus_rating'])
 && isset($_POST['bus_break_time'])
 && isset($_POST['bus_company'])
 && isset($_POST['day'])
 ){
 
 //uploading file and storing it to database as well 
 try{
 move_uploaded_file($_FILES['pic']['tmp_name'], UPLOAD_PATH . $_FILES['pic']['name']);
 $stmt = $conn->prepare("INSERT INTO bus_detail (bus_image, bus_number, bus_total_seats
 ,bus_available_seats,bus_from,bus_to,bus_leaving_time,bus_reaching_time
 ,bus_driver_name,bus_ticketchecker_name,bus_rating,bus_break_time
 ,bus_company,day) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
 $stmt->bind_param("ssssssssssssss"
 ,$_FILES['pic']['name']
 ,$_POST['bus_number']
 ,$_POST['bus_total_seats']
 ,$_POST['bus_available_seats']
 ,$_POST['bus_from']
 ,$_POST['bus_to']
 ,$_POST['bus_leaving_time']
 ,$_POST['bus_reaching_time']
 ,$_POST['bus_driver_name']
 ,$_POST['bus_ticketchecker_name']
 ,$_POST['bus_rating']
 ,$_POST['bus_break_time']
 ,$_POST['bus_company']
 ,$_POST['day']
);
 if($stmt->execute()){
 $response['error'] = false;
 $response['message'] = 'Data Uploaded Successfully';
 }else{
 throw new Exception("Could not upload file");
 }
 }catch(Exception $e){
 $response['error'] = true;
 $response['message'] = 'Could not upload file';
 }
 
 }else{
 $response['error'] = true;
 $response['message'] = "Required params not available";
 }
 
 break;
 
 //in this call we will fetch all the images 
 case 'getpics':
 
 //getting server ip for building image url 
 $server_ip = gethostbyname(gethostname());
 
 //query to get images from database
 $stmt = $conn->prepare("SELECT bus_image, tags, name FROM bus_detail");
 $stmt->execute();
 $stmt->bind_result( $image, $tags, $name);
 
 $images = array();
 
 //fetching all the images from database
 //and pushing it to array 
 while($stmt->fetch()){
 $temp = array();
 $temp['image'] = 'http://' . $server_ip . '/AutoBus/'. UPLOAD_PATH . $image; 
 $temp['tags'] = $tags; 
 $temp['name'] = $name; 

 
 array_push($images, $temp);
 }
 
 //pushing the array in response 
 $response['error'] = false;
 $response['images'] = $images; 
 break; 
 
 default: 
 $response['error'] = true;
 $response['message'] = 'Invalid api call';
 }
 
 }else{
 header("HTTP/1.0 404 Not Found");
 echo "<h1>404 Not Found</h1>";
 echo "The page that you have requested could not be found.";
 exit();
 }
 
 //displaying the response in json 
 header('Content-Type: application/json');
 echo json_encode($response);

 ?>