
<?php
session_start();

header("Content-Type: application/json");

include '../Config/conn.php';



function login($conn) {
    extract($_POST);
    $data = array();
    $query = "CALL sp_login('$username','$password')";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();

        if (isset($row['msg'])) {
            if ($row['msg'] == "Deny") {
                $data = array("status" => false, "data" => "Username or Password Incorrect!");
            } else {
                $data = array("status" => false, "data" => "User Locked By Administrator, Please Contact The Administrator To Unlock.");
            }
        } else {
            if ($row['AssociationName'] === 'Admin') {
                foreach ($row as $key => $value) {
                    $_SESSION[$key] = $value;
                }
                $data = array("status" => true, "data" => "Login successful!");
            } else {
                $data = array("status" => false, "data" => "This access is only for admins.");
            }
        }
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
