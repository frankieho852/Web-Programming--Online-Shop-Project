<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();



$productByCode = $db_handle->runQuery("SELECT * FROM tempcart");


if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "remove":
            $qq = $_GET["name"];
            $sql = ("DELETE FROM tempcart WHERE name = '" . $qq . "'");
            $sql1 = ("DELETE FROM tempcart WHERE name = '" . $qq . "'");
            $db_handle->connectDB()->query($sql);
            $db_handle->connectDB()->query($sql1);

            break;
        case "empty":
            $db_handle->connectDB()->query($sql);
            $sql = ("DELETE FROM tempcart");
            $db_handle->connectDB()->query($sql);
            break;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#cancelbtn").on("click", function() {
                var url = window.location.protocol + "//" + window.location.host + "/home.php";
                console.log(url);
                window.location = url;
                return false;
            });
        });
    </script>

    <style>
        hr.divider1 {
            border: 0;
            height: 1px;
            background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
        }

        #bag {
            background-color: lightgray;
            padding: 5vh 5vw;
            width: 40%;
        }

        .cart-item-image {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: #E0E0E0 1px solid;
            padding: 5px;
            vertical-align: middle;
            margin-right: 15px;
        }
    </style>

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
                        <a class="nav-link" href="/home.php" id="homebtn">Back to Lobby<span class="sr-only">(current)</span></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div id="shopping-cart" class="container">
        <h2 style="padding-top:5vh">Shopping Cart</h2>
        <label>If you had remove the item or click the Empty Cart buttom, Please click the Refresh
            buttom for view the Cart</label>
        <div align="right">
            <a id="btnEmpty" class="btn btn-outline-danger" href="cart.php?action=empty" role="button">Empty Cart</a>
            <a id="btnEmpty" class="btn btn-outline-danger" href="cart.php" role="button">Refresh</a>
        </div>

        <?php
        $total_quantity = 0;
        $total_price = 0;
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-left">Name</th>
                    <th scope="col" class="text-left">Size</th>
                    <th scope="col" class="text-right">Quantity</th>
                    <th scope="col" class="text-right">Unit Price</th>
                    <th scope="col" class="text-right">Price</th>
                    <th scope="col" class="text-center">Remove</th>
                </tr>
            </thead>

            <tbody>
                <?php
                for ($x = 0; $x < sizeof($productByCode); $x++) {

                    $item_price = $productByCode[$x]["quantity"] * $productByCode[$x]["price"];
                ?>
                    <tr>
                        <th scope="row"><img src="photos\<?php echo $productByCode[$x]["photo"]; ?>" class="cart-item-image" /><?php echo $productByCode[$x]["name"]; ?></td>
                        <td><?php echo $productByCode[$x]["size"]; ?></td>
                        <td class="text-left"><?php echo $productByCode[$x]["quantity"]; ?></td>
                        <td class="text-left"><?php echo "$ " . $productByCode[$x]["price"]; ?></td>
                        <td class="text-left"><?php echo "$ " . number_format($item_price, 2); ?></td>
                        <td style="text-align:center;" class="align-middle"><a href="cart.php?action=remove&name=<?php echo $productByCode[$x]["name"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                    </tr>
                <?php
                    $total_quantity += $productByCode[$x]["quantity"];
                    $total_price += ($productByCode[$x]["price"] * $productByCode[$x]["quantity"]);
                }
                ?>
            </tbody>
            <tr>
                <th scope="row">Total:</th>
                <td></td>
                <td><?php echo $total_quantity; ?></td>
                <td></td>
                <td><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="container" style="padding-bottom:5vh;padding-top:5vh">

        <form action="sendorder.php" target="_blank" method="post">

            <div class="row col">
                <div class="form-group col-md-4">
                    <label>First name</label>
                    <input type="text" class="form-control" name="firstname" placeholder="First name" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Last name</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" required>
                    <br>
                </div>
            </div>

            <hr class="divider1">
            <div class="form-group col-md-4">
                <label>Order Contact</label>
            </div>
            <div class="form-group col-md-4" name="email">
                <label>Email Address</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group col-md-4" name="phone">
                <label>Phone number</label>
                <input type="text" class="form-control" name="phonenumber" required>
                <br>
            </div>

            <hr class="divider1">

            <div class="form-group col-md-4">
                <label>Shipping Address</label>
            </div>

            <div class="form-group col-md-3" name="hkplace">
                <label id="HKRegionsTitle" style="display:none;">Hong Kong Regions</label>
                <select class="custom-select mr-sm-2" name="regions_hk" id="regions_hk" required>
                    <option value="">Choose...</option>
                    <option value="NT">New Territories</option>
                    <option value="KW">Kowloon</option>
                    <option value="HK">Hong Kong Island</option>
                </select>
            </div>

            <div class="form-group col-md-6" name="address">
                <label>Address Line 1</label>
                <input type="text" class="form-control" name="address1" required>

                <label>Address Line 2</label>
                <input type="text" class="form-control" name="address2" required>
            </div>


            <div class="form-group col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" required>
                    <label class="form-check-label">Agree to terms and conditions</label>
                </div>
            </div>

            <div class="form-group col">
                <button type="button" class="btn btn-danger" id="cancelbtn">CANCEL</button>
                <button type="submit" class="btn btn-success">SUMBIT ORDER</button>
            </div>
        </form>

    </div>

</body>

</html>