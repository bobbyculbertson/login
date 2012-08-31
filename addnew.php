
<?php
$title = "Register New User";
require 'includes/head.php';
?>
<div id="chest">
	<div id="center-content">
		<br> <br> <img src="images/conveyor_design.png" alt="Conveyor Design" /><br>
		<br> <br>
		<a href="admin.php">Back to Admin Section</a>
		<br><br>
		<form action="addnew.php" method="post">
			<table>
				<tr>
					<td>Name</td>
					<td><input type="text" name="name"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="email"></td>
				</tr>
				
				<tr>
					<td>Username</td>
					<td><input type="text" name="username" /></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password" /></td>
				</tr>
				<tr>
					<td>Confirm Password</td>
					<td><input type="password" name="password2" /></td>
				</tr>
				<tr>
					<td><select name="access" id="access">
							<option value="1">Student</option>
							<option value="2">Administrator</option>
					</select>
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="Add User" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php
//Funtion develops a random Alpha-Numeric String
function generateRandomString($length = 32) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}
$salt= generateRandomString();
//Checks to see is form has been submitted
if ((isset($_POST['username']) && isset($_POST['password']))) {
	$pass			= strip_tags(trim($_POST['password']));
	$pass2			= strip_tags(trim($_POST['password2']));
	//Checks to see if passwords match
	if ($pass == $pass2) {
		$username		= strip_tags(trim($_POST['username']));
		//Checks to make sure a username has been submitted
		if ($username == "") {
		echo "Please include a username";
		} else {
		$name			= strip_tags(trim($_POST['name']));
		$email			= strip_tags(trim($_POST['email']));
		$access			= strip_tags(trim($_POST['access']));
		//Adds salt to password
		$password = $salt.$pass;
		//Hashes the new password that includes the salt
		$password = hash(sha256,$password);
		$addResult = adduser($username, $password, $access, $salt, $name, $email);
		echo $addResult;
		}
	} else {
		echo "Passwords do not match. Please Try again";
	}
}
?>

<?php
include 'includes/foot.php'
?>