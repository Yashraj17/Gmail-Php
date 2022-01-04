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

    <title>Gmail | send</title>
</head>

<body>
    <?php include "header.php" ?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-2 border border-muted border-left-0 border-top-0 border-bottom-0">
                <?php include "side.php" ?>
            </div>
            <div class="col-lg-10 px-3">
                <h6 class="lead">Send Mail</h6>
                <table class="table">
                    <?php
                    $id = $user['id'];
                    $callingMail = mysqli_query($conn, "select * from mail JOIN account ON mail.receiver_id = account.id where sender_id = '$id' AND status = '0' ORDER BY mail.m_id DESC");
                    while ($row = mysqli_fetch_array($callingMail)) { ?>
                        <tr>

                            <td><?= $row['name'] ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td>
                                <p class="label px-2"><?= $row['content'] ?></p>
                            </td>
                            <td><?= $row['date'] ?></td>
                        </tr>
                    <?php  } ?>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>