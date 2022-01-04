<?php include "dbconnect.php";

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
    <title>Gmail</title>
</head>

<body>
    <?php include "header.php" ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-2 border border-muted border-left-0 border-top-0 border-bottom-0">
                <?php include "side.php" ?>
            </div>
            <div class="col-lg-10 px-3">
                <h6 class="lead">Inbox </h6>
                <table class="table">
                    <?php
                    $id = $user['id'];
                    $callingMail = mysqli_query($conn, "select * from mail JOIN account ON mail.sender_id = account.id where receiver_id = '$id' AND status = '0' ORDER BY mail.m_id DESC");
                    while ($row = mysqli_fetch_array($callingMail)) { ?>
                        <tr>

                            <td><?= $row['name'] ?></td>
                            <td><b><a class='text-decoration-none text-primary ' href="view_mail.php?id=<?= $row['m_id'];?>"><?= $row['title'];?></a></td>
                            <td><?= $row['email'] ?></td>
                            <td>
                                <p class="label px-2"><?= $row['content'] ?></p>
                            </td>
                            <td>
                                <span class="small fw-bold"> <?= date("D d M Y" ,strtotime($row['date'])) ?></span>
                           
                            <td><a href="bin.php?trash=<?= $row['m_id'] ?>" class="btn btn-danger btn-sm"> Trash</a></td>
                        </tr>
                    <?php  } ?>
                </table>
            </div>
        </div>
    </div>
    <?php 
        if (isset($_GET['resend'])) {
            $id = $_GET['resend'];
            $query = mysqli_query($conn,"UPDATE mail SET status ='0' WHERE m_id ='$id'");
            echo"<script> window.open('draft.php','_self')</script>";
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>