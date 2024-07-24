<?php
// blocked_emails.php

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

// Function to save blocked emails to JSON file
function saveBlockedEmails($emails) {
    $jsonFile = 'blocked_emails.json';
    $jsonContent = json_encode($emails, JSON_PRETTY_PRINT);
    file_put_contents($jsonFile, $jsonContent);
}

// Function to load blocked IPs from JSON file
function loadBlockedIPs() {
    $jsonFile = 'blocked_ips.json';
    $ips = [];

    if (file_exists($jsonFile)) {
        $jsonContent = file_get_contents($jsonFile);
        $ips = json_decode($jsonContent, true);
        if (!is_array($ips)) {
            $ips = [];
        }
    }

    return $ips;
}

// Function to save blocked IPs to JSON file
function saveBlockedIPs($ips) {
    $jsonFile = 'blocked_ips.json';
    $jsonContent = json_encode($ips, JSON_PRETTY_PRINT);
    file_put_contents($jsonFile, $jsonContent);
}

// Function to block an email and add associated IP to blocked IPs
function blockEmailAndIP($email, $ip) {
    // Load blocked emails
    $blockedEmails = loadBlockedEmails();

    // Check if email is already blocked
    if (!in_array($email, $blockedEmails)) {
        // Add email to blocked emails
        $blockedEmails[] = $email;
        // Save updated blocked emails
        saveBlockedEmails($blockedEmails);
    }

    // Load blocked IPs
    $blockedIPs = loadBlockedIPs();

    // Check if IP is already blocked
    if (!in_array($ip, $blockedIPs)) {
        // Add IP to blocked IPs
        $blockedIPs[] = $ip;
        // Save updated blocked IPs
        saveBlockedIPs($blockedIPs);
    }
}

// Example usage (assuming you have received the email and IP to block)
$email = 'spam@example.com'; // Replace with actual blocked email
$ip = '192.168.0.1'; // Replace with actual IP associated with the email

blockEmailAndIP($email, $ip);

echo "Email '$email' is blocked and IP '$ip' is added to blocked IPs.";
?>
