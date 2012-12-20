<!DOCTYPE html>
<?php include 'class.db.php'; ?>
<?php include 'functions.php'; ?>
<?php include '/app/app.fb.php'; ?>
<?php

            // Check, if user is already login with facebook, 
            // then if user has registered set session for,
            // if not jump to registering page.
            if (isset($user_profile)){
     
                 error_reporting(E_ALL);
                 try {
                 $connect = new DB();
                 $connect->select('users', 'email');
                 
                 }
                 catch (Exception $e)
                 {
                     echo $e->getMessage();
                     exit();
                 }
                                                  
                 $match = isMatch('email',$user_profile['email']);

                 switch ($match)
                 {
                   case true :
                        $_SESSION['username'] = $user_profile['first_name'];
                        $_SESSION['useremail'] = $user_profile['email'];
                        break;

                   case null :
                        if ($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] != $_SERVER['SERVER_NAME'].'/mysite/register.php') {
                        header('Location: register.php');
                       }
                        break;
                 }
            }   

// Check, if user is already login, then jump to welcome page
if ((isset($_SESSION['useremail'])) && (($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']) != $_SERVER['SERVER_NAME'].'/mysite/welcome.php')) {
    header('Location: welcome.php');
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/reset.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <title><?php pageTitle($subtitle) ?></title>
    </head>
    <body>