<?php
session_start();
header("Content-Type: application/json");

include '../../Config/conn.php';

// register new project
function register_proposers($conn){
    extract($_POST);

    $data = array();

    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];
    // Building the query and calling the stored procedure
    $query = "CALL sp_proposers('','$semId','$name','$description','$time','$associationName')";

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

// update project
function update_proposers($conn){
    extract($_POST);

    $data = array();

    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];
    // Building the query and calling the stored procedure
    $query = "CALL sp_proposers('$id','$semId','$name','$description','$time','$associationName')";

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


// read all projects
function get_proposers($conn) {
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM proposers WHERE `AssociationName` = '{$_SESSION['AssociationName']}'";
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

// get report
function get_proposers_report($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "CALL rp_proposers('$from','$to')";
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

// read one project only
function get_proposers_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT * FROM `proposers` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// delete project
function delete_proposers_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "DELETE FROM `proposers` WHERE id = '$id'";
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
