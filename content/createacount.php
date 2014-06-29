<h2>Create Acount</h2>

<?
	//TODO migrate validation eliments to seperate file
	if($headerinfo['TRUSTED'] == "Yes" & check_user_password($headerinfo['CHARID']) == "true" )
	{
		echo "You allready have a password";
	}
	
	else if($headerinfo['TRUSTED'] == "Yes" )
	{
		?>
		<form class="form" id="AcountCreation" method="post" action="index.php?page=createacount">
		 <fieldset>
		   <legend>Enter a password for your acount your username is your charecter name</legend>
		   <p>
		     <label for="curl">Password</label>
		     <em>  </em><input id="password" name="password" size="25"  class="password" value="" type="password"/>
		   </p>
		   <p>
		     <input class="submit" type="submit" value="Submit"/>
		   </p>
		 </fieldset>
		 </form>
		 
		  <script>
		  $(document).ready(function(){
		    $("#AcountCreation").validate({
		    	rules: {
			    	password: {
				      required: true,
				      minlength: 8,
				    }
			    }
		    });
		  });
		  </script>
  
		<?
		if($_POST['password'] != ""){
			
			add_user_password($headerinfo['CHARID'],$password);
			echo"Complete!";
			
		}
	}
	
	else if ($headerinfo['TRUSTED'] == "No")
	{
		echo "Please trust this website";
		get_trust();
		
	}
	else 
	{
		echo"Please use the in game browser to create your acrount";
	}

 
?>