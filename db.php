<?php

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

if (!empty($uname) || !empty($pwd)) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration";

    $con = new mysqli($server, $username, $password, $dbname);

    if(mysqli_connect_error())
    {
        die('connection error('. mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else{
        $SELECT  = "SELECT uname FROM register WHERE uname = ? LIMIT 1";
        $INSERT = "INSERT INTO register(uname, pwd) VALUES(? ,?)" ;

        $stmt  = $con->prepare($SELECT);
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $stmt->store_result();
        $rnum  = $stmt->num_rows;
        
        if($rnum == 0)
        {
            $stmt->close();

            $stmt = $con->prepare($INSERT);
            $stmt->bind_param("ss",$uname,$pwd);
            $stmt->execute();
            echo "new record inserted sucessfully";

        }
        else{
            echo "someone already registered with same username";
        }
        $stmt->close();
        $con->close();
    }

} else {
    echo "all  field are required";
    die();
}
