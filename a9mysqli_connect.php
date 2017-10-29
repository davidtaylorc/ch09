<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'root'); //define constants to log into database
DEFINE ('DB_HOST' ,'localhost');
DEFINE ('DB_NAME', 'baseball_stats');

$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
//error message if connection is not made. Will display MySQL errrors.
