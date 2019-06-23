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

 $server_ip = gethostbyname(gethostname());

 if($_SERVER['REQUEST_METHOD']=='POST'){
    //Getting values 
    $name = $_POST['subadmin_uname'];
    $password = $_POST['subadmin_password'];
    
 //creating a query
 $stmt = $conn->prepare("SELECT bus_company,bus_logo
 FROM subadmin_account WHERE subadmin_uname='$name' AND subadmin_password='$password';");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($bus_company,$bus_logo);
 
 $products = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['bus_company'] = $bus_company; 
 $temp['bus_logo'] = 'http://' . $server_ip . '/AutoBus/'. UPLOAD_PATH . $bus_logo;
 array_push($products, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($products);
 }
 ?>