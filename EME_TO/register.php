
<?php 

    include 'db_connection.php';

    if(isset($_POST['register_user'])){
       
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
       

        $sql_save_user = mysqli_query($conn,"INSERT INTO sombillo_users (`username`,`email`,`password`) values('$username','$email', '$hashed_pass' ) ");


    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <style>

         body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color:rgb(217, 217, 217);

            
        }
          .form-container {
            width: 320px;
            border-radius: 0.75rem;
            background-color: rgba(17, 24, 39, 1);
            padding: 2rem;
            color: rgba(243, 244, 246, 1);
            }

            .title {
            text-align: center;
            font-size: 1.5rem;
            line-height: 2rem;
            font-weight: 700;
            }

            .form {
            margin-top: 1.5rem;
            }

            .input-group {
            margin-top: 0.25rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            }

            .input-group label {
            display: block;
            color: rgba(156, 163, 175, 1);
            margin-bottom: 4px;
            }

            .input-group input {
            width: 100%;
            border-radius: 0.375rem;
            border: 1px solid rgba(55, 65, 81, 1);
            outline: 0;
            background-color: rgba(17, 24, 39, 1);
            padding: 0.75rem 1rem;
            color: rgba(243, 244, 246, 1);
            }

            .input-group input:focus {
            border-color: rgba(167, 139, 250);
            }

            .forgot {
            display: flex;
            justify-content: flex-end;
            font-size: 0.75rem;
            line-height: 1rem;
            color: rgba(156, 163, 175,1);
            margin: 8px 0 14px 0;
            }

            .forgot a,.signup a {
            color: rgba(243, 244, 246, 1);
            text-decoration: none;
            font-size: 14px;
            }

            .forgot a:hover, .signup a:hover {
            text-decoration: underline rgba(167, 139, 250, 1);
            }

            .sign {
            display: block;
            width: 100%;
            background-color: rgba(167, 139, 250, 1);
            padding: 0.75rem;
            text-align: center;
            color: rgba(17, 24, 39, 1);
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            }

            .social-message {
            display: flex;
            align-items: center;
            padding-top: 1rem;
            }

            .line {
            height: 1px;
            flex: 1 1 0%;
            background-color: rgba(55, 65, 81, 1);
            }

            .social-message .message {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            color: rgba(156, 163, 175, 1);
            }

            .social-icons {
            display: flex;
            justify-content: center;
            }

            .social-icons .icon {
            border-radius: 0.125rem;
            padding: 0.75rem;
            border: none;
            background-color: transparent;
            margin-left: 8px;
            }

            .social-icons .icon svg {
            height: 1.25rem;
            width: 1.25rem;
            fill: #fff;
            }

            .signup {
            text-align: center;
            font-size: 0.75rem;
            line-height: 1rem;
            color: rgba(156, 163, 175, 1);
            }
    </style>
</head>
<body>

    <div class="form-container">
            <p class="title">Register</p>
            <form class="form" method="POST" enctype="multipart/form-data" style="padding-right: 20px;" >
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="" >
                </div>  
                <div class="input-group" style="margin-bottom: 20px;" >
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="" required>
                </div>
                <!-- <button class="sign">Sign up</button> -->
                <input type="submit" name="register_user" class="sign" value="Sign Up">
            </form>
            <p class="signup">Already have an account?
                <a rel="noopener noreferrer" href="login.php" class="">Login</a>
            </p>
            <a rel="noopener noreferrer" href="index.php" class="" style="color:white;" >Go to Site</a>
    </div>

</body>
</html>