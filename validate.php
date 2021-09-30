<?php

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

if (!empty($uname) || !empty($pwd)) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration";

    $con = new mysqli($server, $username, $password, $dbname);

    if (mysqli_connect_error()) {
        die('connection error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT * from register where uname= ? and pwd =? limit 1";
        $stmt  = $con->prepare($SELECT);
        $stmt->bind_param("ss", $uname,$pwd);
        $stmt->execute();
        $stmt->store_result();
        $rnum  = $stmt->num_rows;

        if ($rnum == 1) {
            
         
            //echo "sucessfully logged in";
            include "main.html";
           exit();
        } else {
            echo "sorry either password or username is wrong";
            exit();
        }
    }
} else {
    echo "all  field are required";
    die();
}
