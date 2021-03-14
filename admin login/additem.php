<?php


// read the xml file into a dom structure
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false; // remove whitespace nodes 
$xml->load("../products.xml");

// retrieve the get request values
$name = $_POST["name"];
$color = $_POST["color"];
$description = $_POST["description"];
$origin = $_POST["origin"];
$photoAddress = $_POST["photoAddress"];
$price = $_POST["price"];
$sex = $_POST["sex"];
$category = $_POST["category"];

function validateFields()
{
    global $xml, $name;

    // check if the name has been taken
    $names = $xml->getElementsByTagName("name");
    foreach ($names as $node) {
        if ($node->nodeValue == trim($name)) {
            return "This product already exists!";
            break;
        }
    }
    return "Successful";
}

// validate the  product name
$error = validateFields();

// show the error or add the new pokemon
if ($error == "Successful") {
    global $error;
    // get the correct generation
    $target = null;

    $sexes = $xml->getElementsByTagName($sex)[0];
    $target = $sexes->getElementsByTagName($category)[0];

    // add the new item
    $temp_tap;

    if ($category == "tops") {
        $temp_tap = "top";
    } else if ($category == "pants") {
        $temp_tap = "pant";
    }


    if ($_FILES && is_uploaded_file($_FILES["photofile"]["tmp_name"])) {
        if (!move_uploaded_file(
            $_FILES["photofile"]["tmp_name"],
            "../photos/" . $_FILES["photofile"]["name"]
        )) {
            $error += "& Failed to move uploaded file successfully.";
        }
    } else {
        $error += "& File is not properly uploaded.";
    }

    $totalnumber =  (int) ($xml->getElementsByTagName("totalitem")[0]->nodeValue) + 1;
    $xml->getElementsByTagName("totalitem")[0]->nodeValue = $totalnumber;
    $products = $xml->createDocumentFragment();
    $products->appendXML("<$temp_tap pid=\"$totalnumber\"><name>$name</name><color>$color</color><description>$description</description><origin>$origin</origin><photo>$photoAddress</photo><price>$price</price></$temp_tap>");
    $target->appendChild($products);

    $xml->save("../products.xml");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add item status</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script>
        $(document).ready(function() {
            $("#backbtn").on("click", function() {
                window.location = window.location.protocol + "//" + window.location.host + "/addItem.html";
            })

        });
    </script>
</head>

<body>
    <!--navbar here -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">ABC SHOP - Admin Console</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="\index.php" id="homebtn">Dashboard<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="\addItem.html" id="addbtn">Add Product <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <a class="btn btn-outline-info" href="..\index.php" role="button">Logout</a>
            </div>

        </div>
    </nav>
    <div class="container">
		<div class="row" style="padding-top:25vh">
			<label class="mx-auto"><?= $error ?></label>
		</div>
		<div class="row">
			<a class="btn btn-success mx-auto " href="./additem.html" role="button">BACK</a>
		</div>
	</div>
    
</body>

</html>