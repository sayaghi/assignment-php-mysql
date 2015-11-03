<HTML>
<HEAD>
<TITLE>Shopping Cart - check out</TITLE>
</HEAD>
<BODY>
<div id="Purchase-List">
<div class="txt-heading"><h1>User Details - Purchase list </h1></div>

<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
class User {
	public $id = "";
	public $username  = "";
	public $dob = "";
	public $purchase = "";
}
class Purchase {
	public $id = "";
	public $product_name = "";
	public $purchase_date = "";
	public $Cost = "";
}
$user = new User();
$purchase = new Purchase();
if(!empty($_GET["uid"]) && !empty($_GET["auth"])) {
	$result = $db_handle->runQuery("SELECT * FROM user WHERE uid='" . $_GET["uid"] . "'");
	$hash = $result[0]['auth_key'];
	if($_GET["auth"] == $hash){
		$user->id = $result[0]['uid'];
		$user->username = $result[0]['username'];
		$user->dob = $result[0]['dob'];
	}
	$uname = $result[0]['username'];
	$purchase_result = $db_handle->runQuery("SELECT * FROM purchase WHERE uname='" . $uname . "'");
	if(empty($purchase_result)){
		$user->purchase = $purchase;
		$json_output = json_encode($user);
		echo $json_output;
	}
	else{
		foreach ($purchase_result as $k => $v){
			$purchase->id = $purchase_result[$k]['pur_id'];
			$prodid = $purchase_result[$k]['prod_id'];
			$prod_result = $db_handle->runQuery("SELECT * FROM products WHERE id='" . $prodid . "'");
			$purchase->product_name = $prod_result[0]['name'];
			$purchase->purchase_date = $purchase_result[$k]['pur_date'];
			$purchase->Cost = $purchase_result[$k]['cost'];
			$pur[] = $purchase;
		}
		$user->purchase = $pur;
		$json_output = json_encode($user);
		echo $json_output;
	}
}
?>	
