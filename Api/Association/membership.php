<?php
session_start();
header("Content-Type: application/json");

include '../../Config/conn.php';

// Register new membership
function register_membership($conn){
    extract($_POST);

    $data = array();

    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];

    // Building the query and calling the stored procedure
    $query = "CALL sp_membership('', '$card', '$name', '$gender', '$email', '$phone', '$location', '$associationName', '$semid')";

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

// Update existing membership
function update_membership($conn){
    extract($_POST);

    $data = array();

    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];

    // Building the query and calling the stored procedure
    $query = "CALL sp_membership('$id', '$card', '$name', '$gender', '$email', '$phone', '$location', '$associationName', '$semid')";

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

// Get all memberships
function get_membership($conn) {
    $data = array();
    $array_data = array();

    // Using a prepared statement to prevent SQL injection
    $query = "SELECT * FROM `membership` WHERE `AssociationName` = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $_SESSION['AssociationName']); // Bind the session variable
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $array_data[] = $row;
            }
            $data = array("status" => true, "data" => $array_data);
        } else {
            $data = array("status" => false, "data" => $conn->error);
        }

        $stmt->close();
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    
    echo json_encode($data);
}


// Get membership report
function get_membership_report($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
    $associationName = $_SESSION['AssociationName'];
    $query = "CALL rpa_membership('$from','$to','$associationName')";
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

// Get membership information
function get_membership_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT * FROM `membership` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// Delete membership information
function delete_membership_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "DELETE FROM `membership` WHERE id = '$id'";
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