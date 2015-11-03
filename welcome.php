<?php
session_start();
if(count($_POST)>0) {
$conn = mysqli_connect("localhost","root","shopninja","shopsmart");
if (!$conn) {
    echo "Error connection!!! errno: " . mysqli_connect_errno() . PHP_EOL;
}
if($result = mysqli_query($conn,"SELECT * FROM user WHERE username='" . $_POST["userName"] . "'")){ 
	if(mysqli_num_rows($result)==1){
		$row  = mysqli_fetch_array($result);
		if(is_array($row)) {
			$hash = $row['auth_key'];
			if(password_verify($_POST["password"], $hash)){
				$_SESSION["uid"] = $row['uid'];
				$_SESSION["username"] = $row['username'];
				$result = mysqli_query($conn,"SELECT * FROM cart WHERE uid='" . $row['uid'] . "'");
				while($row=mysqli_fetch_assoc($result)) {
					$resultset[] = $row;
				}		
				if(!empty($resultset)){
					$cart_list = $resultset;
					foreach ($cart_list as $k => $v){
						$_SESSION["cart_item"][$k]["name"] = $cart_list[$k]["item_name"];
						$name = $cart_list[$k]["item_name"];
						$result = mysqli_query($conn,"SELECT * FROM products WHERE name='" . $name . "'");
						$row  = mysqli_fetch_array($result);
						$_SESSION["cart_item"][$k]["id"] = $row['id'];
						$_SESSION["cart_item"][$k]["quantity"] = $cart_list[$k]["quantity"];
						$_SESSION["cart_item"][$k]["price"] = $row['price'];
					}
				}	
			}
			else{
				?>
				<p>Password incorrect <a href="welcome.php">click here to retry</a>. </p>
				<?php
			}
		}
	} 
	elseif(mysqli_num_rows($result)==0){
		?>
		<p>Invalid user! <a href="welcome.php">Click here to retry</a> or <a href="register.php">click here to register</a>.</p>
		<?php
	}
	if(isset($_SESSION["uid"])) {
		header("Location:index.php");
	}
}
}
else {
?>
	<html>
	<head>
	<title>User Login</title>
	</head>
	<body>
	<form method="post" action="">
	<table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
	<tr class="tableheader">
	<td align="center" colspan="2">Enter Login Details</td>
	</tr>
	<tr class="tablerow">
	<td align="right">Username</td>
	<td><input type="text" name="userName" required></td>
	</tr>
	<tr class="tablerow">
	<td align="right">Password</td>
	<td><input type="password" name="password" required></td>
	</tr>
	<tr class="tableheader">
	<td align="center" colspan="2">
	<input type="submit" name="submit" value="Login"></td>
	</tr>
	</table>
	</form>
	</body>
	</html>
<?php
}
?>
