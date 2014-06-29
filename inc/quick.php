<div class="quick-left">
	<p>
		<?
			if ($headerinfo['TRUSTED'] == "No")
			{
				//TODO add the trust link
				echo "<a href=''>Click here to grant trust</a>";
			}
			else if ($headerinfo['TRUSTED'] == "Yes")
			{
				echo "Welcome ".$headerinfo['CHARNAME'];
			}
			else 
			{
				echo "Please use the in game browser or login";
			}
		?>
	</p>
</div>

<div class="quick-right">
		<?
			if ($headerinfo['TRUSTED'] == "No")
			{
				//TODO add the trust link
				echo "<a href=''>Click here to grant trust</a>";
			}
			else if ($_GET['loginstatus'] =="loggedin")
			{
				//TODO fade to quick join
				echo "You are now logged in";
			}
			else if ($_GET['loginstatus'] =="invalid")
			{
				//TODO fade to quick login
				echo "Unknown username or password";
			}
			else if ($headerinfo['TRUSTED'] == "Yes")
			{
				//TODO Add quick join
				echo "Quick Join Goes Here";
			}
			else 
			{
				?>
					<form class="form" id="login" method="post" action="form/quicklogin.php">
					     <label for="curl">Username</label>
					     <input id="username" name="username" size="10"  class="textbox" value="" type="text"/>

					     <label for="curl">Password</label>
					     <input id="password" name="password" size="10"  class="textbox" value="" type="password"/>
					     
					     <input style="display: none;" id="displaynone" name="url" size="10"  class="textbox" value="<? echo $_SERVER['REQUEST_URI'] ?>" type="text"/>
					     
					     <input class="submit" type="submit" value="Log In"/>
					 </form> 
				<?				
			}
		?>
</div>