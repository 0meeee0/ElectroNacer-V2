<?php
    include 'test.php';

    // Fetch categorys from the database
$categorysResult = $conn->query("SELECT DISTINCT category FROM products");

$categoryFilter = isset($_GET['category']) ? $_GET['category'] : null;


$stockFilter = isset($_GET['stock']) && $_GET['stock'] === 'low' ? true : false;

if ($categoryFilter) {
   
    $categoryString = "'" . implode("','", $categoryFilter) . "'";

    $sql = "SELECT * FROM products WHERE category IN ($categoryString)";
    
  
    if ($stockFilter) {
        $sql .= " AND StockQuantity <= MinQuantity";
    }
    
    $result = $conn->query($sql);
} else {
    
    $result = $conn->query("SELECT * FROM products WHERE `show`=TRUE");

    
    if ($stockFilter) {
        $result = $conn->query("SELECT * FROM products WHERE StockQuantity <= MinQuantity");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | ElectroNacer</title>
    <link rel="icon" href="imgs/electric.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
</head>

<body style="background-color: whitesmoke">
    
    <nav class="navbar navbar-dark bg-primary justify-content-around">
        <a href="#" class="navbar-brand">ElectroNacer</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">Welcome <b> <?php echo $_SESSION['identifiant']?> </b></li>
        </ul>
    </nav>
    
    <div>
        <img id="imaj" src="imgs/banner.png" alt="banner">
    </div>
    <div class="bg-black justify-content-center d-flex py-3">
        <!-- <button class="btn btn-outline-light">Check our Products</button> -->

        <a class="btn btn-outline-light justify-content-center" href="#hna">Check our products</a>
    </div>
    <section class="d-flex">
        <div class="bg-dark w-100">
            <img class="m-auto mrl mt-5 try1" width="250" src="imgs/wa7d.png" alt="tswira lwla">
        </div>
        <div class="bg-dark w-100">
            <img class="m-auto mrl try1" width="250" src="imgs/joj.png" alt="tswira lwla">
        </div>
        <div class="bg-dark w-100">
            <img class="m-auto mrl try1" width="250" src="imgs/tlata.png" alt="tswira lwla">
        </div>
    </section>


    <section id="hna" class="section-products">
		<div class="container">
				<div class="row justify-content-center text-center">
						<div class="col-md-8 col-lg-6">
								<div class="header">
										<h2 class="display-6">Products</h2>
								</div>
						</div>
				</div>

        <div class="container">
        <form action="" method="get" class="row justify-content-center">
            <h1>categories:</h1>
            <?php
            // Display checkboxes for each category
            while ($row = $categorysResult->fetch_assoc()) {
                $categoryName = $row['category'];
                ?>
                <div class="form-check form-check-inline col-md">
                    <input class="form-check-input" type="checkbox" name="category[]" value="<?php echo $categoryName; ?>" <?php if (is_array($categoryFilter) && in_array($categoryName, $categoryFilter)) echo 'checked'; ?>>
                    <label class="form-check-label"><?php echo $categoryName; ?></label>
                </div>
                <?php
            }
            ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="stock" value="low" <?php if ($stockFilter) echo 'checked'; ?>>
                <label class="form-check-label">repture</label>
            </div>
            <button type="submit" class="btn btn-primary w-25 mb-5">Filter</button>
        </form>

    <div class="row">
        <?php
        // Display products based on the filter
        while ($item = $result->fetch_assoc()) {
            ?>
            <div class="col-md-3 mb-5">
                <div class="card shadow rounded-4">
                    <p class="text-bg-danger shadow rounded-top-4 rounded-end-4 w-75 text-center"> <?php echo 'Promo: ' .  $item['PriceOffer'] . ' DH'; ?></p>
                    <br><img src="<?php echo $item['Image']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['Label']; ?></h5>
                        <p class="card-text">
                            Reference: <?php echo $item['Reference']; ?><br>
                            Descrition: <?php echo $item['Description']; ?>
                            Stock: <?php echo $item['StockQuantity']; ?><br>
                            BarCode: <?php echo $item['Barcode']; ?><br>
                            Category: <?php echo $item['Category']; ?>
                        </p>
                        <p class="text-decoration-line-through">
                             Price: <?php echo $item['FinalPrice']; ?><?php echo ' DH'?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            }
        ?>
        </div>
    </div>

</section> 





<footer class=" bg-dark text-light text-center text-lg-start">
    <div class="container p-4">
      <div class="row">
        <div class=" mb-4 mb-md-0">
          <h5 class="text-uppercase">ElectroNacer</h5>
  
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
            molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
            voluptatem veniam, est atque cumque eum delectus sint!
          </p>
        </div>
 
    
      </div>
    </div>
  
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:ElectroNacer
    </div>
  </footer>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>