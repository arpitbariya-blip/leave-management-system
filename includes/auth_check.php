<?php
// Reusable authentication check for AJAX/action endpoints
// Include this file at the top of any file that needs auth but doesn't include header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['UserName'])) {
    http_response_code(403);
    echo "Unauthorized access.";
    exit;
}
?>
