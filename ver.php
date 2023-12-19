<?php
require_once 'test.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $currentStatus = $_POST['currentStatus'];

    $newStatus = ($currentStatus == 1) ? 0 : 1;

    // Update the 'bl' column in the database
    $sql = "UPDATE user SET bl = $newStatus WHERE username = '$username'";
    $conn->query($sql);

    header("Location: dashboard.php#here");
    exit();
}
?>
