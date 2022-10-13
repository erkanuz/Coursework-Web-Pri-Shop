<?php

    include 'config.php';

    session_start();
    error_reporting(0);

    if (isset($_POST['submit'])) {
        
        $name = mysqli_real_escape_string($conn , $_POST["name"]);
        $email = mysqli_real_escape_string($conn , $_POST["email"]);
        $pass = mysqli_real_escape_string($conn , md5($_POST["password"]));
        $cpass = mysqli_real_escape_string($conn , md5($_POST["cpassword"]));
       
        $check_email = mysqli_num_rows(mysqli_query($conn , "SELECT email FROM users WHERE email = '$email'"));

        if ($pass !== $cpass) {
            echo "<script>alert('Password did not match.');</script>";
        } elseif ($check_email > 0 ) {
            echo "<script>alert('Email already exists in out database.');</script>";
        } else {
            $sql = "INSERT INTO users (name , email , password) VALUES('$name' , '$email' , '$pass')";
            $result = mysqli_query($conn , $sql);
            if ($result) {
                $_POST["name"] = "";
                $_POST["email"] = "";
                $_POST["password"] = "";
                $_POST["cpassword"] = "";
                echo "<script>alert('User registration successfuly.');</script>";
            } else {
                echo "<script>alert('User registration failed.');</script>";
            }
        }
    }
    
    if (isset($_POST['login'])) {
        
        $email = mysqli_real_escape_string($conn , $_POST["log_email"]);
        $pass = mysqli_real_escape_string($conn , md5($_POST["log_pass"]));

    $select_users = mysqli_query($conn , "SELECT * FROM `users` WHERE email = '$email' ");
    if (mysqli_num_rows($select_users) > 0) {

        $row = mysqli_fetch_assoc($select_users);

        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin.php');

        } elseif ($row['user_type'] == 'user') {

            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
        }
    } else {
        echo "<script>alert('Invalid name or password !');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body>
    <div class="login">
        <div class="login_content">
            <div class="login_img">
                <img src="img/log out.svg" alt="">
            </div>

            <div class="login_forms">

                <form action="" class="login_register" id="login-in" method="POST">
                    <h1 class="login_title">Sing in</h1>

                    <div class="login_box">
                        <input type="text" name="log_email" placeholder="" class="login_input" value="<?php echo $_POST['log_name']; ?>" required>
                        <label for="" class="form_label">Username</label>
                    </div>

                    <div class="login_box">
                        <input type="password" name="log_pass" placeholder="" class="login_input" value="<?php echo $_POST['log_pass']; ?>" required>
                        <label for="" class="form_label">Password</label>
                    </div>

                    <a href="#" class="login_forgot">Forgot password ?</a>

                    <input type="submit" name="login" class="login_button" value="Sing in">

                    <div>
                        <span class="login_account">Don't have a account ?</span>
                        <span class="login_singin" id="sing-up">Sing up</span>
                    </div>
                </form>

                <form action="" class="login_create none" id="login-up" method="POST">
                    <h1 class="login_title">Create Account</h1>

                    <div class="login_box">
                        <input type="text" name="name" placeholder="" class="login_input" value="<?php echo $_POST["name"]; ?>" required>
                        <label for="" class="form_label">Username</label>
                    </div>

                    <div class="login_box">
                        <input type="text" name="email" placeholder="" class="login_input" value="<?php echo $_POST["email"]; ?>" required>
                        <label for="" class="form_label">Email</label>
                    </div>

                    <div class="login_box">
                        <input type="password" name="password" placeholder="" class="login_input" value="<?php echo $_POST["password"]; ?>" required>
                        <label for="" class="form_label">Password</label>
                    </div>

                    <div class="login_box">
                        <input type="password" name="cpassword" placeholder="" class="login_input" value="<?php echo $_POST["cpassword"]; ?>" required>
                        <label for="" class="form_label">Confirm Password</label>
                    </div>

                    <input type="submit" name="submit" class="login_button" value="Sing up">
                    
                    <div>
                        <span class="login_account">Already have an account ?</span>
                        <span class="login_singup" id="sing-in">Sing In</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="javascript/login.js"></script>
</body>
</html>