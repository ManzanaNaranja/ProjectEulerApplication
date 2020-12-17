<?php

session_start();


$arr = array();

$arr[0] = "first term";
$arr[1] = "second term";

$_SESSION['arr'] = $arr;


echo $arr[0]."<br>";

echo $_SESSION['arr'][0];
