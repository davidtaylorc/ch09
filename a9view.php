<?php
$page_title = 'View the Champs';
$today = date("F j,Y");
include('includes/a9header.html');//include header

echo '<h1>MLB Champs</h1>';

require('a9mysqli_connect.php');//require the file to connect to DB

$q = "SELECT t.Team AS t, t.team_id AS id, c.pennants as p, c.worldseries AS ws FROM teamstats AS t INNER JOIN champs as c ON t.team_id = c.team_id"; //Display the data- join statement to get data from champs and baseball_stats tables
$r = @mysqli_query($dbc, $q);
$num = mysqli_num_rows($r); //return number of teams

if($num > 0){//if no data
	echo "<p>There are currently $num MLB teams.</p>\n";
	echo '
	<table>
		<tr>
			<td>
				<b>Team</b>
			</td>
			<td>
				<b>Team ID</b>
			</td>
			<td>
				<b>Pennants</b>
			</td>
			<td>
				<b>World Series</b>
			</td>
		</tr>
		';// table is styled with CSS attached file
		while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){//run through array to display data
		echo '
		<tr>
			<td>' . $row['t'] . '
			</td>
			<td>' . $row['id'] . '
			</td>
			<td>' . $row['p'] . '
			</td>
			<td>' . $row['ws'] . '
			</td>
		</tr>
		';
	}
	echo '
	</table>
	';
	mysqli_free_result($r);//free up table resources
	}
	else{
		echo '<p class="error">There are currently no baseball teams in the database.</p>';
	}
mysqli_close($dbc);//close DB connection
include ('includes/a9footer.html');//include footer
?>
