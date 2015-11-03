<?php
//session_start();

$conn = mysqli_connect("localhost","root","shopninja","shopsmart");
if (!$conn) {
echo "Error connection!!! errno: " . mysqli_connect_errno() . PHP_EOL;
}
mysqli_autocommit($conn, TRUE);
if(!empty($_POST['username']) && !empty($_POST['password']))
{
if (!preg_match("/^[a-zA-Z0-9 ]*$/",$_POST['username'])){
?>
<p>Username cannot contain special characters!! <a href="register.php">click here to retry</a>. </p>
<?php
}
else{
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$dob = $_POST['dob'];
if($checkusername = mysqli_query($conn,"SELECT * FROM user WHERE username = '".$username."'")){
$row  = mysqli_fetch_array($checkusername);
if(mysqli_num_rows($checkusername) == 1)
{
?>
<p>Sorry, that username is taken. Please try a different one. <a href="register.php">click here to retry</a>. </p>
<?php
}
elseif (mysqli_num_rows($checkusername) == 0) {
$registerquery = mysqli_query($conn,"INSERT INTO user (username, dob, auth_key) VALUES('".$username."', '".$dob."', '".$password."')");
if($registerquery)
{
echo "$username";
?>
<p>Registered Successfully!! <a href="welcome.php">Click here to login</a>. </p>
<?php
}
else
{
echo "<h1>Error</h1>";
echo "<p>Sorry, your registration failed. Please try again.</p>";    
}       
}
}
}
}
else{
?>
<html>
<head>
<title>User Registration</title>
</head>
<body>
<form method="post" action="">
<table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
<tr class="tableheader">
<td align="center" colspan="2">Enter Login Details</td>
</tr>
<tr class="tablerow">
<td align="right">Username</td>
<td><input type="text" name="username" required></td>
</tr>
<tr class="tablerow">
<td align="right">Date Of Birth</td>
<td><input type="date" name="dob"></td>
</tr>
<tr class="tablerow">
<td align="right">Password</td>
<td><input type="password" name="password" required></td>
</tr>
<tr class="tableheader">
<td align="center" colspan="2">
<input type="submit" name="submit" value="Register"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
}
?>
