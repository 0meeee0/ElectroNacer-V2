<?php
    require_once 'test.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $identifiant = $_POST['identifiant'];

        $sql ="DELETE FROM `user` WHERE `identifiant` = '$identifiant'";
        $conn->query($sql);
        header("Location: dashboard.php#here");
        exit();
    }
?>