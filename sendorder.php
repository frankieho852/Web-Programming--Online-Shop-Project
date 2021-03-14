<?php

$servername = "localhost";
$username = "user2297";
$password = "cyra9hacyz";
$dbname = "2297_db";


$conn = new mysqli($servername, $username, $password, $dbname);


$lastname = $_POST["lastname"];
$firstname = $_POST["firstname"];
$email = $_POST["email"];
$phone = $_POST["phonenumber"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$regions_hk = $_POST["regions_hk"];

$name = $lastname . ", " . $firstname;
$address = $address1 . ", " . $address2 . ", " . $regions_hk;


$query = "INSERT INTO hkorder(name, email, phone, address) 
             VALUES (?,?,?,?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("ssds", $name, $email, $phone, $address);

$stmt->execute();
$stmt->close();
$conn->close();



?>
<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

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
                        <a class="nav-link" href="/home.php" id="homebtn">Home<span class="sr-only">(current)</span></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row" style="padding-top:25vh">
            <label class="mx-auto"> The order was received Successfully, Please click the buttom to contiue shopping</label>
        </div>
        <div class="row ">
            <a class="btn btn-success mx-auto id="clickC" href="cart.php?action=remove">Go Back on Shopping site</a>
        </div>




    </div>
    <div class="container">



    </div>
</body>

</html>