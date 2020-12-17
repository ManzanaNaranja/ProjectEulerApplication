<?php

require('includes/header.php');
if(isset($_SESSION['loggedin']) && $_SESSION["loggedin"] == true) {
    header("location: index.php");
}

require('signup_handler.php'); // handlels errors

?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

<?php 
if(!empty($username_err)) {
    echo "<div class=\"error\">$username_err</div>";
}
if(!empty($password_err)) {
    echo "<div class=\"error\">$password_err</div>";
}
if(!empty($credential_err)) {
    echo "<div class=\"error\">$credential_err</div>";
}
if(!empty($email_err)) {
    echo "<div class=\"error\">$email_err</div>";
}
?>

<input type="text" name="username" placeholder="username"><br>
<input type="text" name="email" placeholder="email"><br>
<input type="password" name="password" placeholder="password"><br>

<input type="submit" name="submit" value="Submit">
</form>


</body>
</html>