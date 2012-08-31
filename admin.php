<?php
$title = "Admin Section";
require 'includes/head.php';
?>
<div id="chest">
	<div id="center-content">
		<br> <br> <img src="images/conveyor_design.png" alt="Conveyor Design" /><br>
		<br> <br>
	</div>
		<form action="admin.php" method="post">
			<table>
				<tr>
					<td><input type="submit" name="user_action" value="Add User" /></td>
				</tr>
				<tr>
					<td>
					<select name="users" id="users">
						<option selected="selected"></option>
						<?php 
						$result = call_allusers();
						while ($row=$result->fetch_array()) {
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
						}
						?>
					</select>
					</td>
					<td><input type="submit" name="user_action" value="Delete User" />
					</td>
					<td><input type="submit" name="user_action" value="Edit User" /></td>
					<td><input type="submit" name="user_action" value="Change Password" /></td>
				</tr>
			</table>
			<input type="hidden" name="validation">
		</form>
	</div>
</div>

<?php 
if (isset($_POST['validation'])) {
	$_SESSION['editID'] = $_POST['users'];
	switch ($_POST['user_action']){
		case 'Add User':
			header('Location: addnew.php');
			break;
		case 'Delete User':
			header('Location: deleteuser.php');
			break;
		case 'Edit User':
			header('Location: edituser.php');
			break;
		case 'Change Password':
			header('Location: changepassword.php');
			break;
}
	
}

?>