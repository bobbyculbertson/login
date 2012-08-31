<?php
$title = "Admin Section - Edit User";
require 'includes/head.php';
if ($_SESSION['access'] !=2) {
	header('Location: index.php');
}
?>
<div id="chest">
	<div id="center-content">
		<br> <br> <img src="images/conveyor_design.png" alt="Conveyor Design" /><br>
		<br> <br>
	</div>
	<form method="post" action="edituser.php">
		<table>
			<?php 		
			$results = userByID($_SESSION['editID']);
			while ($row = $results->fetch_array()) {

				echo '<tr>';
				echo '<td>User ID</td>';
				echo '<td>'.$row['id'].'</td></tr>';
				echo '<tr>';
				echo '<td>Name</td><td><input type="text" name="new_name" value="'.$row['name'].'"size="35"></td></tr>';
				echo '<tr>';
				echo '<td>Email</td><td><input type="text" name="new_email" value="'.$row['email'].'"size="35"></td></tr>';
				echo '<tr>';
				echo '<td>Username</td><td><input type="text" name="new_username" value="'.$row['username'].'"size="35"></td></tr>';
				echo '<tr>';
				echo '<td>Access Rights</td>';
				echo "<td><select name='new_access'>";
				echo '<option value="1"';
				if ($row['access']==1) {
					echo 'selected="selected"';
				}
				echo '>Student</option>';
				echo '<option value="2"';
				if ($row['access']==2) {
					echo 'selected="selected"';
				}
				echo '>Administrator</option>';
				echo '</select></td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><input type="submit" name="editrecord" value="Save Changes"></td>';
				echo '<td><a href="admin.php"><input type="button" value="Cancel"></a></td></tr>';

			}
			?>
			
		</table>
		<input type="hidden" name="validation">
	</form>
	<?php 
	if (isset($_POST['validation'])){
	$newName		= trim($_POST['new_name']);
	$newEmail		= trim($_POST['new_email']);
	$newUsername	= trim($_POST['new_username']);
	$newAccess		= trim($_POST['new_access']);
	$result = editUser($newUsername,$newAccess, $newName, $newEmail, $_SESSION['editID']);
	echo $result;
}
?>


	<?php 
	include 'includes/foot.php';
	?>