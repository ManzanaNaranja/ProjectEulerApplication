<?php

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $email = $password = $username_err = $email_err = $password_err = $credential_err = "";


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

    if(empty(trim($_POST['email']))) {
        $email_err = "Please Enter An Email.";
    } else {
        $email = trim($_POST['email']);
    }

    if(empty($username_err.$password_err.$email_err)) {
        echo "Sucees";
    } 

    // if(empty($username_err) && empty($password_err) && empty($email_err)) {
    //     $sql = "SELECT id, username, password, role FROM users WHERE username = '$username' AND password = '$password'";
    //     // ' or ''=' // inject this in username slot
    //     // admin // inject this in password slot
        

                                                                                    
    //     $result = mysqli_query($conn, $sql);
    //     if($result && mysqli_num_rows($result) == 1) {
    //         //password is correct
    //         if($row = mysqli_fetch_assoc($result)) {
    //             $_SESSION['loggedin'] = true;
    //             $_SESSION['id'] = $row['id'];
    //             $_SESSION['username'] = $row['username'];
    //             $_SESSION['role'] = $row['role'];
                
    //             header("location: index.php");
    //         } 
    //     } else {
    //         $credential_err = "Username or Password is incorrect.";
    //     }

    // } 

} 