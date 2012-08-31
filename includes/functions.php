<?php
include 'includes/db_functions.php';
session_start();

function check_login($username, $password){
	$results = call("SELECT * from users WHERE username = '$username' LIMIT 1;");
	if (!$results) {
		echo "<div><strong>Error:</strong> login failed. Please try again.</div>";
	} else {
		foreach ($results as $result) {
			$user_id = $result['id']; $user_username = $result['username']; $user_password=$result['password']; $user_salt= $result['salt']; $user_name = $result['name']; $user_email = $result['email']; $user_access = $result['access'];
		}
		$compare_password = hash(sha256,$user_salt.$password);
		if ($compare_password == $user_password) {
			session_destroy();
			session_start();

			$_SESSION['id']					= $user_id;
			$_SESSION['username'] 			= $user_name;
			$_SESSION['name'] 				= $user_name;
			$_SESSION['email']				= $user_email;
			$_SESSION['access']				= $user_access;
			$user_password 					= null;
			$user_salt 						= null;
			//header('Location: ../sample-page');
			header('Location: index.php');

		} else {
			echo "<div><strong>Error:</strong> login failed. Please try again.</div>";
		}
	}
}
function call_allusers() {
	$results = call_users("SELECT * FROM users ORDER BY name");
	if (count($results)==0) {
		echo "Problem with Database Query. Reload Page";
	} else {
		return $results;
	}
}
		 
function adduser($username, $password, $access, $salt, $name, $email) {
	$results = call_users("INSERT INTO users (username, password, access, salt, name, email) 
			VALUES ('$username', '$password', '$access', '$salt', '$name', '$email')");
	if (!$results) {
		$message ="There was an error. User not added. Please try again later.";
	} else {
		$message = "User Added Successfully";
	}
	return $message;
}

function userByID($editID) {
	$results = call_users("SELECT * FROM users WHERE id = $editID");
	if (count($results)==0) {
		echo "Problem with selected user. Please try again";
	} else {
		return $results;
	}
}

function editUser($newUsername,$newAccess, $newName, $newEmail, $editID) {
	$results = call_users("UPDATE users SET username='$newUsername', access='$newAccess', name='$newName', email='$newEmail' WHERE id='$editID'");
	if(!$results) {
		$message = "User was not updated. Please try again";
	} else {
		$message = "User Updated Successfully. <a href='admin.php'>Return to Admin Page</a>";
	}
	return $message;
}


function deleteUser($editID){
	$results = call_users("DELETE FROM users WHERE id=$editID");
	if (!$results){
		$message = "User was not deleted. Please try again";
	} else {
		$message = "User was Deleted <a href='admin.php'>Return to Admin Page</a>";
	}
	return $message;
}

function changePassword($editID, $password, $salt) {
	$results = call_users("UPDATE users SET password='$password', salt='$salt' WHERE id=$editID");
	if(!$results) {
		$message = "Password was not changed. Please try again";
	} else {
		$message = "Password changed Successfully. <a href='admin.php'>Return to Admin Page</a>";
	}
	return $message;
	}
?>