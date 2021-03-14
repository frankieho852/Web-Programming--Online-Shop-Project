<?php
session_start();
require_once("dbcontrollerOrder.php");
$db_handle = new DBController();

$productByCode = $db_handle->runQuery("SELECT * FROM tempcart1");
$productByCode1 = $db_handle->runQuery("SELECT * FROM hkorder");
		
?>

<!DOCTYPE html>
<html>

<head>
  <title>Dashboard - Online Shop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="style.css" type="text/css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

  <script>
    $(document).ready(function () {


    });
  </script>

</head>

<body>
  <!--navbar here -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <span class="navbar-brand">ABC SHOP - Admin Console</span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" id="homebtn">Dashboard<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./additem.html" id="addbtn">Add Product <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <a class="btn btn-outline-info" href="../index.php" role="button">Logout</a>
      </div>

    </div>
  </nav>

  <!-- This is the div for showing the item list -->
  <div id="Content" class="container">
    <h2 style="padding-top:5vh">Order Review</h2>
    <div id="shopping-cart">


      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="text-left">Name</th>
            <th scope="col" class="text-left">Size</th>
            <th scope="col" class="text-right">Quantity</th>
            <th scope="col" class="text-right">Unit Price</th>
            <th scope="col" class="text-right">Price</th>
          </tr>
        </thead>
        <tbody>

          <?php		
        for ($x = 0; $x < sizeof($productByCode); $x++) {
		
	  
        $item_price = $productByCode[$x]["quantity"]*$productByCode[$x]["price"];
		    ?>
          <tr>
            <td><img src="../photos/<?php echo $productByCode[$x]["photo"]; ?>"
                class="cart-item-image" /><?php echo $productByCode[$x]["name"]; ?></td>
            <td><?php echo $productByCode[$x]["size"]; ?></td>
            <td class="text-right"><?php echo $productByCode[$x]["quantity"]; ?></td>
            <td class="text-right"><?php echo "$ ".$productByCode[$x]["price"]; ?></td>
            <td class="text-right"><?php echo "$ ". number_format($item_price,2); ?></td>
          </tr>
          <?php
				$total_quantity += $productByCode[$x]["quantity"];
				$total_price += ($productByCode[$x]["price"]*$productByCode[$x]["quantity"]);
		}
		?>
        </tbody>
        <caption>Total Income: <?php echo "$ ".number_format($total_price, 2); ?></caption>
        <caption>Sales Volume: <?php echo $total_quantity; ?> piece(s)</caption>

      </table>

      <h2>Customer details</h2>

      <table class="table">
        <thead>
          <tr>
            <th scope="col" >Name</th>
            <th scope="col" >Email</th>
            <th scope="col" >Phone</th>
            <th scope="col" >Shipping Address</th>
          </tr>
        </thead>
        <tbody>
          
          <?php
      
            for ($x = 0; $x < sizeof($productByCode1); $x++) {
          ?>

          <tr>
            <td><?php echo $productByCode1[$x]["name"]; ?></td>
            <td><?php echo $productByCode1[$x]["email"]; ?></td>
            <td><?php echo $productByCode1[$x]["phone"]; ?></td>
            <td><?php echo $productByCode1[$x]["address"]; ?></td>
          </tr>

          <?php } ?>
        
        <tbody>
      </table>

  </div>
 
</div>

</body>

</html>