<?php
$server_connection = array(	'server' 	=> 'localhost', 
							'database' 	=> 'login', 
							'un' 	=> 'bobby', 
							'pw' 	=> '!Superior.2406!');
// $server_connection = array(	'server' 	=> 'localhost',
// 		'database' 	=> 'superior_siu',
// 		'un' 	=> 'superiorsiu',
// 		'pw' 	=> 'chaz9cruNev');

//FUNCTION TO CALL QUERIES OR FUNCTIONS
//RETURNS: ARRAY OF ALL VALUES REQUESTED
function call($query) {
		
	//DECLARE ROWS AS NULL TO AVOID ERRORS
	$rows = array();	
		
	global $server_connection;
	$db = new mysqli($server_connection['server'], $server_connection['un'], $server_connection['pw'], $server_connection['database']);	
	if (mysqli_connect_errno()){
	echo "<div>'Cannot connect to database:'  .mysqli_connect_error()</div>";
	}else
	{
	$result = $db->query($query);

	//MAKE RESULT INTO ARRAY
	while($row = $result->fetch_array())
		{$rows[] = $row;}

	//CLOSE MYSQLI RESOURCES	
	$result->close();
	$db->close();	
		
	//RETURN RESULT	
	return $rows;	
}
}

//FUNCTION TO CALL QUERIES OR FUNCTIONS
//RETURNS: RESULT OF QUERY. 
function call_users($query) {
		
	global $server_connection;
	$db = new mysqli($server_connection['server'], $server_connection['un'], $server_connection['pw'], $server_connection['database']);	
	if (mysqli_connect_errno()){
	echo "<div>'Cannot connect to database:'  .mysqli_connect_error()</div>";
	}else
	{
	$result = $db->query($query);

	//CLOSE MYSQLI RESOURCES
	$db->close();	
		
	//RETURN RESULT	
	return $result;	
}	
}



?>