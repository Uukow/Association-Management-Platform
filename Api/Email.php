




<?php

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';
require './Server/EmailConfig.php'; // Include the server settings

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;






// Function to send email
function send_email($recipients, $subject, $message, $attachments = []) {
    global $smtpHost, $smtpUsername, $smtpPassword, $smtpPort, $smtpEncryption;

    $senderEmail = $smtpUsername; // Use the same email for sender
    $senderName = "No Reply From MWN";
    
    // Replace [ ] with <b></b>
    $message = str_replace("[", "<b>", $message);
    $message = str_replace("]", "</b>", $message);
    // Preserve line breaks
    $message = nl2br($message);

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->SMTPSecure = $smtpEncryption;
        $mail->Port = $smtpPort;

        //Sender
        $mail->setFrom($senderEmail, $senderName);

        //Recipients
        foreach ($recipients as $recipient) {
            $mail->addBCC(trim($recipient)); // Use BCC instead of CC
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Attachments
        foreach ($attachments as $attachment) {
            $mail->addAttachment($attachment); // Add each attachment
        }

        $mail->send();
        return array("status" => true, "message" => "Your mail was successfully sent to all recipients");
    } catch (Exception $e) {
        return array("status" => false, "message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}

// Example usage:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['send'])) {
        // Split recipients string into an array
        $recipients = explode(",", $_POST['email']);

        // Check for uploaded files
        $attachments = [];
        if (!empty($_FILES['attachments']['tmp_name'])) {
            $uploadDirectory = "uploads/"; // Directory where uploaded files will be stored
            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true); // Create the directory if it doesn't exist
            }

            foreach ($_FILES['attachments']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['attachments']['name'][$key];
                $file_tmp = $_FILES['attachments']['tmp_name'][$key];
                $file_type = $_FILES['attachments']['type'][$key];
                $file_size = $_FILES['attachments']['size'][$key];
                $file_error = $_FILES['attachments']['error'][$key];

                // Check if file was uploaded successfully
                if ($file_error === UPLOAD_ERR_OK) {
                    $destination = $uploadDirectory . $file_name;
                    // Move the uploaded file to the destination directory
                    if (move_uploaded_file($file_tmp, $destination)) {
                        $attachments[] = $destination; // Store the file path
                    } else {
                        // Failed to move file, handle error as needed
                        echo "Failed to move uploaded file.";
                    }
                } else {
                    // File upload error occurred, handle error as needed
                    echo "File upload error: " . $file_error;
                }
            }
        }

        $emailResult = send_email($recipients, $_POST['subject'], $_POST['message'], $attachments);
        header('Content-Type: application/json');
        echo json_encode($emailResult);
    }
}


?>
