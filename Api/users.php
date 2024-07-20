<?php

session_start();
header("Content-Type: application/json");

include '../Config/conn.php';

// Register new User
function register_user($conn){
    extract($_POST);

    $data = array();

    $associationName = $_SESSION['AssociationName'];
    // Building the query and calling the stored procedure
    $query = "CALL sp_user('','$name','$username',MD5('$password'),'$statuss','$email','$verify', '$associationName')";

    // Executing the query
    $result = $conn->query($query);

    // Checking if the result was successful or error
    if($result){
        $data = array("status" => true, "data" => "Registration successful");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// Update new user 
function update_user($conn){
    extract($_POST);

    $data = array();

        $associationName = $_SESSION['AssociationName'];
    // Building the query and calling the stored procedure
    $query = "CALL sp_user('$id','$name','$username',MD5('$password'),'$statuss','$email','$verify', '$associationName')";

    // Executing the query
    $result = $conn->query($query);

    // Checking if the result was successful or error
    if($result){
        $row = $result->fetch_assoc();
        if($row['Message'] == 'Updated'){
            $data = array("status" => true, "data" => "Updated successful");
        } else {
            $data = array("status" => false, "data" => $conn->error);
        }
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}


// Set the time zone to Mogadishu, Somalia
date_default_timezone_set('Africa/Mogadishu');

// Function to calculate time difference
function time_ago($timestamp) {
    $current_time = time();
    $timestamp = strtotime($timestamp);
    $time_diff = $current_time - $timestamp;
    $direction = ($time_diff < 0) ? -1 : 1;
    $time_diff = abs($time_diff);
    
    if ($time_diff < 60) {
        return $time_diff . " sec ago";
    } elseif ($time_diff < 3600) {
        $minutes = round($time_diff / 60);
        return $minutes . " min ago";
    } elseif ($time_diff < 86400) {
        $hours = round($time_diff / 3600);
        return $hours . "h ago";
    } else {
        $days = round($time_diff / 86400);
        return $days . " days ago";
    }
}

// Function to get user data
function get_user($conn) {
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM user WHERE `AssociationName` = 'Admin'";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Calculate time ago for the join date
            $row["joinDate"] = time_ago($row["joinDate"]);
            $array_data[] = $row;
        }        
        $data = array("status" => true, "data" => $array_data);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// Function to get Admins data
function get_user_admin($conn) {
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM user WHERE `AssociationName` = 'Admin';";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Calculate time ago for the join date
            $row["joinDate"] = time_ago($row["joinDate"]);
            $array_data[] = $row;
        }        
        $data = array("status" => true, "data" => $array_data);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// Function to get Associations data
function get_user_association($conn) {
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM user WHERE `AssociationName` != 'Admin';";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Calculate time ago for the join date
            $row["joinDate"] = time_ago($row["joinDate"]);
            $array_data[] = $row;
        }        
        $data = array("status" => true, "data" => $array_data);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// membership reports
function get_membership_report($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "CALL rp_user('$from','$to')";
    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $array_data[] = $row;
        }
        $data = array("status" => true, "data" => $array_data);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// get the one user information
function get_user_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT * FROM `user` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// Delete one user from the table users
function delete_user_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "DELETE FROM `user` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
       
        $data = array("status" => true, "data" => "Deleted successfully");
    } else {
        $data = array("status" => false, "data" => $conn->error);
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
