<?php
// Start the session to access session data
session_start();

// Destroy all session data
session_destroy();

// Redirect to the login page or any other page after logout
header("Location: http://localhost/MWMSystem/View/login.php");
exit();
?>
