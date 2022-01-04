<a href="#insert" data-bs-toggle="modal" class="btn btn-outline-danger btn-lg px-5 py-2 mb-3">Compose</a>
<div class="modal fade" id="insert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">send mail</div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="email" name="to" placeholder="To." class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="subject" placeholder="subject." class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="attachment" class="form-control">
                    </div>
                    <div class="mb-3">
                        <textarea name="content" rows="5" placeholder="write your mail " class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="save" value="Save" class="btn btn-info text-light">
                        <input type="submit" name="send" value="send" class="btn btn-success float-end">
                    </div>
                </form>
                <?php
                if (isset($_POST['send']) || isset($_POST['save'])) {
                    $sender_id = $user['id'];
                    // receiver id 
                    $to = $_POST['to'];
                    $query = mysqli_query($conn, "select * from account where email ='$to'");
                    $count = mysqli_num_rows($query);
                    if ($count>0) {
                        $receive = mysqli_fetch_array($query);
                        $receiver_id = $receive['id'];
                        $subject = $_POST['subject'];
                        $content = $_POST['content'];
                        //file work
                        $file = $_FILES['attachment']['name'];
                        $tmp_file = $_FILES['attachment']['tmp_name'];

                        move_uploaded_file($tmp_file,"attachment/$file");
                        $status = 0;
                        if (isset($_POST['save'])) {
                            $status = 1;
                        }
                        $mail_send = mysqli_query($conn, "insert into mail (sender_id,receiver_id,title,content,attachment,status) value ('$sender_id','$receiver_id','$subject','$content','$file','$status')");
                        if ($mail_send) {
                           header("location: index.php");
                           die();
                        }
                    }
                    else {
                        echo"<script>alert('Invalid Email Id ') </script>";
                    }

                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="list-group">
    <a href="index.php" class="list-group-item list-group-item-action">Inbox
    <sup class="badge bg-danger rounded-circle text-white">
                    <?php 
                    $log = $user['id'];
                    $callingIndox = mysqli_query($conn,"select * from mail where receiver_id = '$log' AND status = '0'");
                    $count_indox = mysqli_num_rows($callingIndox);
                    echo $count_indox;
                    ?>
                </sup>  
    </a>
    <a href="send.php" class="list-group-item list-group-item-action">Send Mail
    <sup class="badge bg-danger rounded-circle text-white">
                    <?php 
                    $log = $user['id'];
                    $callingIndox = mysqli_query($conn,"select * from mail where sender_id = '$log' AND status = '0'");
                    echo  $count = mysqli_num_rows($callingIndox);
                    ?>
                </sup>  
    </a>
    <a href="draft.php" class="list-group-item list-group-item-action">Draft
    <sup class="badge bg-danger rounded-circle text-white">
    <?php 
                    $log = $user['id'];
                    $callingIndox = mysqli_query($conn,"select * from mail where sender_id = '$log' AND status = '1'");
                    echo  $count = mysqli_num_rows($callingIndox);
                    ?>
                </sup>  
    </a>
    <a href="bin.php" class="list-group-item list-group-item-action">Trash
    <sup class="badge bg-danger rounded-circle text-white">
                    <?php 
                    $log = $user['id'];
                    $callingIndox = mysqli_query($conn,"select * from mail where receiver_id = '$log' AND status = '-1' ");
                    $trash_count = mysqli_num_rows($callingIndox);
                    echo $trash_count;
                    ?>
                </sup> 
    </a>
    <a href="" class="list-group-item list-group-item-action">Setting</a>
    <a href="logout.php" class="list-group-item list-group-item-action text-light" style="background-color: #F01800;">Logout</a>
</div>