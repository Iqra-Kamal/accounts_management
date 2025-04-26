<?php
$hostdb = "localhost"; // MySQl host
$userdb = "root"; // MySQL username
$passdb = ""; // MySQL password
$namedb = "accounts"; // MySQL database name

// Establish a connection to the database
$dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

/*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
if ($dbhandle->connect_error) {
exit("There was an error with your connection: ".$dbhandle->connect_error);
}
?>