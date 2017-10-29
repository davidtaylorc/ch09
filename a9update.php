<?php
$page_title = 'Update the Pennants and World Series';//declare page tilte
$today = date("F j,Y"); //declare date for footer
include('includes/a9header.html');//include header

if($_SERVER['REQUEST_METHOD'] == 'POST'){//if form is submitted
	require('a9mysqli_connect.php');//requires file to make DB connection
	$errors = array();//declare array to store all error messages

	if(empty($_POST['team_id'])){
		$errors[] = 'You forgot to enter the Team ID.';
	}		//if empty field log error/ if ok set var equal to field input
	else{
		$id = $_POST['team_id'];
	}

	if(empty($_POST['team'])){
		$errors[] = 'You forgot to enter the Team.';
	}		//if empty field log error/ if ok set var equal to field input
	else{
		$t = $_POST['team'];
	}

	if(empty($_POST['pennants'])){
			$errors[] = 'You forgot to enter the Pennants to be updated.';
		}		//if empty field log error/ if ok set var equal to field input
		else{
			$p = $_POST['pennants'];
		}

	if(empty($_POST['world_series'])){
		$errors[] = 'You forgot to enter the World Series to be updated.';
	}		//if empty field log error/ if ok set var equal to field input
	else{
		$ws = $_POST['world_series'];
	}

	if(empty($errors)){ //if no errors logged
		$q = "SELECT * FROM teamstats WHERE team_id = '$id' AND Team = '$t'";
		//query to pull team data with corresponding team_id numbers
		//makes sure team_id matches team name
		$r = @mysqli_query($dbc, $q); //var is assigned to result of select * query
		$num = @mysqli_num_rows($r); //number of rows returned

		if($num == 1){ //if one row was returned- inputs match
			$row = mysqli_fetch_array($r, MYSQLI_NUM); //var assigned to row pulled from query. Will be row user intends to update
			$q = "UPDATE champs SET pennants= $p, worldseries= $ws WHERE team_id=$row[0]";//update fields for pennants and worldseries
			$r = @mysqli_query($dbc, $q);//run the query

			if(mysqli_affected_rows($dbc) == 1){//if one row changed udate was succsessful
				echo '<p>The Pennants and World Series have been updated</p><p><br /></p>';
			}
			else{ //if row was not updated IF statement will return false
				echo '<h1>System Error</h1>
				<p class="error">The Pennants and World Series could not be changed due to a system error. We apologize for any inconvenience.</p>';
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
			}

			mysqli_close($dbc);//close the DB connection
			include ('includes/a9footer.html');//include footer
			exit();

		}
		else{//if user input did not match a team and team_id in the DB
			echo '<h1>Error!</h1>
			<p class="error">The Team ID and Team name combination does not match anything on file. Please view the teams again to see the correct Team ID and Team names to use.</p>';
		}
	}
	else{ //if errors were logged with initial qualifying statements
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg){
			echo " - $msg<br />\n";//list out the errors
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
	}

	mysqli_close($dbc);//close the connection
}
?>
<h1>Update Champs Table</h1>
<form action="a9update.php" method="post">
	<p>
		<label>Team ID:
		</label>
		<input type="text" name="team_id" size="10" maxlength="10" value="<?php if (isset($_POST['team_id'])) echo $_POST['team_id']; ?>"
		/>
	</p>
	<p>
		<label>Team:
		</label>
		<input type="text" name="team" size="30" maxlength="60" value="<?php if (isset($_POST['team'])) echo $_POST['team']; ?>"
		/>
	</p>
	<p>
		<label>Pennants:
		</label>
		<input type="text" name="pennants" size="10" maxlength="10" value="<?php if (isset($_POST['pennants'])) echo $_POST['pennants']; ?>"
		/>
	</p>
	<p>
		<label>
			World Series:
		</label>
		<input type="text" name="world_series" size="10" maxlength="10" value="<?php if (isset($_POST['world_series'])) echo $_POST['world_series']; ?>"
		/>
	</p>
	<p>
		<input type="submit" name="submit" value="Submit"
		/>
	</p>
</form>
<?php include('includes/a9footer.html');//include the footer
?>
