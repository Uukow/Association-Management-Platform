<?php

header("Content-Type: application/json");

include '../Config/conn.php';

// read All emails in memberships
function read_emails($conn){
    $data = array();
    $data_array = array();
    extract($_POST);

    // Assuming you have a table named 'Membership emails' in your database
    $query = "SELECT Email FROM membership WHERE Location = '$city'";
    $result = $conn->query($query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row['Email'];
        }

        $data = array("status" => true, "data" => $data_array);
    } else {
        $data = array("status" => false, "data" => "Database Error: " . mysqli_error($conn));
    }

    echo json_encode($data);
}

// read locations in membership database
function read_locations($conn){
    $data = array();
    $data_array = array();

    // Assuming you have a table named 'Membership emails' in your database
    $query = "SELECT DISTINCT Location FROM membership;
    ";
    $result = $conn->query($query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row['Location'];
        }

        $data = array("status" => true, "data" => $data_array);
    } else {
        $data = array("status" => false, "data" => "Database Error: " . mysqli_error($conn));
    }

    echo json_encode($data);
}



if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
} else {
    echo json_encode(array("status" => false, "data" => "Action is required"));
}
?>