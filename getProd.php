<?php
function getProds() {
    $servername = "localhost";
    $username = "root";
    $password = "123";
    $dbname = "electronacer2";

  
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM produits";
    $result = $conn->query($sql);

    $prods = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $prods[] = $row;
        }
    }

    $conn->close();

    return $prods;
}