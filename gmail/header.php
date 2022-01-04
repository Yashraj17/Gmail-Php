<?php
if (isset($_SESSION['user'])) {
    $log = $_SESSION['user'];
    $query = mysqli_query($conn,"select * from account where email ='$log'");
    $user = mysqli_fetch_array($query);
}
?>
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #F01800;">
    <div class="container">
        <a href="index.php" class="navbar-brand">GMAIL</a>
        <form action="" class="d-flex">
            <div class="input-group">
                <input type="search" name="search" class="form-control" size="50"  placeholder="Search mail">
                <input type="submit" name="go" class="btn btn-dark" value="search">
            </div>
        </form>
                <ul class="navbar-nav">
                    <?php
                     if (isset($_SESSION['user'])): ?>
                    <li class="nav-item"><a href="" class="nav-link text-capitalize"><?= $user['name'] ?></a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                    <?php else: ?> 
                    <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="signup.php" class="nav-link">Signup</a></li>
                    <?php endif; ?> 
                </ul>
    </div>
</nav>