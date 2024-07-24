<?php
// blocked_ips.php

// List of IPs to block
$blockedIPs = [
    '192.168.0.1',
    '10.0.0.1'
    // Add more IPs as needed
];

// Function to check if an IP is blocked
function isIPBlocked($ip) {
    global $blockedIPs;
    return in_array($ip, $blockedIPs);
}

// Get visitor's IP address
function getVisitorIP() {
    // Check for shared Internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validateIP($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // Check for IP behind a proxy
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Check if multiple IP addresses exist in X-Forwarded-For header
        $ip_list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ip_list as $ip) {
            if (validateIP($ip)) {
                return $ip;
            }
        }
    }

    // Standard remote address
    if (validateIP($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }

    // No valid IP found
    return false;
}

// Function to validate an IP address
function validateIP($ip) {
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
        return false; // Invalid IP
    }
    return true; // Valid IP
}

// Check if visitor's IP is blocked
$visitorIP = getVisitorIP();
if ($visitorIP && isIPBlocked($visitorIP)) {
    http_response_code(403);
    die("Access forbidden. Your IP address is blocked from accessing this website.");
}
?>
