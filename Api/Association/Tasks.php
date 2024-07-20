<?php
session_start();
header("Content-Type: application/json");
include '../../Config/conn.php';

// Register the user
function register_tasks($conn){
    extract($_POST);
    $data = array();

    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];
    $query = "CALL sp_tasks('','$empId','$description','$type','$startDate','$endDate','$statuss','$associationName')";

    $result = $conn->query($query);

    if($result){
        $data = array("status" => true, "data" => "Registration successful");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// Update the one user registration
// function update_tasks($conn){
//     extract($_POST);
//     $data = array();

//     // Define a variable to hold the OUT parameter value
//     $out_param = null;

//     // Prepare the statement
//     $stmt = $conn->prepare("CALL update_task_status(?, ?, @out_param)");

//     // Bind the input parameters
//     $stmt->bind_param('is', $id, $statuss);

//     // Execute the statement
//     $stmt->execute();

//     // Fetch the OUT parameter value
//     $result = $conn->query("SELECT @out_param as result");
//     $row = $result->fetch_assoc();

//     if ($row) {
//         $data = array("status" => true, "data" => $row['result']);
//     } else {
//         $data = array("status" => false, "data" => $conn->error);
//     }

//     // Output the result as JSON
//     echo json_encode($data);
// }


// Update the one user registration
function update_tasks($conn){
    extract($_POST);
    $data = array();
    
    // Get associationName from session
    $query = "CALL update_task_status('$id','$wax')";

    $result = $conn->query($query);

    if($result){
        $data = array("status" => true, "data" => "Registration successful");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}


// Read All the tasks in a table
function get_tasks($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT `id`, `employeeId`, `description`, `type`, `startDate`, `endDate`, `status` FROM `tasks` WHERE `AssociationName` = '{$_SESSION['AssociationName']}'";
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
// Read All the progress in a table
function get_progress($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT `id`, `employeeId`, `description`, `type`, `startDate`, `endDate`, `status`  FROM `in_progress_tasks` WHERE `AssociationName` = '{$_SESSION['AssociationName']}'";
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
// Read All the complete in a table
function get_complete($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT `id`, `employeeId`, `description`, `type`, `startDate`, `endDate`, `status` FROM `completed_tasks` WHERE `AssociationName` = '{$_SESSION['AssociationName']}'";
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

// Read ones

// Get the One task from the database
function get_tasks_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT `id`,  `status` FROM `tasks` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// Get the One progress from the database
function get_progress_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT `id`,  `status` FROM `in_progress_tasks` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// Get the One complete from the database
function get_complete_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT `id`,  `status` FROM `completed_tasks` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// Delete the task that also registered with the database

function delete_tasks_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "DELETE FROM `tasks` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
       
        $data = array("status" => true, "data" => "Deleted successfully");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}


// Delete the task that also registered with the database

function delete_progress_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "DELETE FROM `completed_tasks` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
       
        $data = array("status" => true, "data" => "Deleted successfully");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}


function get_tasks_report($conn) {
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "CALL rp_tasks('')";
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

// function get_job_report($conn){
//     extract($_POST);
//     $data = array();
//     $array_data = array();
//     $query = "CALL rp_jobs('$ids')";
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


if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
} else {
    echo json_encode(array("status" => false, "data" => "Action is required"));
}



?>