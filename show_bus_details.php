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
 $stmt = $conn->prepare("SELECT bus_number, bus_total_seats, bus_available_seats, bus_route, bus_leaving_time
 ,bus_reaching_time,bus_driver_name,bus_ticketchecker_name,bus_rating,bus_break_time,bus_company,bus_image,day 
 FROM bus_detail;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($number, $total_seats, $available_seats, $bus_route, $bus_leaving_time,
 $bus_reaching_time,$bus_driver_name,$bus_ticketchecker_name,$bus_rating,$bus_break_time,$bus_company,
 $bus_image,$day);
 
 $products = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['bus_number'] = $number; 
 $temp['bus_total_seats'] = $total_seats; 
 $temp['bus_available_seats'] = $available_seats; 
 $temp['bus_route'] = $bus_route; 
 $temp['bus_leaving_time'] = $bus_leaving_time;
 $temp['bus_reaching_time'] = $bus_reaching_time;
 $temp['bus_driver_name'] = $bus_driver_name;
 $temp['bus_ticketchecker_name'] = $bus_ticketchecker_name;
 $temp['bus_rating'] = $bus_rating;
 $temp['bus_break_time'] = $bus_break_time; 
 $temp['bus_company'] = $bus_company; 
 $temp['bus_image'] = $bus_image;
 $temp['day'] = $day;

 array_push($products, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($products);

 ?>