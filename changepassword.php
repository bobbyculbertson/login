<?php
$title = "Admin Section - Delete User";
require 'includes/head.php';
if ($_SESSION['access'] !=2) {
	header('Location: index.php');
}
?><div id="chest">
	<div id="center-content">
		<br> <br> <img src="images/conveyor_design.png" alt="Conveyor Design" /><br>
		<br> <br>
	</div>
	<form method="post" action="changepassword.php">
		<table>
			<?php 		
			$results = userByID($_SESSION['editID']);
			while ($row = $results->fetch_array()) {
				echo '<tr>';
				echo '<td>User ID</td>';
				echo '<td>'.$row['id'].'</td></tr>';
				echo '<tr>';
				echo '<td>Name</td><td>'.$row['name'].'</td></tr>';
				echo '<tr>';
				echo '<td>Username</td><td>'.$row['username'].'</td></tr>';
				echo '<tr>';
				echo '<td>New Password</td>';
				echo '<td><input type="password" name="password1"></td></tr>';
				echo '<tr>';
				echo '<td>Confirm Password</td>';
				echo '<td><input type="password" name="password2"></td></tr>';
				echo '<td><input type="submit" name="changepassword" value="Change Password"></td>';
				echo '<td><a href="admin.php"><input type="button" value="Cancel"></a></td></tr>';

			}
			?>
			
		</table>
		<input type="hidden" name="validation">
	</form>

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
if ((isset($_POST['password1']) && isset($_POST['password2']))) {
	$pass			= strip_tags(trim($_POST['password1']));
	$pass2			= strip_tags(trim($_POST['password2']));
	$editID			= strip_tags(trim($_SESSION['editID']));
	//Checks to see if passwords match
	if ($pass == $pass2) {
		//Adds salt to password
		$password = $salt.$pass;
		//Hashes the new password that includes the salt
		$password = hash(sha256,$password);
		$changeResult = changePassword($editID, $password, $salt);
		echo $changeResult;
	} else {
		echo "Passwords do not match. Please Try again";
	}
}

?>