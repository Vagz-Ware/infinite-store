<?php

    $dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname ="infinite_store_db";

    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);

    if ($conn === false) {
        die("ERROR, couldn't connect to database" . mysqli_connect_error());
    }

?>