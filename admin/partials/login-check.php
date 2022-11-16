<?php

  //Authorization - Access Control
  //Check whether the user is logged in or not
  if(!isset($_SESSION['user'])){  //if user is not set

    //if user is not logged in
    //redirect to login with message
    $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin Panel <div/>";
    header('location:'.SITEURL.'admin/login.php');
    
  }
?>