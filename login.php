<?php

require('includes/header.php');
if(isset($_SESSION['loggedin']) && $_SESSION["loggedin"] == true) {
    header("location: index.php");
}

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $password = $username_err = $password_err = $credential_err = "";


    if(empty(trim($_POST['username']))) {
        $username_err = "Please Enter A Username.";
    } else {
        $username = trim($_POST['username']);
    }

    if(empty(trim($_POST['password']))) {
        $password_err = "Please Enter A Password.";
    } else {
        $password = trim($_POST['password']);
    }

    if(empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password, role FROM users WHERE username = '$username' AND password = '$password'";
        // ' or ''=' // inject this in username slot
        // admin // inject this in password slot
        

                                                                                    
        $result = mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) == 1) {
            //password is correct
            if($row = mysqli_fetch_assoc($result)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                
                header("location: index.php");
            } 
        } else {
            $credential_err = "Username or Password is incorrect.";
        }

    } 

}


?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

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
?>

<input type="text" name="username" placeholder="username">
<input type="password" name="password" placeholder="password">
<input type="submit" name="submit" value="Submit">
</form>


</body>
</html>