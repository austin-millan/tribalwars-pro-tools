<?php
	$sql_server='top_secret';
	$sql_database='top_secret';

	$mysqli_connection = mysqli_connect($sql_server, 'top_secret', 'top_secret.', $sql_database);

	if (!$mysqli_connection)
		echo "databse connetction error";
?>
