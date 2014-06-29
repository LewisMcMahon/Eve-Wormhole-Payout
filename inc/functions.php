<?
function what_is_url()

	{

	// vars

	$http_host = $_SERVER['HTTP_HOST'];

	

	if($http_host != "localhost")

	{

		//explode

		$boom = explode(".",$http_host);

		if ($boom == "www")
		{
			$url = $boom[1].".".$boom[2];
		}
		else
		{
			$url = $boom[0].".".$boom[1];
		}
		
				

	}

	else

	{

		$url = "localhost";

	}

	

	return $url;

}

	

function errors_set()

{

if (what_is_url() == "localhost" )

	{

		return error_reporting(E_ALL ^ E_NOTICE);

	}



else

	{

		return error_reporting(0);

	}

}



function db_conect()

{

	if (what_is_url() == "localhost" )

	{

		$link = mysql_connect("localhost","root","");
		
		return $link;
		
		if (!$link) {
			return die('Could not connect: ' . mysql_error());
		}

			

	}


	else

	{

		//TODO Add the live Db info to the db connect function

		$link = mysql_connect("lewismcmahon.com","operationscalcu","donthack11");
		
		return $link;
		
		if (!$link) {
			return die('Could not connect: ' . mysql_error());
		}

	}

}



function get_trust()

{

	if ($_SERVER['HTTP_EVE_TRUSTED'] == "No")

	{

		echo "<script type='text/javascript'>CCPEVE.requestTrust('http://".$_SERVER['HTTP_HOST']."/')</script>";

	}	

}



function set_header_info_aray()

{

	global $headerinfo;

	if (strpos($_SERVER ['HTTP_USER_AGENT'], 'EVE-IGB'))

	{

		$headerinfo['TRUSTED'] = $_SERVER['HTTP_EVE_TRUSTED'];

		$headerinfo['SERVERIP'] = $_SERVER['HTTP_EVE_SERVERIP'];

		$headerinfo['CHARNAME'] = $_SERVER['HTTP_EVE_CHARNAME'];

		$headerinfo['CHARID'] = $_SERVER['HTTP_EVE_CHARID'];

		$headerinfo['CORPNAME'] = $_SERVER['HTTP_EVE_CORPNAME'];

		$headerinfo['CORPID'] = $_SERVER['HTTP_EVE_CORPID'];

	 	$headerinfo['ALLIANCENAME'] = $_SERVER['HTTP_EVE_ALLIANCENAME'];

		$headerinfo['ALLIANCEID'] = $_SERVER['HTTP_EVE_ALLIANCEID'];

		$headerinfo['REGIONNAME'] = $_SERVER['HTTP_EVE_REGIONNAME'];

		$headerinfo['CONSTELLATIONNAME'] = $_SERVER['HTTP_EVE_CONSTELLATIONNAME'];

		$headerinfo['SOLARSYSTEMNAME'] = $_SERVER['HTTP_EVE_SOLARSYSTEMNAME'];

		$headerinfo['SOLARSYSTEMID'] = $_SERVER['HTTP_EVE_SOLARSYSTEMID'];

		$headerinfo['STATIONNAME'] = $_SERVER['HTTP_EVE_STATIONNAME'];

		$headerinfo['STATIONID'] = $_SERVER['HTTP_EVE_STATIONID'];

		$headerinfo['CORPROLE'] = $_SERVER['HTTP_EVE_CORPROLE'];

		$headerinfo['WARFACTIONID'] = $_SERVER['HTTP_EVE_WARFACTIONID'];

		$headerinfo['SHIPID'] = $_SERVER['HTTP_EVE_SHIPID'];

		$headerinfo['SHIPNAME'] = $_SERVER['HTTP_EVE_SHIPNAME'];

		$headerinfo['SHIPTYPEID'] = $_SERVER['HTTP_EVE_SHIPTYPEID'];

		$headerinfo['SHIPTYPENAME'] = $_SERVER['HTTP_EVE_SHIPTYPENAME'];

		$headerinfo['BROWSER'] = "igb";

	}

	else if ($_COOKIE['userid'] != "")

	{

		$link = db_conect();

		mysql_select_db("operationscalcu", $link)
		or die(mysql_error());

		

		$userid = $_COOKIE['userid'];

		

		$query = "SELECT * FROM users WHERE user_id='$userid' ";

		$result = mysql_query($query,$link);

		

		$row = mysql_fetch_array($result);

				

		$headerinfo['TRUSTED'] = "Yes";

		$headerinfo['CHARID'] = $row['user_id'];

		$headerinfo['CHARNAME'] = $row['name'];

		$headerinfo['CORPID'] = $row['corporation_id'];

		$headerinfo['ALLIANCEID'] = $row['alliance_id'];

		$headerinfo['BROWSER'] = "ogb";

		

		if (!$result) {

		    $message  = 'Invalid query: ' . mysql_error() . "\n";

		    $message .= 'Whole query: ' . $query;

		    die($message);

		}

	}

			

}



function add_user($user_id,$charname,$corporation_id,$alliance_id)

{

	

	$user_id = mysql_real_escape_string($user_id);

	$charname = mysql_real_escape_string($charname);

	$corporation_id = mysql_real_escape_string($corporation_id);

	$alliance_id = mysql_real_escape_string($alliance_id);
	
	$user_key = randgen(20);
	
	$user_salt = randgen(20);

	

	$link = db_conect();

	

	mysql_select_db("operationscalcu", $link)
	or die(mysql_error());



	$result = mysql_query("SELECT * FROM users WHERE user_id='$user_id'", $link);

	$num_rows = mysql_num_rows($result);

	

	if($num_rows <= "0")	

	{

		$link = db_conect();

		mysql_select_db("operationscalcu", $link)
		or die(mysql_error());

		

		$query = "INSERT INTO users VALUES ('$user_id', '$charname', '$corporation_id', '$alliance_id','','','','','$user_key','$user_salt')";

		$result = mysql_query($query,$link);

				

	}

	else 

	{
		$link = db_conect();

		mysql_select_db("operationscalcu", $link)
		or die(mysql_error());	

		$query = "UPDATE users SET name='$charname', corporation_id='$corporation_id', alliance_id='$alliance_id' WHERE user_id='$user_id' ";

		$result = mysql_query($query,$link);



		
	}

}



function add_user_password($user_id,$password)

{

	$user_id = mysql_real_escape_string($user_id);

	$password = mysql_real_escape_string($password);	

		

	$link = db_conect();

	mysql_select_db("operationscalcu", $link)
	or die(mysql_error());

	

	

	$query = "UPDATE users SET password='$password' WHERE user_id='$user_id' ";

	$result = mysql_query($query,$link);

		

}



function check_user_password($user_id)

{

	$user_id = mysql_real_escape_string($user_id);

	

	$link = db_conect();

	mysql_select_db("operationscalcu", $link)
	or die(mysql_error());



	$result = mysql_query("SELECT * FROM users WHERE user_id='$user_id' AND password <> ''", $link);

	$num_rows = mysql_num_rows($result);

	

	if($num_rows != "0")	

	{

		return "true";

				

	}

	

}



function login($username,$password,$ipaddr)

{
	// Sanatse for mysql querys
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	
	//call db connect function
	$link = db_conect();

	//select operation calulator databse not the eve db dump
	mysql_select_db("operationscalcu", $link)
	or die(mysql_error());

	//convert user input password to md5 hash
	$password = md5($password);

	//query to check if user with coresponding information is in database
	$result = mysql_query("SELECT * FROM users WHERE name='$username' AND password='$password'", $link);

	//how many rows are retured from that query
	$num_rows = mysql_num_rows($result);

	//are their any rows returned
	if($num_rows != "0")	
	// if a user exists in the dabase matching the information input do the following
	{
		//call db conect function
		$link = db_conect();
		
		//select operation calulator databse not the eve db dump
		mysql_select_db("operationscalcu", $link)
		or die(mysql_error());

		
		//Query to get the user id, user key and user salt from the databse where the username and password match the input
		$query = "SELECT user_id, user_key, user_salt FROM users WHERE name='$username' AND password='$password'";

		//run the query
		$result = mysql_query($query,$link);

		//convert query to a asoc array
		$row = mysql_fetch_array( $result );

		//convert aray info to variable 
		$user_id = $row['user_id'];
		$user_key = $row['user_key'];
		$user_salt = $row['user_salt'];
		
		//create the auth key with the auth_key_gen function
		$auth = auth_key_gen($ipaddr, $password, $user_key, $user_salt);

		//set the userid and authkey cookie with an expiry of 2 weeks
		setcookie("userid", "$user_id", time()+1209600, "/");  /* expire in 2 weeks */
		setcookie("auth", "$auth", time()+1209600, "/");  /* expire in 2 weeks */
		
		//return true to inform that the user has been logged in sucesfully
		return "true";

		

	}
	//If no user exists return false
	else

		return "false";

	

}



function create_opp($user_id,$opp_name,$opp_password,$opp_type,$opp_location)

{

	$user_id = mysql_real_escape_string($user_id);

	$opp_name = mysql_real_escape_string($opp_name);

	$opp_password = mysql_real_escape_string($opp_password);

	$opp_type = mysql_real_escape_string($opp_type);

	$opp_location = mysql_real_escape_string($opp_location);

		

	//set dates and time

	$time = time();

	

	$link = db_conect();

	mysql_select_db("operationscalcu", $link)
	or die(mysql_error());	

	

	$query = "INSERT INTO ops VALUES ('','$opp_name','$user_id','$opp_password','$opp_type','','$opp_location','$time','','')";

	$result = mysql_query($query,$link);

	

	$query_id = "SELECT opp_id, start_epoc FROM ops WHERE start_epoc=(select max(start_epoc) from ops) and creator_id='$user_id'";

	$result_id = mysql_query($query_id,$link);

		

	$row = mysql_fetch_array($result_id);

	

	$opp_id = $row['opp_id'];

	global $global_opp_id;

	$global_opp_id =$opp_id;

				

	set_opp_cookie($opp_id,$opp_password);

	

	return "created";

		

}



function start_opp_timer($user_id,$opp_id,$opp_password)

{

	

	$user_id = mysql_real_escape_string($user_id);

	$opp_id = mysql_real_escape_string($opp_id);

	$opp_password = mysql_real_escape_string($opp_password);

		

	$link = db_conect();

	mysql_select_db("operationscalcu", $link)
	or die(mysql_error());



	$result = mysql_query("SELECT * FROM ops WHERE opp_id='$opp_id' AND password='$opp_password'", $link);

	$num_rows = mysql_num_rows($result);

	

	if($num_rows != "0")	

	{
	
		$link = db_conect();

		mysql_select_db("operationscalcu", $link)
		or die(mysql_error());

		//Check for all ready has timer going on an opp
		$result = mysql_query("SELECT opp_id, start_epoc, end_epoc FROM user_opp_times WHERE user_id='$user_id' ORDER BY start_epoc DESC", $link);

		$row = mysql_fetch_array($result);
		
		print_r($row);
		
		$time = time();
		

		$query = "INSERT INTO user_opp_times VALUES ('','$user_id', '$opp_id',  '$time','')";

		$result = mysql_query($query,$link);

		return "true";

		

	}

	else {
		return "false";
	}

	

}


//Check to see if an opp with specified information has been created if it has it will return true else it will return flase
function opp_exists($opp_id,$opp_password)

{

	$opp_id = mysql_real_escape_string($opp_id);

	$opp_password = mysql_real_escape_string($opp_password);	

	

	$link = db_conect();

	mysql_select_db("operationscalcu", $link)
	or die(mysql_error());


	$result = mysql_query("SELECT * FROM ops WHERE opp_id='$opp_id' AND password='$opp_password'", $link);

	$num_rows = mysql_num_rows($result);

	

	if($num_rows != "0")	

	{
	
		return "true";

		

	}

	else {

		return "false";

	}

	

}



function locationsuggest($term,$limit)

{

	$term = mysql_real_escape_string($term);

	$limit = mysql_real_escape_string($limit);

	

 	$link = db_conect();

    mysql_select_db("evedbdump", $link)
	or die(mysql_error());

    $q = strtolower($term);



	$return = array();

    $query = mysql_query("select solarSystemName from mapsolarsystems where solarSystemName like '%$q%' LIMIT $limit");

    while ($row = mysql_fetch_array($query)) {

    	array_push($return,array('label'=>$row['solarSystemName'],'value'=>$row['solarSystemName']));

	}

	return(json_encode($return));	

}



function get_solar_system_id($solar_system_name)

{

	$solar_system_name = mysql_real_escape_string($solar_system_name);



	$link = db_conect();

	mysql_select_db("evedbdump", $link)
	or die(mysql_error());



	$query = "SELECT solarSystemID FROM mapsolarsystems WHERE solarSystemName='$solar_system_name'";

	

	$result = mysql_query($query,$link);

	

	$row = mysql_fetch_array($result);

	

	$solarSystemID = $row['solarSystemID'];

	return $solarSystemID;

}



function set_opp_cookie($opp_id,$opp_password)

{

	$url = what_is_url();

	

	setcookie("op_join_id", "", time()-1209600, "", "" );  //Remove Cookeie

	setcookie("op_join_password", "", time()-1209600, "", "");  //Remove Cookeie

	

	setcookie("op_join_id", "$opp_id", time()+1209600, "/");  /* expire in 2 weeks */

	setcookie("op_join_password", "$opp_password", time()+1209600, "/");  /* expire in 2 weeks */	

}



function get_eve_image($type,$id,$size)

{

	// check for id	

	if($id !="")

	{

		//check for size

		if($size !="")

		{

			//check for type

			if($type !="")

			{

				//check type for aliance	

				if($type == "alliance"){

					return "http://image.eveonline.com/Alliance/".$id."_".$size.".png";

				}

				//check type for Corporation 	

				if($type == "corporation"){

					return "http://image.eveonline.com/Corporation/".$id."_".$size.".png";

				}

				//check type for Character 	

				if($type == "character"){

					return "http://image.eveonline.com/Character/".$id."_".$size.".jpg";

				}

				//check type for inventory 	

				if($type == "inventory"){

					return "http://image.eveonline.com/Type/".$id."_".$size.".png";

				}

				//check type for render	

				if($type == "render"){

					return "http://image.eveonline.com/Render/".$id."_".$size.".png";

				}

				else {
					return "un recgonised type";
				}

						

			}

			else {

				return "no type supplied";

			}

			

		}

		else {

			return "no size supplied";

		}

			

	}

	else {
		return "no id supplied";
	}

}


//funtion that gerates a random string of numbers and letters of a variable size difined by an input interger
function randgen($length){

    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';    
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;	

}

//Function to generate a pripritory key used to authenticate the use from user data
function auth_key_gen($ipaddr,$password,$user_key,$user_salt){
		
	$ipaddr_split =  str_split(blowfish($user_salt,md5($ipaddr)),15);
	$password_split = str_split(blowfish($user_salt,$password),15);
	$user_key_split = str_split(blowfish($user_salt,$user_key),15);

	$key = 	$user_key_split[1].$ipaddr_split[1].$password_split[0].$user_key_split[0].$ipaddr_split[0].$password_split[1];
	
	return $key;

}

//Function to create a blowfish hash from a string and a salt
function blowfish($salt,$string){
	
	 if (CRYPT_BLOWFISH == 1) {
    	$encripted = crypt($string, '$2a$07$'.$salt.'$');
		$hash = explode('.', $encripted, 2);
		return $hash[1];
	}	
	
}

//Function to check if the auth key is valid for the current user id
function authenticate($auth_key,$userid,$ipaddr)
{
	$link = db_conect();
		
	//select operation calulator databse not the eve db dump
	mysql_select_db("operationscalcu", $link)
	or die(mysql_error());

	
	//Query to get the user id, user key and user salt from the databse where the username and password match the input
	$query = "SELECT user_key, user_salt, password FROM users WHERE user_id='$userid'";
	
	//run the query
	$result = mysql_query($query,$link);

	//convert query to a asoc array
	$row = mysql_fetch_array( $result );

	//convert aray info to variable 
	$db_user_key = $row['user_key'];
	$db_user_salt = $row['user_salt'];
	$db_password = $row['password'];
	
	//create the auth key with the auth_key_gen function
	$db_auth_key = auth_key_gen($ipaddr, $db_password, $db_user_key, $db_user_salt);
	
	//check if the keys match
	if($auth_key == $db_auth_key)
	{
		//if the keys match return true
		return "true";
	}
	else {
		return "false";
	}
	
}
?>