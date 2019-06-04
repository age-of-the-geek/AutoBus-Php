<?php

include 'conn.php';
$con = OpenCon();

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $subadmin_phone = $_POST['subadmin_phone'];
    $subadmin_uname = $_POST['subadmin_uname'];
    $subadmin_password = $_POST['subadmin_password'];
    $subadmin_id = $_POST['subadmin_id'];
    $bus_company = $_POST['bus_company'];


    

    

    $sql = "INSERT INTO subadmin_account (subadmin_phone, subadmin_uname, subadmin_password, subadmin_id
    ,bus_company) 
    VALUES ('$subadmin_phone', '$subadmin_uname', '$subadmin_password' ,'$subadmin_id','$bus_company')";

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