<?php
//Setup of DB
$link = mysqli_connect("localhost", "US", "PW", "DB");

//Prompt Error Connection
if($link->connect_errno > 0){
    die('Unable to connect to database [' . $link->connect_error . ']');

}

?>