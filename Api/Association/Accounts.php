<?php
session_start();
header("Content-Type: application/json");

include '../../Config/conn.php';

function register_accounts($conn){
    extract($_POST);

    $data = array();
        
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];

    // Building the query and calling the stored procedure
    $query = "CALL sp_accounts('','$title','$number', '$associationName')";

    // Executing the query
    $result = $conn->query($query);

    // Checking if the result was successful or error
    if($result){

        $row = $result->fetch_assoc();

        if($row['Message'] == 'Deny'){
            $data = array("status" => false, "data" => "Haraaga Xisaabtaada kuma filna Fadlan Hubi Mahadsanid.");
        }elseif($row['Message'] == 'Registered'){

        $data = array("status" => true, "data" => "Registration successful");
        }

    }else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

function update_accounts($conn){
    extract($_POST);

    $data = array();
        
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];

    // Building the query and calling the stored procedure
    $query = "CALL sp_accounts('$id','$title','$number', '$associationName')";

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



function get_accounts($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT * FROM accounts WHERE `AssociationName` = '{$_SESSION['AssociationName']}'";
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



function get_account_report($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "CALL rp_accounts('$from','$to')";
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

function get_accounts_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT * FROM `accounts` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

function read_accounts($conn){
    $data = array();
    $data_array = array();

    // Assuming you have a table named 'JobPositions' in your database
    $query = "SELECT AccountTitle FROM accounts WHERE `AssociationName` = '{$_SESSION['AssociationName']}'";
    $result = $conn->query($query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row['AccountTitle'];
        }

        $data = array("status" => true, "data" => $data_array);
    } else {
        $data = array("status" => false, "data" => "Database Error: " . mysqli_error($conn));
    }

    echo json_encode($data);
}


function delete_accounts_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "DELETE FROM `accounts` WHERE id = '$id'";
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
