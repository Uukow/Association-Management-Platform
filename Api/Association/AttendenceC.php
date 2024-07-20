<?php
session_start();
header("Content-Type: application/json");

include '../../Config/conn.php';

function get_attendance_data($conn) {
    $data = array();
    $query = "SELECT 
                ROUND(AVG(CASE WHEN `Status` = 'Present' THEN 100 ELSE 0 END), 2) AS PresentPercentage,
                ROUND(AVG(CASE WHEN `Status` = 'Absent' THEN 100 ELSE 0 END), 2) AS AbsentPercentage
              FROM 
                `attendance` 
              WHERE 
                `AssociationName` = 'mwn'";

    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => array(
            "present" => $row['PresentPercentage'],
            "absent" => $row['AbsentPercentage']
        ));
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
function register_attendence($conn){
    extract($_POST);

    $data = array();
    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];

    // Building the query and calling the stored procedure
    $query = "CALL sp_attendence('','$empid','$name','$attDate','$associationName','$statuss')";

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

function update_attendence($conn){
    extract($_POST);

    $data = array();

    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];

    // Building the query and calling the stored procedure
    $query = "CALL sp_attendence('$id','$empid','$name','$attDate','$associationName', '$statuss')";

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



function get_attendence($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT * FROM attendance  WHERE `AssociationName` = '{$_SESSION['AssociationName']}'";
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



function get_attendance_report($conn) {
    extract($_POST);
    $data = array();
    $array_data = array();
    $associationName = $_SESSION['AssociationName'];

    $type = isset($type) ? $type : '0';
    $from = isset($from) ? $from : '0000-00-00';
    $to = isset($to) ? $to : '0000-00-00';
    $days = isset($days) ? $days : '';

    // Adjust the SQL call based on the type
    if ($type == '0') {
        // All attendance report
        $query = "CALL rp_attendance('0000-00-00', '0000-00-00', '$associationName', '')";
    } elseif ($type == 'Custom') {
        // Custom date range report
        $query = "CALL rp_attendance('$from', '$to', '$associationName', '')";
    } elseif ($type == 'days') {
        // Days report
        $query = "CALL rp_attendance('$from', '$to', '$associationName', '$days')";
    }

    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $array_data[] = $row;
        }
        $data = array("status" => true, "data" => $array_data);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// // Get membership report
// function get_attendence_report($conn){
//     extract($_POST);
//     $data = array();
//     $array_data = array();
//     $associationName = $_SESSION['AssociationName'];
//     $query = "CALL rp_attendance('$from','$to','$associationName','$days')";
//     $result = $conn->query($query);

//     if($result){
//         while($row = $result->fetch_assoc()){
//             $array_data[] = $row;
//         }
//         $data = array("status" => true, "data" => $array_data);
//     } else {
//         $data = array("status" => false, "data" => $conn->error);
//     }
//     echo json_encode($data);
// }


function get_attendence_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT * FROM `attendance` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

function delete_attendence_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "DELETE FROM `attendance` WHERE id = '$id'";
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
