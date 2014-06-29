<?
//TODO add add opp security (check for cookie and password)

//set url
$url = explode("?", $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);

$url = $url[0];
?>

<h1>Operation Information</h1>
	<?
		
		$oppid = $_GET['oppid'];
		
		//get opp password
		$link = db_conect();

		mysql_select_db("operationscalcu", $link)
		or die(mysql_error());


		$result = mysql_query("SELECT password FROM ops WHERE opp_id='$opp_id'", $link);
		
		$row = mysql_fetch_array( $result );
		
		$opppassword = $row['password'];
	?>

<div id="opp-info">
	<!--set the quick info center, left and right-->
	<? 
	if ($opppassword != ""){ 
		?>
		<span class="right">
		Operation Password: <?echo $opppassword; ?>
		</span> 
		<? 
	}
	else
		{} ?>
	
	<span class="left">
	Quick join link: 
	<?
		echo "<input id='url' name='url' size='20'  class='textbox' value='".$url."?page=quickjoin&oppid=".$oppid."&opppassword=".$opppassword."'type='text'/>";
	?>
	</span>
	
	<span class="left">
	Operation ID: <?echo $oppid; ?>
	</span> 
</div>

<div id="opp-buttons">
	<div class="start-timer button first">
		Start Loging Time
	</div>
	<div class="stop-timer button">
		Stop Loging Time
	</div>
	<div class="leave-opp button last">
		Leave Opp
	</div>
	
</div>
	
<div id="oppinfo">
	
</div>

<script>
	function load_oppinfo(){
		$("#oppinfo").load("inc/oppinfo.php?<?echo"oppid=".$oppid; ?>");	    
	}
	$(document).ready(function()
	{
		//turn auto refresh back on
	    /*
	    window.setInterval(function(){
			load_oppinfo()
		}, 5000);
		*/    
	    load_oppinfo()
	});
	
	$(".start-timer").click(function() {
  		$.post(
  			'form/startopptimer.php', 
  			{ <? echo "oppid: '".$oppid."', opppassword:'".$opppassword."', userid: '".$headerinfo['CHARID']."'"; ?> },
  			function(data) { alert("Data Loaded: " + data); }
  		)
	});
</script>