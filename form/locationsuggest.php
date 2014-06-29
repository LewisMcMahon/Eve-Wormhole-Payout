<?
	$link = mysql_connect("localhost","root","superlongpasswordthaticantrember");
	
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}


	//Has all the functions in it

	require_once "../inc/functions.php";
	

	//Sets errors

	errors_set();


	echo locationsuggest($_GET['term'],10)

?>