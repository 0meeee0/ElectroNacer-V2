<?php
    session_start();
    define('DB_SERVER','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','123');
    define('DB_NAME','electronacer2');

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($link === false){
        die("Error: " . mysqli_connect_error());
    }

// Check if the connection variable is defined and not null
    if ($link) {
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = mysqli_real_escape_string($link, $_POST["email"]); 
        $password = mysqli_real_escape_string($link, $_POST["pass"]);

        // Perform the query
        $sql = "SELECT * FROM admin WHERE email = '$email' AND pass = '$password'";
        $result = mysqli_query($link, $sql); 

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['identifiant'] = $row['identifiant'];

            // Redirect to the home page
            header("Location: home.php");
            exit();
        } else {
            echo "Please register! ";
        }
    }

    mysqli_close($link);
    echo "Access Denied.";
}
?>