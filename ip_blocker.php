<?php

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

// Function to check if IP address is blocked
function isIPBlocked($ip) {
    $blockedIPs = loadBlockedIPs();
    return in_array($ip, $blockedIPs);
}

?>
