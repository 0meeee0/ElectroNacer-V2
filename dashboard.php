<?php

	include_once 'test.php';

	$result = $conn->query("SELECT * FROM products WHERE `show` = TRUE");
	$products = $result->fetch_all(MYSQLI_ASSOC);
    
	$resultF = $conn->query("SELECT * FROM products WHERE `show`=FALSE");
	$productsF = $resultF->fetch_all(MYSQLI_ASSOC);
	// echo '<pre>';	
	// var_dump($products);

	// echo '</pre>';
	// exit;
    


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
    <!-- <link rel="stylesheet" href="db.css"> -->
    <style>
        .no{
            display: none;
        }
    </style>
</head>

<body>
    
    <nav class="navbar navbar-dark bg-primary justify-content-around">
        <a href="home.php" class="navbar-brand">ElectroNacer</a><?php echo "admin: " . $_SESSION['identifiant']?>
        <!-- <ul class="navbar-nav mr-auto">
            <li class="nav-item">admin</li>
        </ul> -->
    </nav>
    
    <!-- <div>
        <img id="imaj" src="imgs/banner.png" alt="banner">
    </div> -->

    <h1 class="display-6 my-5 text-black text-center">Product Management</h1>
		
		<table class="table container table-striped">
			<thead>
				<tr>
					<th>Reference</th>
					<th>Image</th>
					<th>Description</th>
					<th>StockQuantity</th>
					<th>Category</th>
					<th>Price</th>
					<th>Options</th>
				</tr>
			</thead>
		
			<tbody>
			<?php
			foreach($products as $item) :
			?>			
					<td> <?php echo $item['Reference']; ?></td>
					<td><img width="50" src="<?php echo $item['Image']; ?>"</td>
					<td><?php echo $item['Description']; ?></td>
					<td><?php echo $item['StockQuantity']; ?></td>
					<td><?php echo $item['Category']; ?></td>
					<td><?php echo $item['FinalPrice']; ?><?php echo ' DH'?></td>
					<td>
						<div>
							<button class="btn btn-danger" data-toggle="modal" data-target="#archiveModal_<?php echo $item['Reference']; ?>">archive</button>
							<button value="<?php echo $item['Reference']?>" class="btn btn-primary wa " data-toggle="modal" data-target="#editpopup">modify</button>
						</div>
					</td>
			</tr>

            <!-- Archive Modal -->
            <div class="modal fade" id="archiveModal_<?php echo $item['Reference']; ?>" tabindex="-1" role="dialog" aria-labelledby="archiveModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="archiveModalLabel">Archive Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="show.php" method="POST">
                                <div class="form-group">
                                    <label for="archiveReference">Product Reference:</label>
                                    <input type="text" class="form-control" id="archiveReference" name="reference" value="<?php echo $item['Reference']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="archiveStatus">Archive Status:</label>
                                    <select class="form-control" name="show" id="archiveStatus">
                                        <option value="1">Show</option>
                                        <option value="0">Archive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			<?php
			endforeach;
			?>
			</tbody>
            
      	</table>



        <h1 class="display-6 my-5 text-black text-center">Hidden Productus</h1>
		
		<table class="table container table-dark">
			<thead>
				<tr>
					<th>Reference</th>
					<th>Image</th>
					<th>Description</th>
					<th>StockQuantity</th>
					<th>Category</th>
					<th>Price</th>
					<th>Options</th>
				</tr>
			</thead>
		
			<tbody>
			<?php
			foreach($productsF as $itemF) :
			?>			
					<td> <?php echo $itemF['Reference']; ?></td>
					<td><img width="50" src="<?php echo $itemF['Image']; ?>"</td>
					<td><?php echo $itemF['Description']; ?></td>
					<td><?php echo $itemF['StockQuantity']; ?></td>
					<td><?php echo $itemF['Category']; ?></td>
					<td><?php echo $itemF['FinalPrice']; ?><?php echo ' DH'?></td>
					<td>
						<div>
							<button class="btn btn-secondary" data-toggle="modal" data-target="#archiveModal_<?php echo $item['Reference']; ?>">change</button>
						</div>
					</td>
			</tr>
        
			<?php
			endforeach;
			?>
			</tbody>
            
      	</table>


            <!-- Modal -->
            <div class="modal fade" id="editpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modify Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="modp.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="reference" class="form-label">Reference</label>
                            <input type="text"  class="form-control" id="reference" name="reference" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="barcode" class="form-label">Barcode</label>
                            <input type="text" class="form-control" id="barcode" name="barcode" required>
                        </div>
                        <div class="mb-3">
                            <label for="label" class="form-label">Label</label>
                            <input type="text" class="form-control" id="label" name="label" required>
                        </div>
                        <div class="mb-3">
                            <label for="purchasePrice" class="form-label">Purchase Price</label>
                            <input type="number" class="form-control" id="purchasePrice" name="purchasePrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="finalPrice" class="form-label">Final Price</label>
                            <input type="number" class="form-control" id="finalPrice" name="finalPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="priceOffer" class="form-label">Price Offer</label>
                            <input type="number" class="form-control" id="priceOffer" name="priceOffer" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <div class="mb-3">
                            <label for="minQuantity" class="form-label">Min Quantity</label>
                            <input type="number" class="form-control" id="minQuantity" name="minQuantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="stockQuantity" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" id="stockQuantity" name="stockQuantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="save_changes">Save changes</button>
                    </form>
                </div>
                </div>
            </div>
            </div>



          <h1 class="display-6 my-5 text-black mx-auto text-center" id="gg">Add Product </h1>
		<section id="forma" class="container w-75">
        <form action="addp.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="reference" class="form-label">Reference</label>
                <input type="text" class="form-control" id="reference" name="reference" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="barcode" class="form-label">Barcode</label>
                <input type="text" class="form-control" id="barcode" name="barcode" required>
            </div>
            <div class="mb-3">
                <label for="label" class="form-label">Label</label>
                <input type="text" class="form-control" id="label" name="label" required>
            </div>
            <div class="mb-3">
                <label for="purchasePrice" class="form-label">Purchase Price</label>
                <input type="number" class="form-control" id="purchasePrice" name="purchasePrice" required>
            </div>
            <div class="mb-3">
                <label for="finalPrice" class="form-label">Final Price</label>
                <input type="number" class="form-control" id="finalPrice" name="finalPrice" required>
            </div>
            <div class="mb-3">
                <label for="priceOffer" class="form-label">Price Offer</label>
                <input type="number" class="form-control" id="priceOffer" name="priceOffer" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="mb-3">
                <label for="minQuantity" class="form-label">Min Quantity</label>
                <input type="number" class="form-control" id="minQuantity" name="minQuantity" required>
            </div>
            <div class="mb-3">
                <label for="stockQuantity" class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" id="stockQuantity" name="stockQuantity" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
		</section>
    
        <section class="section-products">
            <div class="container">
                    <div class="row justify-content-center text-center">
                            <div class="col-md-8 col-lg-6">
                                    <div class="header">
                                            <h2 id="here">Users Management</h2>
                                    </div>
                            </div>
                    </div>

                    <?php
                        $sql = "SELECT * FROM user";
                        $result = $conn->query($sql);
                        $usrs = $result->fetch_all(MYSQLI_ASSOC);
                        // var_dump($usrs);
                        // exit;
                    ?>

                    <table class="table container">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($usrs as $user) :
                            ?>
                            <tr>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['bl'] == 1 ? "Verified" : "Unverified" ?></td>
                                <form action="ver.php" method="post">
                                    <input type="hidden" name="username" value="<?= $user['username'] ?>">
                                    <input type="hidden" name="currentStatus" value="<?= $user['bl'] ?>">
                                    <td>
                                        <button type="submit" class="btn btn-success" name="switch">Verify/Unverify</button>
                                    </td>
                                </form>
                                <td>
                                    <form action="del.php" method="post">
                                        <input type="hidden" name="identifiant" value="<?= $user['identifiant'] ?>">
                                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="prom.php" method="post">
                                        <input type="hidden" name="identifiant" value="<?= $user['identifiant'] ?>">
                                        <input type="hidden" name="username" value="<?= $user['username'] ?>">
                                        <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                        <input type="hidden" name="pass" value="<?= $user['pass'] ?>">
                                        <button type="submit" class="btn btn-warning" name="prom">Promote</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
            </div>
        </section>

                    <!-- admins -->

        <section class="section-products">
            <div class="container">
                    <div class="row justify-content-center text-center">
                            <div class="col-md-8 col-lg-6">
                                    <div class="header">
                                            <h2 id="here">Admins</h2>
                                    </div>
                            </div>
                    </div>

                    <?php
                        $sql = "SELECT * FROM admin";
                        $result = $conn->query($sql);
                        $admns = $result->fetch_all(MYSQLI_ASSOC);
                        // var_dump($usrs);
                        // exit;
                    ?>

                    <table class="table container">
                        <thead>
                            <tr>
                                <th>identifiant</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($admns as $admin) :
                            ?>
                            <tr>
                                <td><?= $admin['identifiant'] ?></td>
                                <td><?= $admin['email'] ?></td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
            </div>
        </section>
        
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
        const gg = document.getElementById('gg');
        const fo = document.getElementById('forma');
        const wa = document.querySelectorAll('.wa');
    
    // for (var i = 0; i < wa.length; i++) {
    //     wa[i].addEventListener('click', function () {
    //         alert(this.value);
    //     });
    // }
        gg.addEventListener('click', function() {
        if (fo.classList.contains('no')) {
                fo.classList.remove('no');
            } else {
                fo.classList.add('no');
        }
        });
       

        // modify(reference){
        // console.log(reference);
        // }
    </script>
</body>
</html>