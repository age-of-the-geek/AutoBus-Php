<?php

include 'conn.php';
$con = OpenCon();

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $number = $_POST['bus_number'];
    $driver_uname = $_POST['driver_uname'];
    $driver_password = $_POST['driver_password'];
    $driver_id = $_POST['driver_id'];
    $driver_phone = $_POST['driver_phone'];


    

    

    $sql = "INSERT INTO driver_account (bus_number, driver_uname, driver_password, driver_id,driver_phone) 
    VALUES ('$number', '$driver_uname', '$driver_password' ,'$driver_id','$driver_phone')";

    if ( mysqli_query($con, $sql) ) {
        $result["success"] = "1";
        $result["message"] = "success";

        echo json_encode($result);
        mysqli_close($con);

    } else {

        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        CloseCon($con);
    }
}

?>