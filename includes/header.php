<?php 
session_start();
require('includes/dbh.php');

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}

if($loggedin && $_SESSION['role'] == 'admin') {
    $admin = true;
} else {
    $admin = false;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="header.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
</head>
<body>
<!-- <h2> need to fix problem where completed challenges arent shifting when questions are removed</h2> -->

<nav>
    <div>
        <ul>
            <a href="index.php"><li>WELCOME</li></a>
            <a href="#"><li>Home</li></a>
            <a href="#"><li>Profile</li></a>
            <a href="#"><li>Challenges</li></a>
        <ul>
    </div>


    <div>
        <ul>
        
        <?php 
            if(!$loggedin) {
                echo "<a href=\"login.php\"><li>Login</li></a>";
                echo "<a href=\"signup.php\"><li>Sign Up</li></a>";
            } else {
                $prefix = ($_SESSION['role'] == 'admin') ? '[ADMIN]' : '[USER]';
                echo "<div id=\"user\">".$prefix." ".$_SESSION['username']."</div>";
                echo "<a href=\"logout.php\"><li>Log Out</li></a>";
            }
        ?>
        
        <ul>
    </div>

   
</nav>

