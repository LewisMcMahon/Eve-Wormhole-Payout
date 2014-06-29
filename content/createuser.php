<h2> User Creation </h2>

<?
$trust = $_SERVER['HTTP_EVE_TRUSTED'];

if ($trust == "")
	{
		?>
		<p>
			Please use The IGB
		</p>
		<?
	}
	else if ($trust == "No")
	{
		get_trust();
	}
	else if ($trust == "Yes")
	{
		//set the headr info into an array
				
		add_user($headerinfo['CHARID'],$headerinfo['CHARNAME'],$headerinfo['CORPNAME'],$headerinfo['ALLIANCENAME']);
		
	}
	
?>
