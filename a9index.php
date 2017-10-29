<?php
$page_title = 'Welcome to the Baseball Stats Site!'; //declare page title
$today = date("F j,Y"); //declare date for footer
include('includes/a9header.html');//include the header
?>
<h1>About the Baseball Stats Site</h1>
<p>The Baseball Stats website keeps track of Games, Wins, Losses, AtBats, HomeRuns, BatAvg, Pennants, and World Series for the Major League Baseball Teams
</p>
<br>
<h2>How to use the Baseball Stats Site</h2>
<p>By clicking on the View Champs link above, you can view how many Pennants and World Series games each team has won.
</p>
<p>By clicking on the Update Champs link above, you can update the number of Pennants or World Series won by teams after the boys of summer have gone.
</p>
<?php
include('includes/a9footer.html');//include the footer
?>
