<?
	//Has all the functions in it
	require_once "../inc/functions.php";
	
	//Sets errors
	errors_set();
	
	//Sets header info into an array
	set_header_info_aray();
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$url = $_POST['url'];
	$reverse_url = strrev($url);
	
	//TODO change WormholeLootCalculator/index.php to be dynamic
	if ($reverse_url{0} == "/"  )
	{
		$seperator ="?";
		$url = "/WormholeLootCalculator/index.php";
	}
	else if (strstr($url, 'index.php', true) and strstr($url, '?', true) != true )
	{
		$seperator ="?";
	}
	else
	{
		$seperator ="&";	
	}
	
	$login = login($username,$password,$_SERVER['REMOTE_ADDR']);
	
	if($login == "true")
	{
		header('Location: '.$url.$seperator.'loginstatus=loggedin');
		
	}
	else 
	{
		header('Location: '.$url.$seperator.'loginstatus=invalid');
	}
?>