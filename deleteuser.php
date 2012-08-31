<?php

$title = "Admin Section - Delete User";
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
	<form method="post" action="deleteuser.php">
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
				echo '<td>Email</td><td>'.$row['email'].'</td></tr>';
				echo '<tr>';
				echo '<td>Username</td><td>'.$row['username'].'</td></tr>';
				echo '<tr>';
				echo '<td>Access Rights</td>';
				echo "<td>";
				if ($row['access']==1) {
					echo "Student</td>";
				}elseif ($row['access']==2) {
					echo "Administrator</td>";
				}
				echo '</tr>';
				echo '<tr>';
				echo '<td><input type="submit" name="areYouSure" value="Delete User"></td>';
				echo '<td><a href="admin.php"><input type="button" value="Cancel"></a></td></tr>';

			}
			?>
		</table>
		<input type="hidden" name="validation">
	</form>
<?php 
if (isset($_POST['validation'])) {
	
	echo '<form method="post" action="deleteuser.php">';
	echo '<p>Are you sure you want to delete this user?</p>';
	echo '<input type="submit" name="delete" value="Yes"><a href="admin.php"><input type="button" value="Cancel"></a>';
	echo '<input type="hidden" name="validation2">';
	echo '</form>';
	
}
if (isset($_POST['validation2'])) {
	$editID = $_SESSION['editID'];
	$results = deleteUser($editID);
	echo $results;
}

?>
<?php 
include 'foot.php';
?>