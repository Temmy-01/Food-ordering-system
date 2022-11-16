<?php include('../config/constants.php') ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login  - food is Ready</title>
    <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css?v=<?php echo time(); ?>" />

</head>
<body class="login">
    <!-- <div class="login"> -->
        <!-- <h1 class="text-center">Login</h1> -->
        <section  class="Form my-4 mx-5">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-5 image">
                   <img src="../images/menu-pizza.jpg" alt="" class="img-fluid"> 
                </div>

                <div class="col-lg-7 px-5 pt-5 row-2">
                    <div class="row col-md-5 pl-4">
                        <h6 class="text-dark">Sign into your account</h6>
                    </div>
                        <br><br>
                    <?php
                        if(isset($_SESSION['login'])){
                            $message =$_SESSION['login'];
                            echo "<div class=''>
                                <strong> $message</strong> 
                            </div>";
                            // echo $_SESSION['user-not-found']; //displayimg session message
                            unset($_SESSION['login']);  //removing session message
                        }
                        if(isset($_SESSION['no-login-message'])){
                            $message =$_SESSION['no-login-message'];
                            echo "<div class=''>
                                <strong> $message</strong> 
                            </div>";
                            // echo $_SESSION['user-not-found']; //displayimg session message
                            unset($_SESSION['no-login-message']);  //removing session message
                        }
                    ?>
                    

                    <form action="" method="POST">
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input id="email" name="username" placeholder="Enter Username" class="form-control my-3 p-4">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="password" name="password" placeholder="Enter Password" class="form-control my-3 p-4">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-7">
                                <button type="submit" name="submit" value="Login"  class="btn1 mt-3 mb-2">Login </button>
                            </div>
                        </div>

                        <a href="#">Forgot password</a>
                        <p>Don't have an account <a href="#">Register here</a></p>
                        
                     </form>
                </div>
            </div>

        </div>

    </section>


        <p class="text-center mt-5">Created By - <a href="#">Temitope</a></p>
    <!-- </div> -->
</body>
</html>

<?php
    if (isset($_POST['submit'])) {
        //process for login
        //1. Get the data from login form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        //2. SQl to check whether the user with username and password exist or not
        $sql = "SELECT * FROM table_admin WHERE username = '$username' AND password = '$password'";

        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exist or not
        $count = mysqli_num_rows($res);

        if($count == 1){
            //User available and login success
            $_SESSION['login'] = "<div class='success'> Login successful. <div/>";
            $_SESSION['user'] =  $username;  //to check whether user is logged in or not and logout will unset it
            header('location:'.SITEURL.'admin/');
        }
        else{
            //User not available and login fail
            $_SESSION['login'] = "<div class='error'> Username or Password did not match. <div/>";
            header('location:'.SITEURL.'admin/login.php');
        }

    }
?>