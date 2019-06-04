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
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $conn->prepare("SELECT bus_number, driver_uname, driver_password, driver_id, driver_phone
 FROM driver_account;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($bus_number, $driver_uname, $driver_password, $driver_id, $driver_phone);
 
 $products = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['bus_number'] = $bus_number; 
 $temp['driver_uname'] = $driver_uname; 
 $temp['driver_password'] = $driver_password; 
 $temp['driver_id'] = $driver_id; 
 $temp['driver_phone'] = $driver_phone;

 array_push($products, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($products);

 ?>