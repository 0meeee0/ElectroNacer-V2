<?php
    require_once 'hm.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $identifiant = $_POST['identifiant'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $sql ="DELETE FROM `user` WHERE `identifiant` = '$identifiant'";
        $conn->query($sql);

        $sql2 ="INSERT INTO `admin`(`identifiant`, `email`, `pass`) VALUES ('$username','$email','$pass')";
        $conn->query($sql2);
        header("Location: dashboard.php");
        exit();
    }
?>