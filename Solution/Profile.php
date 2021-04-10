<?php
include_once "CommonSolution/Model/User.php";

session_start();

include("CommonSolution/Header.php");

if(!isset($_SESSION["user"]))
{
    header("Location:Login.php");
}else{
    $user = $_SESSION["user"];
}
if(isset($_POST['logout'])){
    $user = '';
    header("Location:Login.php");
}
?>

<div class="container">
        <div class="main-body  mt-5">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <form method="post">
                                    <h4><?php echo $user->getFullName();?></h4>
                                    <p class="text-secondary mb-1">Full Stack Developer</p>
                                    <button class="btn btn-primary">Settings</button>
                                    <button class="btn btn-outline-danger" name="logout">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $user->getFullName();?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $user->getEmail();?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $user->getPhone();?>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include("CommonSolution/Footer.php")?>