

<?php
session_start();
header("Content-Type: application/json");

include '../../Config/conn.php';

function read_locations($conn){
    $data = array();
    $data_array = array();
    extract($_POST);

    // Assuming you have a table named 'Membership emails' in your database
    $query = "SELECT DISTINCT Location FROM membership WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
    ";
    $result = $conn->query($query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row['Location'];
        }

        $data = array("status" => true, "data" => $data_array);
    } else {
        $data = array("status" => false, "data" => "Database Error: " . mysqli_error($conn));
    }

    echo json_encode($data);
}
// Define the read_emails function
function read_emails($conn, $city) {
    $data = array();
    $data_array = array();

    // Assuming you have a table named 'Emails' in your database with a column named 'City'
    $query = "SELECT Email FROM Emails WHERE City = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $city);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data_array[] = $row['Email'];
        }

        $data = array("status" => true, "data" => $data_array);
    } else {
        $data = array("status" => false, "data" => "Database Error: " . $conn->error);
    }

    return $data;
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "read_emails") {
    if (isset($_POST["city"])) {
        $city = $_POST["city"];
        $result = read_emails($conn, $city);
        echo json_encode($result);
    } else {
        echo json_encode(array("status" => false, "data" => "City parameter is missing"));
    }
}
// read the debit
function get_total_debit($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT SUM(`Amount`) total FROM `transection` WHERE `Category` = 'Debit' AND `AssociationName` = '{$_SESSION['AssociationName']}';";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the debit
function get_total_debit_percentage($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT 
    CONCAT(
        IFNULL(
            FORMAT(
                (SELECT SUM(`Amount`) FROM `transection`  WHERE `AssociationName` = '{$_SESSION['AssociationName']}' AND `Category` = 'Debit') 
                / NULLIF((SELECT SUM(`Amount`) FROM `transection`  WHERE `AssociationName` = '{$_SESSION['AssociationName']}' ), 0) * 100,
                2
            ), 
            0
        ), 
        '%'
    ) AS debiPercentageTotal;
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Credit
function get_total_credit($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT 
    COALESCE(SUM(`Amount`), 0) AS totalCredit FROM `transection` WHERE `AssociationName` = '{$_SESSION['AssociationName']}' AND `Category` = 'Credit';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Credit percentage
function get_total_credit_percentage($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "

    SELECT 
    CONCAT(
        IFNULL(
            FORMAT(
                (SELECT SUM(`Amount`) FROM `transection`  WHERE `AssociationName` = '{$_SESSION['AssociationName']}' AND `Category` = 'Credit') 
                / NULLIF((SELECT SUM(`Amount`) FROM `transection`  WHERE `AssociationName` = '{$_SESSION['AssociationName']}' ), 0) * 100,
                2
            ), 
            0
        ), 
        '%'
    ) AS creditPercentageTotal;

";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the balance
function get_total_balance($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT 
    (SELECT COALESCE(SUM(`Amount`), 0) FROM `transection` WHERE `Category` = 'Debit' AND  `AssociationName` = '{$_SESSION['AssociationName']}') -
    (SELECT COALESCE(SUM(`Amount`), 0) FROM `transection` WHERE `Category` = 'Credit' AND  `AssociationName` = '{$_SESSION['AssociationName']}') AS balance;
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Credit percentage
function get_total_balance_percentage($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT 
    CONCAT(FORMAT((SELECT SUM(`Amount`) FROM `transection` WHERE `AssociationName` = '{$_SESSION['AssociationName']}' AND `Category` = 'Debit') / (SELECT SUM(`Amount`) FROM `transection`) * 100 - (SELECT SUM(`Amount`) FROM `transection` WHERE `Category` = 'Credit') / NULLIF((SELECT SUM(`Amount`) FROM `transection`), 0) * 100, 2), '%') AS difference;


";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Users count
function get_total_proposers($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT COUNT(*) AS total_proposers FROM proposers WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Employees count
function get_total_employees($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT COUNT(*) AS total_employees FROM employees WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Accounts count
function get_total_accounts($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT COUNT(*) AS total_accounts FROM accounts WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Membership count
function get_total_membership($conn){
    extract($_POST);

    $data = array();
    $array_data = array();
    
    $query = "SELECT COUNT(*) AS total_membership FROM membership WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Membership count
function get_total_siminars($conn){
    extract($_POST);

    $data = array();    
    $array_data = array();
    
    $query = "SELECT COUNT(*) AS total_siminars FROM siminars WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// read the Participant count
function get_total_participant($conn){
    extract($_POST);

    $data = array();    
    $array_data = array();
    
    $query = "SELECT COUNT(*) AS total_participant FROM participant WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Partnber count
function get_total_partners($conn){
    extract($_POST);

    $data = array();    
    $array_data = array();
    
    $query = "SELECT COUNT(*) AS total_partners FROM partners WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Partnber count
function get_total_projects($conn){
    extract($_POST);

    $data = array();    
    $array_data = array();
    
    $query = "SELECT COUNT(*) AS total_projects FROM projects WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// read the total tast pending count
function get_total_pending($conn){
    extract($_POST);

    $data = array();    
    $array_data = array();
    
    $query = "SELECT COUNT(*) AS total_pending FROM tasks WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}
// read the Partnber count
function get_total_jobs($conn){
    extract($_POST);

    $data = array();    
    $array_data = array();
    
    $query = "SELECT COUNT(*) AS total_jobs FROM jobs WHERE `AssociationName` = '{$_SESSION['AssociationName']}';
";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();
        $data = array("status" => true, "data" => $row);
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

function loadChart($conn) {
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];
    $query = "CALL `chart_tasks`('$associationName')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                "label" => $row['labels'],  // Assuming 'labels' is the column alias from your stored procedure
                "value" => $row['series']   // Assuming 'series' is the column alias from your stored procedure
            );
        }
        $result_data = array("status" => true, "data" => $data);
    } else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function loadChartEmployees($conn) {
    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];
    $query = "CALL `chart_employees`('$associationName')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                "label" => $row['labels'],  // Assuming 'labels' is the column alias from your stored procedure
                "value" => $row['series']   // Assuming 'series' is the column alias from your stored procedure
            );
        }
        $result_data = array("status" => true, "data" => $data);
    } else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function loadChartMemberships($conn) {
    
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];
    $query = "CALL `chart_membership`('$associationName')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                "label" => $row['labels'],  // Assuming 'labels' is the column alias from your stored procedure
                "value" => $row['series']   // Assuming 'series' is the column alias from your stored procedure
            );
        }
        $result_data = array("status" => true, "data" => $data);
    } else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}
if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
} else {
    echo json_encode(array("status" => false, "data" => "Action is required"));
}
?>