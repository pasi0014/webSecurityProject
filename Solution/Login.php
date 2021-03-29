<?php

session_start();

include ("CommonSolution/Header.php");
include ("CommonSolution/Functions.php");


$validate = false;

$errorArray = array();
$customerInfo = array();

if(isset($_POST["btnLogin"])) {

    //sanitize posted data
    $userName = htmlspecialchars($_POST["userName"]);
    $password = htmlspecialchars($_POST["password"]);

    if(!$validate){

        $userNameError = ValidateUserName($userName);
        if(!empty($userNameError)) $errorArray['userNameError'] = $userNameError;

        $passwordError = ValidatePassword($password);
        if(!empty($passwordError)) {
            $errorArray["passError"] = $passwordError;
        }else{
            $hashedPassword = hash("sha512", $password);
        }

        if(empty($errorArray)) $validate = true;
    }
    if($validate)
    {
        try{
            $user = getUserByIdAndPassword($userName, $hashedPassword);
            if($user != null) {
                $_SESSION["user"] = $user;
                header("location:Profile.php");
            }else {
                $errorArray['loginError'] = "Username or password is incorrect. Please, try again.";
            }
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}

?>


<div class="container centered mb-5">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <!--     LOGIN FORM       -->
                <form method="post" action="Login.php" name="login">
                    <div class="col-sm-12 col-md-8 col-lg-8 m-auto">
                        <div class="form-group-row">
                            <h1 class="text-center text-white mb-5" style="font-size:3.5rem;">Login</h1>
                        </div>

                        <!--        USER NAME          -->

                        <div class="form-group row">
                            <label for="userName" class="font-weight-bold text-white" style="font-size:18px;">User Name:</label>
                            <input type="text" name="userName" id="userName" class="form-control" \>
                            <?php if(!empty($errorArray["userNameError"])):?>
                                <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                    <?php echo $errorArray['userNameError'];?>
                                </small>
                            <?php endif;?>
                        </div>

                        <!--        PASSWORD INPUT          -->

                        <div class="form-group row">
                            <label for="passwordInput" class="font-weight-bold text-white" style="font-size:18px;">Password:</label>
                            <input type="password" name="password" id="passwordInput" class="form-control" \>

                            <?php if(!empty($passwordError)):?>
                                <div class="form-group mt-2 w-100">
                                    <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                        <?php echo $errorArray['passError']?>
                                    </small>
                                </div>
                            <?php endif?>

                            <?php if(!empty($errorArray['loginError'])):?>
                                <div class="form-group mt-2 w-100">
                                    <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                        <?php echo $errorArray['loginError']?>
                                    </small>
                                </div>
                            <?php endif?>
                            <div class="mt-4">
                                <input type="checkbox" style="width:20px; height: 20px;" onclick="showPassword()"/>
                                <span class=" mt-3 text-white">Show password</span>
                            </div>

                        </div>

                        <!--        BUTTONS          -->

                        <div class="form-group row mt-2">
                            <button type="submit" class="btn btn-block btn-lg btn-primary" name="btnLogin">Login</button>
                            <button type="reset" class="btn btn-block btn-lg btn-danger" name="reset">Clear</button>
                        </div>


                        <div class="form-group row mt-5">
                            <p class="text-white m-auto">Don't have an account. You can register <button type="button" class="btn btn-outline-light" name="register"><a href="Register.php" style="text-decoration: azure">here</a></button></p>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>


<?php include ("CommonSolution/Footer.php");?>
