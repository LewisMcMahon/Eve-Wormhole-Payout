<ul id="nav">
	<li class="top">
		<a href="index.php">Home</a>
	</li>
	<li >
		<a href="#">Info</a>
		<ul>
			<li>
				<a href="index.php?page=faq">FAQ</a>
			</li>
			<li>
				<a href="index.php?page=help">Help</a>
			</li>
			
		</ul>
	</li>
	<li >
		<a href="#">Operations</a>
		<ul>
			<li>
				<a href="index.php?page=createopp">Start an Opp</a>
			</li>
			<li>
				<a href="index.php?page=joinopp">Join an Opp</a>
			</li>
			<li>
				<a href="index.php?page=opphistory">Opp History</a>
			</li>
		</ul>
	</li>		
	<li class="bottom">
		<a href="#">Acount</a>
		<ul>
			<li>
				<a href="index.php?page=login">Login</a>
			</li>
			<li>
				<a href="index.php?page=createacount">Create Acount</a>
			</li>
			<li>
				<a href="index.php?page=ballance">Ballance</a>
			</li>
			<li>
				<a href="index.php?page=upgrade">Upgrade</a>
			</li>
		</ul>
	</li>
</ul>
<script>
	$(document).ready(function () {
	  $('#nav > li > a').hover(function(){
	    if ($(this).attr('class') != 'active'){
	      $('#nav li ul').slideUp();
	      $(this).next().slideToggle();
	      $('#nav li a').removeClass('active');
	      $(this).addClass('active');
	    }
	  });
	});
</script>