<?php

$conn = new mysqli("localhost","root","","mwnsystem");

if($conn->connect_error){
    echo $conn->error;
}

?>