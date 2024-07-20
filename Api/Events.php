<?php
session_start();
include '../Config/conn.php';
// Connect to your MySQL database
$mysqli = new mysqli("localhost", "root", "", "mwnsystem");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Include mail configuration file
require './Server/email_config.php';

// Load PHPMailer classes into the global namespace
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Function to initialize PHPMailer
function initializeMailer() {
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true); // Passing `true` enables exceptions
    return $mail;
}



// Function to fetch notification messages
function getNotifications($mysqli) {
    // Get associationName from session
    $associationName = $_SESSION['AssociationName'];
    
    // Ensure the associationName is properly escaped to prevent SQL injection
    $associationName = $mysqli->real_escape_string($associationName);

    // Query to fetch notification messages
    $query = "CALL get_tasks(?)";

    // Prepare the statement
    if ($stmt = $mysqli->prepare($query)) {
        // Bind parameters
        $stmt->bind_param('s', $associationName);
        
        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are any notifications
        if ($result->num_rows > 0) {
            $notifications = array(); // Array to store notifications
            // Loop through each notification and generate the array
            while ($row = $result->fetch_assoc()) {
                $notification = array(
                    'id' => $row['id'],
                    'status' => $row['status'],
                    'description' => isset($row['description']) ? $row['description'] : '', // handle missing description
                    'created_at' => isset($row['created_at']) ? $row['created_at'] : '' // handle missing created_at
                );
                $notifications[] = $notification;
            }
            
            // Free result set
            $result->free_result();
            // Close the statement
            $stmt->close();

            // Return notifications as JSON
            return array('success' => true, 'notifications' => $notifications);
        } else {
            // If there are no notifications
            return array('success' => false, 'message' => 'No notifications');
        }
    } else {
        // If statement preparation failed
        return array('success' => false, 'message' => 'Query preparation failed');
    }
}

// Call the function
echo json_encode(getNotifications($mysqli));


// Function to create a new event then send with email 
function createEvent($title, $description, $event_date, $mysqli) {
    // Initialize PHPMailer
    $mail = initializeMailer();

    $title = $mysqli->real_escape_string($title);
    $description = $mysqli->real_escape_string($description);
    $event_date = $mysqli->real_escape_string($event_date);

    // Insert new event into the database
    $sql = "INSERT INTO events (title, description, event_date) VALUES ('$title', '$description', '$event_date')";
    $result = $mysqli->query($sql);

    if ($result) {
        // Get list of users
        $users_query = "SELECT email FROM user";
        $users_result = $mysqli->query($users_query);

        // Send notification email to all users
        while ($row = $users_result->fetch_assoc()) {
            $to = $row['email'];
            $subject = $title;
            $message = '<h4>Salaama Mudane/Marwa : </h4>' .  htmlspecialchars($description) . "<br><br>" . "<h4>Waqtiga Eventga waa : </h4>" . $event_date;

            try {
                // Server settings
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = SMTP_HOST; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = SMTP_USERNAME; // SMTP username
                $mail->Password = SMTP_PASSWORD; // SMTP password
                $mail->SMTPSecure = SMTP_ENCRYPTION; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = SMTP_PORT; // TCP port to connect to

                // Sender and recipient settings
                $mail->setFrom(SENDER_EMAIL, SENDER_NAME);
                $mail->addAddress($to); // Add a recipient
                $mail->addReplyTo(SENDER_EMAIL, SENDER_NAME);

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body = $message;

                $mail->send(); // Send the email
                echo 'Email notification sent to ' . $to . '<br>';
            } catch (\Exception $e) {
                echo "Email notification could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";
            }
        }

        // Return JSON response indicating success
        $response = array('success' => true, 'message' => 'Event created successfully');
        echo json_encode($response);
    } else {
        // Return JSON response indicating failure
        $response = array('success' => false, 'message' => 'Error creating event');
        echo json_encode($response);
    }
}

// Handle actions based on POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        switch ($action) {
            case 'createEvent':
                $title = $_POST['title'];
                $description = $_POST['description'];
                $event_date = $_POST['event_date'];
                createEvent($title, $description, $event_date, $mysqli);
                break;
            default:
                echo json_encode(array("status" => false, "data" => "Invalid action"));
                break;
        }
    } else {
        echo json_encode(array("status" => false, "data" => "Action is required"));
    }
}
?>
