<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/LeaveManagement/');
}
$ServerName = "localhost";
$username = "root";
$password = "";
$DbName = "leavemgmt";
$conn = mysqli_connect($ServerName, $username, $password, $DbName);
if (!$conn) {
    die("Database connection failed. Please contact the administrator.");
}
$conn->set_charset("utf8mb4");
?>