

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projecteuler";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn) {
    die("Connection Failed: ".sqli_connect_error());
}

// echo "<h2>Connected Successfully</h2>";