<?php
session_start();
header("Content-Type: application/json");

include '../Config/conn.php';

// Read all System authentication
function readSystemAuthorities($conn) {
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM system_authority";
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

// Get all Authories users from the database
function getUserAuthorities($conn) {
    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "CALL sp_get_user_authority('$user_id');";
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
// function getUserMenus($conn) {
//     session_start();
//     extract($_POST);
//     $data = array();
//     $array_data = array();
//     $user_id = $_SESSION['userId'];
//     $query = "CALL sp_get_user_menu('$userId')";
//     $result = $conn->query($query);

//     if ($result) {
//         while ($row = $result->fetch_assoc()) {
//             $array_data[] = $row;
//         }
//         $data = array("status" => true, "data" => $array_data);
//     } else {
//         $data = array("status" => false, "data" => $conn->error);
//     }
//     echo json_encode($data);
// }

// get all User Menus
function getUserMenus($conn){
    $userId =$_SESSION['id'];
    extract($_POST);
    $data = array();
    $message = array();
    $query = "CALL sp_get_user_menu('$userId')";
    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $data [] = $row;
        }
        $message = array("status" => true, "data" => $data);
    }else{
        $message = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($message);
};


// Register or authorize a user
 function authorize_user($conn){
    extract($_POST);

    $data = array();
    $success_array = array();
    $error_array = array();

    $del = "DELETE FROM user_authority where user_id = '$user_id'";
    $conn = new mysqli("localhost","root","","mwnsystem");
    $res = $conn->query($del);

    if($res){

        for($i = 0; $i < count($action_id); $i++){
            $query = "INSERT INTO `user_authority`(`user_id`, `action`) VALUES ('$user_id', '$action_id[$i]')";

            $result = $conn->query($query);

            if($result){
                $success_array [] = array("status" => true, "data" => "Regisered");
            }else{
                $error_array [] = array("status" => false, "data"=>$conn->error);
            }
        }

    }else{
        $error_array [] = array("status"=>false, "data" => $conn->error);
    }


    if(count($success_array) > 0 && count($error_array) == 0){
        $data = array("status"=>true, "data"=> $success_array);
    }elseif(count($success_array) > 0){
        $data = array("status"=>false, "data" => $error_array);
    }

    if(count($error_array) > 0 && count($success_array) ==0){
        $data = array("status"=>false, "data" => $error_array);
    }
    echo json_encode($data);
}


// read all users
function get_user($conn) {
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM user;";
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

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
} else {
    echo json_encode(array("status" => false, "data" => "Action is required"));
}
?>






