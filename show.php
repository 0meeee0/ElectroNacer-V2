<?php
require_once 'test.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reference = $_POST["reference"];
    $show = $_POST["show"];

    // Update the database based on the form data
    $conn->query("UPDATE products SET `show` = '$show' WHERE reference = '$reference'");

    // var_dump($sql);
    // exit();
    header("Location: dashboard.php");
    exit();

}

?>
