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
				if(isset($_FILES['qrpic']['name']) && isset($_POST['code'])){
					
					//uploading file and storing it to database as well 
					try{
						move_uploaded_file($_FILES['qrpic']['tmp_name'], UPLOAD_PATH . $_FILES['qrpic']['name']);
						$stmt = $conn->prepare("INSERT INTO ticket_details (ticket_qr, ticket_code) VALUES (?,?)");
						$stmt->bind_param("ss", $_FILES['qrpic']['name'],$_POST['code']);
						if($stmt->execute()){
							$response['error'] = false;
							$response['message'] = 'File uploaded successfully';
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
				$stmt = $conn->prepare("SELECT id, ticket_code, ticket_qr FROM ticket_details");
				$stmt->execute();
				$stmt->bind_result($id, $qrimage, $qrcode);
				
				$images = array();
 
				//fetching all the images from database
				//and pushing it to array 
				while($stmt->fetch()){
					$temp = array();
					$temp['id'] = $id; 
					$temp['ticket_qr'] = 'http://' . $server_ip . '/MyApi/'. UPLOAD_PATH . $qrimage; 
					$temp['ticket_code'] = $qrcode; 
					
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