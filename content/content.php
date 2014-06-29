<h2>Home page</h2>

<?
	$user_id = $headerinfo['CHARID'];

	$link = db_conect();

	mysql_select_db("operationscalcu", $link)
	or die(mysql_error());
	
	//Check for all ready has timer going on an opp
	$result = mysql_query("SELECT opp_id, start_epoc, end_epoc FROM user_opp_times WHERE user_id='$user_id' ORDER BY start_epoc DESC", $link);

	$row = mysql_fetch_array($result);
		
	print_r($row);
		
?>