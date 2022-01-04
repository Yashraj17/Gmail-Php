<?php include "dbconnect.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <?php include "header.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mx-auto mt-5">
                <div class="card shadow p-3 mt-5 bg-body rounded">
                    <div class="card-header text-center bg-transparent">
                        <h4>Login Here</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mt-3">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mt-3">
                                <input type="submit" name="login" value="Log In" class="btn btn-primary w-100">
                            </div>
                            <div class=" row">
                                <div class="mt-2 ">
                                    <a href="" class="text-secondary" style="text-decoration: none;">Forget Password?</a>
                                    <a href="" class="float-end text-secondary" style="text-decoration: none;">Sign up?</a>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['login'])) {
                            $email = $_POST['email'];
                            $password = md5($_POST['password']);
                            $check = mysqli_query($conn, "select * from account where email= '$email' AND password = '$password'");
                            $count = mysqli_num_rows($check);
                            if ($count > 0) {
                                $_SESSION['user'] = $email;
                                header("location: index.php");
                                die();
                            } else {
                                echo " <script> alert('email and password is incorrect')</script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>