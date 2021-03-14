<?php


$servername = "localhost";
$username = "user2297";
$password = "cyra9hacyz";
$dbname = "2297_db";


$conn = new mysqli($servername, $username, $password, $dbname);

$size = $_GET["size"];
$quantity = $_GET["quantity"];
$pid = $_GET["pid"];
$name = $_GET["name"];
$photo = $_GET["photoAddress"];
$price = $_GET["price"];

$query = "INSERT INTO tempcart(size, quantity, pid, name, photo, price) 
         VALUES (?,?,?,?,?,?)";
$query1 = "INSERT INTO tempcart1(size, quantity, pid, name, photo, price) 
VALUES (?,?,?,?,?,?)";

$stmt = $conn->prepare($query);
$stmt1 = $conn->prepare($query1);
$stmt->bind_param("sssssd", $size, $quantity, $pid, $name, $photo, $price);
$stmt1->bind_param("sssssd", $size, $quantity, $pid, $name, $photo, $price);

$stmt->execute();
$stmt1->execute();
$stmt->close();
$stmt1->close();
$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
	<TITLE>Shopping cart</TITLE>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
	<!--navbar here -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<span class="navbar-brand">ABC SHOP</span>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="/home.php" id="homebtn">Home <span class="sr-only">(current)</span></a>
					</li>

				</ul>

			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row" style="padding-top:25vh">
			<label class="mx-auto">Add item to shopping cart Successfully, Please click the buttom to continue shopping. </label>
		</div>
		<div class="row ">
			<a class="btn btn-success mx-auto " href="home.php" role="button">CLICK ME</a>
		</div>
	</div>

</body>

</html>