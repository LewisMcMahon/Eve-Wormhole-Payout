<h2> Start an Operation </h2>

<? if ($headerinfo['TRUSTED'] == "Yes"){



?>

<form class="form" id="oppcreation" method="post" action="form/createopp.php">

	<fieldset>

		<legend>

			Enter the information for your Operation

		</legend>

		<p>

			<div class="label">

				<label for="Name">Name</label>

			</div>

			<input id="name" name="name" size="25"  class="textbox" value="" type="text"/>

		</p>

		<p>

			<div class="label">

				<label for="password">Password</label>

			</div>

			<input id="password" name="password" size="25"  class="textbox" value="" type="password"/>

		</p>

		<p>

			<div class="label">

				<label for="location">Location</label>

			</div>

			<input id="location" name="location" size="25"  class="textbox" value="" type="text"/>

		</p>

		<p>

			<div class="label">

				<label for="Type">Type</label>

			</div>

			<select id="type" class="dropdown" name="type" >

				<option value="">Choose Type:</option>

				<option value="missions">Missions</option>

				<option value="Mining">Mining</option>

				<option value="wormholes">Wormholes</option>

				<option value="other">Other</option>

			</select>

		</p>

		<p>

			<input id="submit" class="submit" type="submit" value="Submit"/>

		</p>

	</fieldset>

</form>



<script>

	$(document).ready(function() {

		$("#oppcreation").validate({

			rules : {

				name : {

					required : true,

					minlength : 3,

					maxlength : 20

				},

				password : {

					minlength : 5,

					maxlength : 32

				},

				location : {

					required : true,

					maxlength : 30

				},

				type : {

					required : true

				}

			}

		});

	});



	$(document).ready(function() {

		function log(message) {

			$("<div/>").text(message).prependTo("#log");

			$("#log").scrollTop(0);

		}





		$("#location").autocomplete({

			source : "form/locationsuggest.php",

			minLength : 2,

			select : function(event, ui) {

				log(ui.item ? "Selected: " + ui.item.value + " aka " + ui.item.id : "Nothing selected, input was " + this.value);

			}

		});

	}); 

</script>

<?

}

else

{

echo "You must use the ingame browser or login";

}

