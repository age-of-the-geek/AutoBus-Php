<?php 

include 'conn.php';
$con = OpenCon();
 


 if($_SERVER['REQUEST_METHOD']=='POST'){
 //Getting values 
 $username = $_POST['email'];
 $password = $_POST['password'];
 
 //Creating sql query
 $sql = "SELECT * FROM driver_account WHERE driver_uname='$username' AND driver_password='$password';";
 
 //importing dbConnect.php script 
 
 
 //executing query
 $result = mysqli_query($con,$sql);
 
 //fetching result
 $check = mysqli_fetch_array($result);
 
 //if we got some result 
 if(isset($check)){
 //displaying success 
 echo "success";
 echo json_encode($check);
 }else{
 //displaying failure
 echo "failure";
 }
 CloseCon($con);
 }

 ?>