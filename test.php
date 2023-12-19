<?php
    session_start();
    define('DB_SERVER','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','123');
    define('DB_NAME','electronacer2');

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($conn === false){
        die("Error: " . mysqli_connect_error());
    }

// Check if the connection variable is defined and not null
    if ($conn) {
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

        $email = mysqli_real_escape_string($conn, $_POST["email"]); 
        $password = mysqli_real_escape_string($conn, $_POST["pass"]);

        // Perform the query
        $sql = "SELECT * FROM user WHERE email = '$email' AND pass = '$password'";
        $result = mysqli_query($conn, $sql); 

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['identifiant'] = $row['username'];

            // verified or not
            if($row['bl'] == 1){
                // Redirect to the home page
                header("Location: home.php");
                exit();
            }
            else{
                echo "need to be verified";
                exit();
            }
        }

            //if admin
        $sql = "SELECT * FROM admin WHERE email = '$email' AND pass = '$password'";
        $result = mysqli_query($conn, $sql); 

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['identifiant'] = $row['identifiant'];

            // Redirect to the home page
            header("Location: dashboard.php");
            exit();
        }



        echo "Please register! ";

    }
}
?>