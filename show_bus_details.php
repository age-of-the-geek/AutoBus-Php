<?php 
 
 /*
 * Created by BIlal Khan
 * Retrieve Data From MySQL Database in Android
 */
 
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'autobus');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

 define('UPLOAD_PATH', 'uploads/');
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //getting server ip for building image url 
 $server_ip = gethostbyname(gethostname());

 if($_SERVER['REQUEST_METHOD']=='POST'){
    //Getting values 
    $from = $_POST['bus_from'];
    $to = $_POST['bus_to'];

 //creating a query
 $stmt = $conn->prepare("SELECT bus_number, bus_total_seats, bus_available_seats, bus_from, bus_to, bus_leaving_time
 ,bus_reaching_time,bus_driver_name,bus_ticketchecker_name,bus_break_time,bus_image,day,
 ticket_price
 FROM bus_detail WHERE bus_to='$to' AND bus_from='$from';");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($number, $total_seats, $available_seats, $bus_from, $bus_to, $bus_leaving_time,
 $bus_reaching_time,$bus_driver_name,$bus_ticketchecker_name,$bus_break_time,$bus_image,$day,$ticket_price);
 
 $products = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['bus_number'] = $number; 
 $temp['bus_total_seats'] = $total_seats; 
 $temp['bus_available_seats'] = $available_seats; 
 $temp['bus_from'] = $bus_from;
 $temp['bus_to'] = $bus_to;
 $temp['bus_leaving_time'] = $bus_leaving_time;
 $temp['bus_reaching_time'] = $bus_reaching_time;
 $temp['bus_driver_name'] = $bus_driver_name;
 $temp['bus_ticketchecker_name'] = $bus_ticketchecker_name;
 $temp['bus_break_time'] = $bus_break_time; 
 $temp['bus_image'] = 'http://' . $server_ip . '/AutoBus/'. UPLOAD_PATH . $bus_image;
 $temp['day'] = $day;
 $temp['ticket_price'] = $ticket_price;
 

 array_push($products, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($products);
 }

 ?>