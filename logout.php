<?php
session_start();
$conn = mysqli_connect("localhost","root","shopninja","shopsmart");
$registerquery = mysqli_query($conn,"DELETE FROM cart where uid ='" . $_SESSION['uid'] . "'");
if(!empty($_SESSION["cart_item"])){
	//insert/update into cart table;
	foreach($_SESSION["cart_item"] as $k => $v) {
		$i_name = $v["name"];
		$uid = $_SESSION["uid"];
		$qty = $v["quantity"];
		$registerquery = mysqli_query($conn,"INSERT INTO cart (uid,item_name,quantity) VALUES ('".$uid."','".$i_name."','".$qty."')");
	}
}
unset($_SESSION);
session_destroy();
echo "<p><strong>Logout successful. </strong>Please <a href=\"welcome.php\">click here to login</a>.</p>";

?>
