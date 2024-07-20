<?php
session_start();
header("Content-Type: application/json");

include '../../Config/conn.php';




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
    $query = "SELECT * FROM user WHERE `Username` != 'uukow'  AND `AssociationName` = '{$_SESSION['AssociationName']}';";
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





if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
} else {
    echo json_encode(array("status" => false, "data" => "Action is required"));
}
?>
