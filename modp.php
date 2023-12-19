<?php
    require_once 'test.php';
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $reference = $_POST['reference'];
        $barcode = $_POST['barcode'];
        $label = $_POST['label'];
        $purchasePrice = $_POST['purchasePrice'];
        $finalPrice = $_POST['finalPrice'];
        $priceOffer = $_POST['priceOffer'];
        $description = $_POST['description'];
        $minQuantity = $_POST['minQuantity'];
        $stockQuantity = $_POST['stockQuantity'];
        $category = $_POST['category'];

        // Handle image upload
        $imagePath = "imgs/"; // Specify the directory where you want to store the uploaded images
        $imageFileName = $_FILES['image']['name'];
        $imageFilePath = $imagePath . $imageFileName;

        move_uploaded_file($_FILES['image']['tmp_name'], $imageFilePath);

        // Update SQL query
        $conn->query("UPDATE products SET 
                image = '$imageFilePath',
                barcode = '$barcode',
                label = '$label',
                purchasePrice = '$purchasePrice',
                finalPrice = '$finalPrice',
                priceOffer = '$priceOffer',
                description = '$description',
                minQuantity = '$minQuantity',
                stockQuantity = '$stockQuantity',
                category = '$category'
                WHERE reference = '$reference'");

            header("Location: dashboard.php");
            exit();

    }


?>