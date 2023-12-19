<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '123');
define('DB_NAME', 'electronacer2');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn === false) {
    die("Error: " . mysqli_connect_error());
}

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $un = mysqli_real_escape_string($conn, $_POST['username']);
        $em = mysqli_real_escape_string($conn, $_POST['email']);
        $pw = mysqli_real_escape_string($conn, $_POST['pw']);

        $sql = "INSERT INTO user (username, email, pass, bl) VALUES ('$un', '$em', '$pw', FALSE)";
        $result = mysqli_query($conn, $sql);

        

        if ($result) {
            // Registration successful
            $_SESSION['identifiant'] = $un;
            echo "need to be verified";
            exit();
        } else {
            // Registration failed
            echo "registration failed ";
            exit();
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroNacer</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="index2.css">
    <link rel="icon" href="imgs/electric.PNG" type="image/x-icon">
</head>
<body>
    <div class="center">
        <h1>ElectroNacer</h1>
        <form action="" method="POST">
            <div class="inp">
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="inp">
                <input type="email" name="email" placeholder="Email">
            </div>
            <div class="inp">
                <input type="password" name="pw" placeholder="Password">
            </div>
            <!-- <input type="submit" value="Sign up"> -->
            <button>signup</button>
            <div class="sp">    
                <span>Already have an account?</span>
                <a href="index.php">Login</a>
            </div>
        </form>
    </div>
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
</body>
</html>