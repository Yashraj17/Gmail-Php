<?php include "dbconnect.php" ;
if (!$_SESSION['user']) {
   header("location:login.php");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php include "header.php" ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-2 border border-muted border-left-0 border-top-0 border-bottom-0">
                <?php include "side.php" ?>
            </div>
            <div class="col-lg-10 px-3">
                <h6 class="lead">Trash </h6>
                <table class="table">

            <?php 
            if (isset($_GET['trash'])) {
                $trash_id = $_GET['trash'];
                $trash_query = mysqli_query($conn,"UPDATE mail SET status = '-1' where m_id = '$trash_id'");
                echo"<script> window.open('index.php','_self')</script>";
            }
            ?>




                    <?php
                    $id = $user['id'];
                    $callingMail = mysqli_query($conn, "select * from mail JOIN account ON mail.sender_id = account.id where receiver_id = '$id' AND status = '-1' ORDER BY mail.m_id DESC");
                    while ($row = mysqli_fetch_array($callingMail)) { ?>
                        <tr>

                            <td><?= $row['name'] ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td>
                                <p class="label px-2"><?= $row['content'] ?></p>
                            </td>
                            <td><?= $row['date'] ?></td>
                            <td><a href="bin.php?d_trash=<?= $row['m_id'] ?>" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                    <?php  } ?>
                    <?php 
            if (isset($_GET['d_trash'])) {
                $d_trash = $_GET['d_trash'];
                $trash_query = mysqli_query($conn,"DELETE FROM mail  where m_id = '$d_trash'");
                echo"<script> window.open('bin.php','_self')</script>";
            }
            ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>