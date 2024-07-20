<?php
session_start();
header("Content-Type: application/json");

include '../../Config/conn.php';

// register new seminar
function register_siminar($conn)
{
    extract($_POST);

    $data = array();
    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];

    // Building the query and calling the stored procedure
    $query = "CALL sp_siminars('','$title','$partner','$date','$location', '$associationName')";

    // Executing the query
    $result = $conn->query($query);

    // Checking if the result was successful or error
    if ($result) {
        $data = array("status" => true, "data" => "Registration successful");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// Update seminar
function update_siminars($conn)
{
    extract($_POST);

    $data = array();
    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];

    // Building the query and calling the stored procedure
    $query = "CALL sp_siminars('$id','$title','$partner','$date','$location', '$associationName')";

    // Executing the query
    $result = $conn->query($query);

    // Checking if the result was successful or error
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row['Message'] == 'Updated') {
            $data = array("status" => true, "data" => "Updated successful");
        } else {
            $data = array("status" => false, "data" => $conn->error);
        }
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// read all all seminars
function get_siminars($conn)
{

    $data = array();
    $array_data = array();
    
    $query = "SELECT 
    `id`, 
    `Title`, 
    `Partner`, 
    `Data`, 
    `Location`, 
    CASE 
        WHEN `Data` < CURRENT_DATE THEN 'Expired'
        WHEN `Data` = CURRENT_DATE THEN 'Current Now'
        ELSE 'Coming Soon'
    END AS 'Status'
FROM 
    `siminars` WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
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
// // read all all seminars
// function get_siminars($conn){

//     $data = array();
//     $array_data = array();
//     $query = "SELECT * FROM siminars";
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

// get report
function get_siminars_report($conn)
{
    extract($_POST);
    $data = array();
    $array_data = array();
    $associationName = $_SESSION['AssociationName'];
    $query = "CALL rp_siminars('$from','$to', '$associationName')";
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

// read one seminar
function get_siminars_info($conn)
{
    extract($_POST);

    $data = array();
    $array_data = array();

    $query = "SELECT * FROM `siminars` WHERE id = '$id'";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// Delete One seminar
function delete_siminars_info($conn)
{
    extract($_POST);

    $data = array();
    $array_data = array();

    $query = "DELETE FROM `siminars` WHERE id = '$id'";
    $result = $conn->query($query);

    if ($result) {

        $data = array("status" => true, "data" => "Deleted successfully");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $action($conn);
} else {
    echo json_encode(array("status" => false, "data" => "Action is required"));
}
