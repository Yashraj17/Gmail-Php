
<?php include "dbconnect.php";

if(!isset($_SESSION['user'])){
    header("location: login.php");
    die();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmail - Faster, Reliable and Easy</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php include "header.php";?>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-2 border border-muted border-left-0 border-top-0 border-bottom-0">
                <?php include "side.php";?>
            </div>
            <div class="col-lg-10">
                   <?php 
                        $id = $user['id'];
                        $mail_id = $_GET['id'];
                        $callingMail = mysqli_query($conn,"select * from mail JOIN account ON mail.sender_id = account.id where receiver_id='$id' AND status='0' AND m_id='$mail_id' ORDER BY mail.m_id DESC");
                        $row = mysqli_fetch_array($callingMail);

                        //make readable

                        $readQuery = mysqli_query($conn,"update mail SET read_status='0' where m_id='$mail_id'");
                    ?>
                    <h6 class="lead">View <?= $row['name'];?>'s Mail</h6>

                        <div class="col">
                            

                            <div class="card">
                                <div class="card-body">
                                        <h5>To: <?= $row['email'];?>  </h5>  
                                    <h6>From: <?= $_SESSION['user'];?></h6>
                                    <h2 class="h3"><b>Subject: </b><?= $row['title'];?> <span class="float-end">
                                    <span class="float-end text-danger">
                                <?php 
                                
                                if($row['attachment'] != ""){
                                    echo "<i class='bi bi-paperclip'></i>";
                                }
                                ?>
                            </span>
                                    </span></h2>
                                    <p class="mt-5 lead">
                                    <?= $row['content'];?>
                                    </p>

                                    <?php 
                                    if($row['attachment'] != ""): ?>

                                        <div class="card mb-3" style="width:150px">
                                            <div class="card-body">
                                                <h6><?= $row['attachment'];?></h6>
                                                <a href="./attachment/<?= $row['attachment'];?>" target="_blank" class="small text-decoration-none text-dark">View</a>
                                                <a  class="small text-decoration-none"href="./attachment/<?= $row['attachment'];?>" Download>Download</a>
                                            </div>
                                        </div>
                                        <?php endif;?>


                                    <h6 class="small text-muted">
                                    Date: <span class=""><?= date("D d M Y",strtotime($row['date']));?></span>
                            <span class="small text-muted"><?= date("h:i A",strtotime($row['date']));?></span>

                                    </h6>
                                </div>
                            </div>
                    </div>
                        
                     
            </div>
        </div>
    </div>
    
    

    <?php
    if(isset($_GET['resend'])){
        $id = $_GET['resend'];

        $query = mysqli_query($conn,"UPDATE mail SET status='0' WHERE m_id='$id'");
        echo "<script>window.open('draft.php','_self')</script>";
    }
    ?>



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>