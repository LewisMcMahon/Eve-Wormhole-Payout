<h2>
	Join an Operation
</h2>
<? if ($headerinfo['TRUSTED'] == "Yes")
{
	//TODO Style the form
	?>
	<form class="form" id="oppjoin" method="post" action="form/joinopp.php">
		<fieldset>
		   <legend>Join An Operation</legend>
		   <p>
		   		<div class="label">
			    	<label for="oppid">Operation ID</label>
			    </div>
			    <input id="oppid" name="oppid" size="25"  class="textbox" value="" type="text"/>
		   </p>
		   <p>
		    	<div class="label">
		    		<label for="Password">Password</label>
		    	</div>
		    	<input id="password" name="password" size="25"  class="textbox" value="" type="password"/>
		   </p>
	
		   <p>
		     <input id="submit" class="submit" type="submit" value="Submit"/>
		   </p>
		</fieldset>
	</form>
	 
	  <script>
	  $(document).ready(function(){
	    $("#oppcreation").validate({
	    	rules: {
		    	oppid: {
			      required: true
			    }
	    });
	  });
	  //TODO Add the "Are you sure" if allready joined an opp
	$(document).ready(function(){
		$("#submit").click(function(){
			alert("Handler for .click() called.");
		});
	});
	  </script>
	<?
	$opp_error = $_GET['error'];
	
	if ($opp_error == "unkown")
	{
		echo "Invalid Password or Operation ID";
	}
	

} 
else
	{
		echo "You must use the ingame browser or login";
	}	
?>