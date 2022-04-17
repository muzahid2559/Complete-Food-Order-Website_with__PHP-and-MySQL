<?php 
    include("../config/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Restaurant Login System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>
        <?php 
        //Login message from session
        if(isset($_SESSION["login"])){
            echo $_SESSION["login"];
            unset($_SESSION["login"]);
        }
        if(isset($_SESSION["no-login-message"])){
            echo $_SESSION["no-login-message"];
            unset($_SESSION["no-login-message"]);
        }
        ?>
        <br>
        <!-- Login form start -->
        <form action="" method="POST">

            <div class="padding">
            <p > User Name:</p>
            <input type="text" name="username" placeholder="Enter username">
            </div>

            <div class="padding">
            <p>Password:</p>
            <input type="password" name="password" placeholder="Enter password">
            </div>
          
            <input type="submit" name="submit" value="Login" class="primary-btn">
        </form>
        <!-- Login form end -->
        <br>
    <!-- <p class="text-center">Created by - <a href="https://sadiqur2770.github.io/My-Portfolio/">Sadiqur Rahman</a></p> -->
    </div>
    
</body>
</html>
<?php
    //Check whether submit button is clicked or not
    if(isset($_POST["submit"])){
        //Process for login
        //Step 1: get the data from login form
        // $username = $_POST["username"]; old type
        // $password = md5($_POST["password"]); old type

        $username = mysqli_real_escape_string($db_connection, $_POST["username"]);

        $raw_password = md5($_POST["password"]);
        $password = mysqli_real_escape_string($db_connection,$raw_password);

        //Step 2: Sql to check whether user with username and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username ='$username' AND password ='$password'";

        //Execute query
        $result = mysqli_query($db_connection, $sql);

        //Step 3: Count rows to check whether the user exist or not
        $count = mysqli_num_rows($result);

        if($count == 1){
            //User available and login success
            $_SESSION["login"] = "<div class='success'>Login Successful</div>";
            $_SESSION["user"] = $username; //Check whether the user is loggedin on not and logout will unset it
            //Redirect to home page
            header("location:".SITEURL."admin/");
        }
        else{
            //User not available and login fail
            $_SESSION["login"] = "<div class='error text-center'>Username and Password did not match</div>";
            //Redirect to login form
            header("location:".SITEURL."admin/login.php");
        }
    }

?>