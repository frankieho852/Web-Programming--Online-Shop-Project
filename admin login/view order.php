<?php
session_start();
require_once("dbcontrollerOrder.php");
$db_handle = new DBController();



$productByCode = $db_handle->runQuery("SELECT * FROM tempcart1");
$productByCode1 = $db_handle->runQuery("SELECT * FROM hkorder");


		
?>


<HTML>
<HEAD>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="shopping-cart">
<div class="txt-heading">Order View</div>


<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Size</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    for ($x = 0; $x < sizeof($productByCode); $x++) {
		
	  
        $item_price = $productByCode[$x]["quantity"]*$productByCode[$x]["price"];
		?>
				<tr>
				<td><img src="<?php echo $productByCode[$x]["photo"]; ?>" class="cart-item-image" /><?php echo $productByCode[$x]["name"]; ?></td>
				<td><?php echo $productByCode[$x]["size"]; ?></td>
				<td style="text-align:right;"><?php echo $productByCode[$x]["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$productByCode[$x]["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				</tr>
				<?php
				$total_quantity += $productByCode[$x]["quantity"];
				$total_price += ($productByCode[$x]["price"]*$productByCode[$x]["quantity"]);
		}
		?>


</tbody>
<tr>
<td colspan="2" text-align="right">Total:</td>
<td text-align="right"><?php echo $total_quantity; ?></td>
<td text-align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>


</table>
 
</div>

<div id="product-grid">
	<div class="txt-heading">Customer details</div>
	<?php
	
		for ($x = 0; $x < sizeof($productByCode1); $x++) {
	?>
		<div class="product-item">
		<div class="product-title"><?php echo $productByCode1[$x]["name"]; ?></div>
		<td style="text-align:right;"><div class="product-title"><?php echo $productByCode1[$x]["email"]; ?></div></td>
        <td style="text-align:right;"><div class="product-title"><?php echo $productByCode1[$x]["phone"]; ?></div></td>
        <td style="text-align:right;"><div class="product-price"><?php echo "$".$productByCode1[$x]["address"]; ?></div></td>
        </br>
			</div>
			
            <?php
	
        }
        ?>

	
</div>

</BODY>
</HTML>