<?php
header("Content-Type: application/json");

include '../Config/conn.php';






// function register_attendance($conn){
//     // Extract POST data and ensure they are arrays
//     extract($_POST);
//     print_r($attendanceData);
//     return ;
//     $EmployeeID = isset($EmployeeID) ? (array)$EmployeeID : array();
//     $Name = isset($Name) ? (array)$Name : array();
//     $AttendanceDate = isset($AttendanceDate) ? (array)$AttendanceDate : array();
//     $Status = isset($Status) ? (array)$Status : array();

//     $data = array();
//     $success_array = array();
//     $error_array = array();

//     // Ensure the connection is correct and active
//     if ($conn->connect_error) {
//         $error_array[] = array("status" => false, "data" => $conn->connect_error);
//         echo json_encode(array("status" => false, "data" => $error_array));
//         return;
//     }

//     // Prepare the delete statement
//     if (!empty($AttendanceDate)) {
//         $del = "DELETE FROM attendance WHERE AttendanceDate = '{$AttendanceDate[0]}'";
//         $res = $conn->query($del);

//         if(!$res){
//             $error_array[] = array("status" => false, "data" => $conn->error);
//         }
//     }

//     print_r($EmployeeID);
//     return;
//     // Insert new attendance records
//     for($i = 0; $i < count($EmployeeID); $i++){
//         // Use prepared statements to prevent SQL injection
//         $stmt = $conn->prepare("INSERT INTO `attendance`(`EmployeeID`, `Name`, `AttendanceDate`, `Status`) VALUES (?, ?, ?, ?)");
//         $stmt->bind_param("ssss", $EmployeeID[$i], $Name[$i], $AttendanceDate[$i], $Status[$i]);

//         $result = $stmt->execute();

//         if($result){
//             $success_array[] = array("status" => true, "data" => "Registered");
//         } else {
//             $error_array[] = array("status" => false, "data" => $stmt->error);
//         }
//         $stmt->close();
//     }

//     // Determine the response based on the success and error arrays
//     if(count($success_array) > 0 && count($error_array) == 0){
//         $data = array("status" => true, "data" => $success_array);
//     } elseif(count($success_array) > 0){
//         $data = array("status" => false, "data" => $error_array);
//     } else {
//         $data = array("status" => false, "data" => $error_array);
//     }

//     echo json_encode($data);
// }

function register_attendance($conn) {
    // Access POST data directly
    $attendanceData = $_POST['attendanceData'];

    $data = array();
    $success_array = array();
    $error_array = array();

    // Ensure the connection is correct and active
    if ($conn->connect_error) {
        $error_array[] = array("status" => false, "data" => $conn->connect_error);
        echo json_encode(array("status" => false, "data" => $error_array));
        return;
    }

    // Prepare the delete statement
    if (!empty($attendanceData)) {
        $del = "DELETE FROM attendance WHERE AttendanceDate = ?";
        $stmt = $conn->prepare($del);
        $stmt->bind_param("s", $attendanceData[0]['AttendanceDate']);
        $res = $stmt->execute();

        if (!$res) {
            $error_array[] = array("status" => false, "data" => $stmt->error);
        }
        $stmt->close();
    }

    // Insert new attendance records
    foreach ($attendanceData as $data) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO `attendance`(`EmployeeID`, `Name`, `AttendanceDate`, `Status`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['EmployeeID'], $data['Name'], $data['AttendanceDate'], $data['Status']);

        $result = $stmt->execute();

        if ($result) {
            $success_array[] = array("status" => true, "data" => "Registered");
        } else {
            $error_array[] = array("status" => false, "data" => $stmt->error);
        }
        $stmt->close();
    }

    // Determine the response based on the success and error arrays
    if (count($success_array) > 0 && count($error_array) == 0) {
        $data = array("status" => true, "data" => $success_array);
    } elseif (count($success_array) > 0) {
        $data = array("status" => false, "data" => $error_array);
    } else {
        $data = array("status" => false, "data" => $error_array);
    }

    echo json_encode($data);
}






function read_attendence($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT id, Name, CURDATE() AS CurrentDate FROM employees;

    ";
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

function get_employees_info($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT * FROM `employees` WHERE id = '$id'";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
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
