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
        $show = TRUE;

        // Handle image upload
        $imagePath = "imgs/"; // Specify the directory where you want to store the uploaded images
        $imageFileName = $_FILES['image']['name'];
        $imageFilePath = $imagePath . $imageFileName;

        move_uploaded_file($_FILES['image']['tmp_name'], $imageFilePath);

        // Insert the new product into the database
        $conn->query("INSERT INTO products  VALUES ('$reference', '$imageFilePath', '$barcode', '$label', '$purchasePrice', '$finalPrice', '$priceOffer', '$description', '$minQuantity', '$stockQuantity', '$category', '$show')");

        // Redirect to refresh the page and prevent form resubmission
        header("Location: dashboard.php");
        exit();
    }

?>