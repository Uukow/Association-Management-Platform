<?php
session_start();
header("Content-Type: application/json");

include '../../Config/conn.php';



function register_attendance($conn) {
    // Access POST data directly
    $attendanceData = $_POST['attendanceData'];

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
        
        $stmt = $conn->prepare("INSERT INTO `attendance`(`EmployeeID`, `Name`, `AttendanceDate`, `AssociationName`, `Status`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['EmployeeID'], $data['Name'], $data['AttendanceDate'], $_SESSION['AssociationName'], $data['Status']);

        $result = $stmt->execute();

        if ($result) {
            $success_array[] = array("status" => true, "data" => "Registered");
        } else {
            $error_array[] = array("status" => false, "data" => $stmt->error);
        }
        $stmt->close();
    }

    // Determine the response based on the presence of errors
    if (count($error_array) == 0) {
        $data = array("status" => true, "data" => $success_array);
    } else {
        $data = array("status" => false, "data" => $error_array);
    }

    echo json_encode($data);
}






// Read ALl Attendence in the Employees Table

function read_attendence($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT id, Name, CURDATE() AS CurrentDate FROM employees  WHERE `AssociationName` = '{$_SESSION['AssociationName']}';

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


// Read as avarage attendance

// Function to get attendance data
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


if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
} else {
    echo json_encode(array("status" => false, "data" => "Action is required"));
}
?>
