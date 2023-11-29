<?php
    include 'getProd.php';
    $servername = "localhost";
    $username = "root";
    $password = "123";
    $dbname = "electronacer2";

  
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Fetch categorys from the database
$categorysResult = $conn->query("SELECT DISTINCT category FROM products");

// Fetch products based on the selected category filter
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : null;

if ($categoryFilter) {
    
    $categoryString = "'" . implode("','", $categoryFilter) . "'";

    
    $sql = "SELECT * FROM products WHERE category IN ($categoryString)";
    $result = $conn->query($sql);
} else {
    
    $result = $conn->query("SELECT * FROM products");
}
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
    
    $result = $conn->query("SELECT * FROM products");

    
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

<body>
    
    <nav class="navbar navbar-dark bg-primary justify-content-around">
        <a href="#" class="navbar-brand">ElectroNacer</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">Welcome username</li>
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
										<h2>Products</h2>
								</div>
						</div>
				</div>

                <div class="container mt-4">
        <form action="" method="get" class="row mt-4 justify-content-center">
        <h1>categorys:</h1>
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


                <!-- <div class=" display-6 d-md-flex justify-content-between gap-5 text-center pb-5">
                    <a class="text-bg-dark">Laptops</a>
                    <a class="text-bg-dark">Phones</a>
                    <a class="text-bg-dark">Electromenager</a>
                    <a class="text-bg-dark">Consoles</a>
                    <a class="text-bg-dark">Repture</a>
                </div>
				<div class="row">
						 
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-1" class="single-product">
										
										<div class="part-2">
                                            <img src="imgs/a1.jpg" alt="">
												<h3 class="product-title">ITEM</h3>
												<h4 class="product-price">$49.99</h4>
										</div>
								</div>
						</div>
						 
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-2" class="single-product">
										
										<div class="part-2">
                                            <img src="imgs/a2.jpg" alt="">
												<h3 class="product-title">ITEM</h3>
												<h4 class="product-price">$49.99</h4>
										</div>
								</div>
						</div>
						 
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-3" class="single-product">
										
										<div class="part-2">
                                            <img src="imgs/a3.jpg" alt="">
												<h3 class="product-title">ITEM</h3>
												<h4 class="product-price">$49.99</h4>
										</div>
								</div>
						</div>
						 
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-4" class="single-product">
										
										<div class="part-2">
                                            <img src="imgs/a4.jpg" alt="">
												<h3 class="product-title">ITEM</h3>
												<h4 class="product-price">$49.99</h4>
										</div>
								</div>
						</div>
						 
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-1" class="single-product">
										
										<div class="part-2">
                                            <img src="imgs/b1.jpg" alt="">
												<h3 class="product-title">ITEM</h3>
												<h4 class="product-price">$49.99</h4>
										</div>
								</div>
						</div>
						 
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-2" class="single-product">
										
										<div class="part-2">
                                            <img src="imgs/b2.jpg" alt="">
												<h3 class="product-title">ITEM</h3>
												<h4 class="product-price">$49.99</h4>
										</div>
								</div>
						</div>
						 
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-3" class="single-product">
										
										<div class="part-2">
                                            <img src="imgs/b3.jpg" alt="">
												<h3 class="product-title">ITEM</h3>
												<h4 class="product-price">$49.99</h4>
										</div>
								</div>
						</div>
						 
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-4" class="single-product">
										
										<div class="part-2">
                                            <img src="imgs/b4.jpg" alt="">
												<h3 class="product-title">ITEM</h3>
												<h4 class="product-price">$49.99</h4>
										</div>
								</div>
						</div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div id="product-1" class="single-product">
                                    
                                    <div class="part-2">
                                        <img src="imgs/c1.jpg" alt="">
                                            <h3 class="product-title">ITEM</h3>
                                            <h4 class="product-price">$49.99</h4>
                                    </div>
                            </div>
                    </div>
                     
                    <div class="col-md-6 col-lg-4 col-xl-3">
                            <div id="product-2" class="single-product">
                                    
                                    <div class="part-2">
                                        <img src="imgs/c2.jpg" alt="">
                                            <h3 class="product-title">ITEM</h3>
                                            <h4 class="product-price">$49.99</h4>
                                    </div>
                            </div>
                    </div>
                     
                    <div class="col-md-6 col-lg-4 col-xl-3">
                            <div id="product-3" class="single-product">
                                    
                                    <div class="part-2">
                                        <img src="imgs/c3.jpg" alt="">
                                            <h3 class="product-title">ITEM</h3>
                                            <h4 class="product-price">$49.99</h4>
                                    </div>
                            </div>
                    </div>
                     
                    <div class="col-md-6 col-lg-4 col-xl-3">
                            <div id="product-4" class="single-product">
                                    
                                    <div class="part-2">
                                        <img src="imgs/c4.jpg" alt="">
                                            <h3 class="product-title">ITEM</h3>
                                            <h4 class="product-price">$49.99</h4>
                                    </div>
                            </div>
                    </div>
                     
                    <div class="col-md-6 col-lg-4 col-xl-3">
                            <div id="product-1" class="single-product">
                                    
                                    <div class="part-2">
                                        <img src="imgs/d1.jpg" alt="">
                                            <h3 class="product-title">ITEM</h3>
                                            <h4 class="product-price">$49.99</h4>
                                    </div>
                            </div>
                    </div>
                     
                    <div class="col-md-6 col-lg-4 col-xl-3">
                            <div id="product-2" class="single-product">
                                    
                                    <div class="part-2">
                                        <img src="imgs/d2.jpg" alt="">
                                            <h3 class="product-title">ITEM</h3>
                                            <h4 class="product-price">$49.99</h4>
                                    </div>
                            </div>
                    </div>
                     
                    <div class="col-md-6 col-lg-4 col-xl-3">
                            <div id="product-3" class="single-product">
                                    
                                    <div class="part-2">
                                        <img src="imgs/d3.jpg" alt="">
                                            <h3 class="product-title">ITEM</h3>
                                            <h4 class="product-price">$49.99</h4>
                                    </div>
                            </div>
                    </div>
            
				</div>
		</div>-->
</section> 





<footer class=" bg-dark text-light text-center text-lg-start">
    <!-- Grid container -->
    <div class="container p-4">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class=" mb-4 mb-md-0">
          <h5 class="text-uppercase">ElectroNacer</h5>
  
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
            molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
            voluptatem veniam, est atque cumque eum delectus sint!
          </p>
        </div>
        <!--Grid column-->
  
    
      </div>
      <!--Grid row-->
    </div>
    <!-- Grid container -->
  
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2020 Copyright:ElectroNacer
      <a class="text-body" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>