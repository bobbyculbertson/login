<?php
include 'includes/functions.php';
if (!isset($_SESSION['id']) AND (basename($_SERVER["PHP_SELF"]) != 'login.php')){
	header ('Location: login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
<?php 
echo "<title>$title</title>";
?>

<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
	<div id="headerwrap">
		<ul id="toplinks">
			<?php
			if (isset($_SESSION['id'])) {
			echo "<li>Welcome, " . $_SESSION['name'] . ' ' . "<a href='logout.php'>Logout</a></li>";
			}
			if ($_SESSION['access']==2) {
				echo "<li><a href='admin.php'>Admin Section</a></li>";
			}
			?>
		</ul>
	</div>