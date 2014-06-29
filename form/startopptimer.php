<?
	//Has all the functions in it
	require_once "../inc/functions.php";
	
	//Sets errors
	errors_set();

	$oppid = $_POST['oppid'];
	
	$opp_password = $_POST['opppassword'];
	
	$userid = $_POST['userid'];
	
	
	$timer = start_opp_timer($userid, $oppid, $opp_password);
	
	if ($timer == "true"){
	echo "true";	
	}
	if ($timer == "all ready has timer"){
	echo "all ready has timer";	
	}
	else {
		echo "no opp";
	}
?>