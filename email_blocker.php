<?php

// Function to load blocked emails from JSON file
function loadBlockedEmails() {
    $jsonFile = 'blocked_emails.json';
    $emails = [];
    
    if (file_exists($jsonFile)) {
        $jsonContent = file_get_contents($jsonFile);
        $emails = json_decode($jsonContent, true);
        if (!is_array($emails)) {
            $emails = [];
        }
    }
    
    return $emails;
}

// Function to check if email is blocked
function isEmailBlocked($email) {
    $blockedEmails = loadBlockedEmails();
    return in_array($email, $blockedEmails);
}

?>
