<?php
$title = "Admin Login";
require 'includes/head.php';
?>
<div id="chest">
	<div id="center-content">
		<br><br>
		<img src="images/conveyor_design.png" alt="Conveyor Design"/><br><br><br>
		<form action="login.php" method="post">
			<table>
				<tr>
					<td><a href="http://siu.superior-ind.com">Back to SIU</a></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="username"/></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password"/></td>
				</tr>
				<tr>
					<td><input type="submit" value="Login"/></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php
//Checks to see is form has been submitted
if (isset($_POST['username']) and isset($_POST['password'])) {
	$username		= strip_tags(trim($_POST['username']));
	$password		= strip_tags(trim($_POST['password']));
	//Checks to make sure both fields are filled in
	if ($username == "" || $password == "") {
		echo "Not enough information provided. Please try again";
	} else {	
		check_login($username, $password);
	}
}
?>
		
<?php
include 'includes/foot.php'
?>
