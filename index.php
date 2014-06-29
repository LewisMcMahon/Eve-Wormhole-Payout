<?

//Has all the functions in it
require_once "inc/functions.php";

//Sets errors
errors_set();

//Check that user id and auth key are valid else remove cookes and notif user of logout
$auth = authenticate($_COOKIE['auth'], $_COOKIE['userid'], $_SERVER['REMOTE_ADDR']);

if ($auth != "true")
{
	$auth_pass = false;
}
else {
	$auth_pass = true;
}
//Get trust from IGB
get_trust();

//Sets header info into an array
set_header_info_aray();

// add/update user to databse
if ($headerinfo['TRUSTED'] == "Yes" & $headerinfo['BROWSER'] == "igb" )
{				
	add_user($headerinfo['CHARID'],$headerinfo['CHARNAME'],$headerinfo['CORPID'],$headerinfo['ALLIANCEID']);	
}



//Include ale for eve api
require_once 'ale/factory.php';

// sets the page variable
$page = $_GET["page"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<title>Operations Payout Calculator | <? echo $page; ?></title> 
	<link href="css/css.css" rel="stylesheet" type="text/css" />
	<link href="js/jquery-ui-1.8.20.custom.css" rel="stylesheet" type="text/css" />  
	<link rel="shortcut icon" href="favicon.ico"/>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/jquery-validate.js"></script>
</head>

<body>
	<div id="wrapper">
		<div id="head">
			<? include ('inc/head.php'); ?> 
		</div>
		
		<div id="nav">
			<? include ('inc/nav.php'); ?>
		</div>
		
		<div id="qickbar">
			<? include ('inc/quick.php'); ?>
		</div>
		
		<div id="content" >
		<? 
			//Gets the content 
            if ($page == "")
            {
            include("content/content.php");
            }
            else if (file_exists ("content/".$page.".php"))
            {
            include("content/".$page.".php");
            }
            else
            {
            include("content/404.php");
            } 
        ?>
        </div>

	    <div id="footer">
	        <? 
	            include ('inc/footer.php'); 
	        ?>
	    </div> 
    </div>
</body>
</html>