<?php

include 'conn.php';
$con = OpenCon();

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $number = $_POST['bus_number'];
    $tk_checker_uname = $_POST['tk_checker_uname'];
    $tk_checker_password = $_POST['tk_checker_ password'];
    $tk_checker_id = $_POST['tk_checker_id'];
    $tk_checker_phone = $_POST['tk_checker_phone'];


    

    

    $sql = "INSERT INTO tk_checker_account (bus_number, tk_checker_uname, tk_checker_password, tk_checker_id
    ,tk_checker_phone) 
    VALUES ('$number', '$tk_checker_uname', '$tk_checker_password' ,'$tk_checker_id','$tk_checker_phone')";

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