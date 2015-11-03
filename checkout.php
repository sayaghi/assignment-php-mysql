<?php
session_start();
$conn = mysqli_connect("localhost","root","shopninja","shopsmart");
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "buy":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
				if($_GET["code"] == $k){
					$cost = $v["quantity"] * $v["price"];
					$purid = $v["id"]; 
					$purdate = date("Y-m-d");
					$uname = $_SESSION["username"];
					$registerquery = mysqli_query($conn,"INSERT INTO purchase (prod_id, pur_date, cost, uname) VALUES('".$purid."','".$purdate."','".$cost."','".$uname."')");
					if($registerquery){
						unset($_SESSION["cart_item"][$k]);	
					}
					else{
						echo "Purchase Failed";
					}
					if(empty($_SESSION["cart_item"])){
						unset($_SESSION["cart_item"]);
					}
				}
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
<TITLE>Shopping Cart - check out</TITLE>
</HEAD>
<BODY>
<div id="shopping-cart">
<div class="txt-heading"><h1>Shopping Cart </h1><a id="btnEmpty" href="checkout.php?action=empty"><b>Empty Cart</b></a> <a href="logout.php"><center><b>LogOut</b></center></a></div>


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
<th><strong>Buy Now</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $key=>$item){
?>
		<tr>
		<td><strong><?php echo $item["name"]; ?></strong></td>
		<td><?php echo $item["quantity"]; ?></td>
		<td align=right><?php echo "$".$item["price"]; ?></td>
		<?php $id = "id"; ?>
		<td><a href="checkout.php?action=buy&code=<?php echo $key; ?>" class="BuyAction">Buy</a></td>
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
</BODY>
</HTML>
