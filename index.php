<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM products WHERE id='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["id"]=>array('name'=>$productByCode[0]["name"], 'id'=>$productByCode[0]["id"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
			if(!empty($_SESSION["cart_item"])) {
				$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>Shopping Cart</TITLE>
</HEAD>
<BODY>
<div id="shopping-cart">
<div class="txt-heading"><h1>Shopping Cart </h1><a id="btnEmpty" href="index.php?action=empty"><b>Empty Cart</b></a> <a href="checkout.php"><center><b>Check Out</b></center></a></div>


<?php
if(isset($_SESSION["cart_item"])){
	$item_total = 0;
	$_SESSION["total_amt"] = 0;
?>	
<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th><strong>Name</strong></th>
<th><strong>Quantity</strong></th>
<th><strong>Price</strong></th>
<th><strong>Action</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $key=>$item){
?>
		<tr>
		<td><strong><?php echo $item["name"]; ?></strong></td>
		<td><?php echo $item["quantity"]; ?></td>
		<td align=right><?php echo "$".$item["price"]; ?></td>
		<td><a href="index.php?action=remove&code=<?php echo $key; ?>" class="btnRemoveAction">Remove Item</a></td>
		</tr>
		<?php
        	$item_total += ($item["price"]*$item["quantity"]);
		$_SESSION["total_amt"] = $item_total;	
	}
	?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
</tr>
</tbody>
</table>		
  <?php
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading"><h1>Products</h1></div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM products ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<?php $id = "id"; ?>
			<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key][$id]; ?>">
			<div><strong><?php echo $product_array[$key]["name"]; ?></strong> <?php echo "<p>Rs.".$product_array[$key]["price"]."</p>"; ?> </div>
			<div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
</div>
</BODY>
</HTML>
