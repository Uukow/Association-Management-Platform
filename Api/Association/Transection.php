<?php
session_start();
header("Content-Type: application/json");

include '../../Config/conn.php';

// Register New Transactions
function register_transections($conn){
    extract($_POST);

    $data = array();
    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];

    // Building the query and calling the stored procedure
    $query = "CALL sp_transections('','$title','$org','$type','$date','$number','$name','$memo', '$split', '$category', '$amount', '$associationName')";

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

// Update the transactions
function update_transections($conn){
    extract($_POST);

    $data = array();
    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];

    // Building the query and calling the stored procedure
    $query = "CALL sp_transections('$id','$title','$org','$type','$date','$number','$name','$memo', '$split', '$category', '$amount', '$associationName')";

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


// read at least five transactions
function get_transections($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `transection` WHERE `AssociationName` = '{$_SESSION['AssociationName']}'";
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

// // read at least five transactions
function get_transections_limit($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `transection` WHERE `AssociationName` = '{$_SESSION['AssociationName']}' ORDER BY id DESC LIMIT 5;";
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


// Report of the transactions
function get_transection_report($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $associationName = $_SESSION['AssociationName'];
    $query = "CALL rpa_transection('$org','$from','$to','$associationName')";
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

// read one transaction
function get_transections_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT * FROM `transection` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}


// Read Organization or Donors
function read_organizations($conn){
    $data = array();
    $data_array = array();

    // Assuming you have a table named 'JobPositions' in your database
    $query = "SELECT name FROM partners  WHERE `AssociationName` = '{$_SESSION['AssociationName']}'";
    $result = $conn->query($query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row['name'];
        }

        $data = array("status" => true, "data" => $data_array);
    } else {
        $data = array("status" => false, "data" => "Database Error: " . mysqli_error($conn));
    }

    echo json_encode($data);
}


// Delete new Transaction
function delete_transections_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "DELETE FROM `transection` WHERE id = '$id'";
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
