<?php
// Include email_blocker.php and ip_blocker.php
require_once 'email_blocker.php';
require_once 'ip_blocker.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; // Assuming 'email' is the name attribute of your email field
    $ip = $_SERVER['REMOTE_ADDR']; // Get IP address of the client

    if (isEmailBlocked($email)) {
        // Handle blocked email (e.g., redirect, show error message)
        echo "Sorry, your email is blocked from accessing this website.";
        exit;
    } elseif (isIPBlocked($ip)) {
        // Handle blocked IP address (e.g., redirect, show error message)
        echo "Sorry, your IP address is blocked from accessing this website.";
        exit;
    } else {
        // Neither email nor IP is blocked, proceed with your form processing
        echo "Email and IP are not blocked. Proceed with form submission.";
        // Proceed with your form processing logic here
    }
}
?>
