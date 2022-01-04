<?php include "dbconnect.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Signup</title>
</head>

<body>
    <?php include "header.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-7"></div>
            <div class="col-5 mx-auto mt-5">
                <div class="card shadow p-3 bg-body rounded">
                    <div class="card-header bg-transparent">
                        <h4>Create Account</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <label for="">Full Name</label>
                            <input type="text" name="name" class="form-control">
                            <div class="mt-3">
                                <label for="">Contact</label>
                                <input type="number" name="contact" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col mt-3">
                                    <label for="">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control">
                                </div>
                                <div class="col mt-3">
                                    <label for="">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option selected value="m">Male</option>
                                        <option value="f">Female</option>
                                        <option value="o">Other</option>
                                    </select>

                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mt-3">
                                <input type="submit" name="signup" value="Create" class="btn btn-primary w-100">
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['signup'])) {
                            $name = $_POST['name'];
                            $contact = $_POST['contact'];
                            $gender = $_POST['gender'];
                            $dob = $_POST['dob'];
                            $email = $_POST['email'];
                            $password = md5($_POST['password']);

                            $e_query = mysqli_query($conn, "select * from account where email='$email'");
                            $count_e = mysqli_num_rows($e_query);
                            if ($count_e < 1) {
                                $query = mysqli_query($conn, "insert into account (name,contact,gender,email,password,dob) value ('$name','$contact','$gender','$email','$password','$dob')");
                                if ($query) {
                                    $_SESSION['user'] = $email;
                                    echo "<script>window.open('login.php','_self')</script>";
                                } else {
                                    echo "<script> alert('account not created') </script>";
                                }
                            } else {
                                echo "<script> alert('Account already exist') </script>";
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