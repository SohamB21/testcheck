<!-- <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testcheck_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> -->

<!-- <?php 
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "testcheck_db";

$conn = new mysqli($servername, $username, $password, $databasename);

if($conn->connect_error){
	die("Connection not established because: " . $conn->connect_error);
}
 ?>
 -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "testcheck_db";

$conn = new mysqli($servername, $username, $password, $databasename);

if($conn->connect_error)
	die("Connection Failure: " . $conn->connect_error);
 ?>