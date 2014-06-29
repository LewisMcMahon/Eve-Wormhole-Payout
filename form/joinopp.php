<?
	//Has all the functions in it
	require_once "../inc/functions.php";
	
	//Sets errors
	errors_set();
	
	//Sets header info into an array
	set_header_info_aray();

	$opp_id = $_POST['oppid'];
	$opp_password = $_POST['password'];
	
	$exists = opp_exists($opp_id,$opp_password);
	
	if ($exists == true)
	{
		set_opp_cookie($opp_id,$opp_password);
		header('Location: ../index.php?page=oppinfo&oppid='.$opp_id);
	}
	else if ($exists == false)
	{
		header('Location: ../index.php?page=joinopp&error=unkown');
	}		
		
?>