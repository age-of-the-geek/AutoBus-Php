<?php 

include 'conn.php';
$con = OpenCon();
 


 if($_SERVER['REQUEST_METHOD']=='POST'){
 //Getting values 
 $username = $_POST['email'];
 $password = $_POST['password'];
 
 //Creating sql query
 $sql = "SELECT * FROM admin_account WHERE admin_uname='$username' AND admin_password='$password';";
 
 //importing dbConnect.php script 
 
 
 //executing query
 $result = mysqli_query($con,$sql);
 
 //fetching result
 $check = mysqli_fetch_array($result);
 
 //if we got some result 
 if(isset($check)){
 //displaying success 
 echo "success";
 }else{
 //displaying failure
 echo "failure";
 }
 CloseCon($con);
 }

 ?>