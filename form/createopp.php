<?
	//Has all the functions in it
	require_once "../inc/functions.php";
	
	//Sets errors
	errors_set();
	
	//Sets header info into an array
	set_header_info_aray();
	
	$opp_name = $_POST['name'];
	$opp_password = $_POST['password'];
	$opp_type = $_POST['type'];
	$opp_location = $_POST['location'];
	
	if ($opp_name != "" & $opp_type != "")
	{
		//TODO Return if invalid solar system
		$create = create_opp($headerinfo['CHARID'],$opp_name,$opp_password,$opp_type,get_solar_system_id($opp_location));			
						
		if ($create == "created")
		{
			header('Location: ../index.php?page=oppinfo&oppid='.$global_opp_id);
		}
		else 
		{
			header('Location: ../index.php?page=createopp&error=unkown');
		}
	}
?>