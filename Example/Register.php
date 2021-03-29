<?php

session_start();

include ("CommonExample/Header.php");
include ("CommonExample/Functions.php");


$validate = false;

$errorArray = array();
$customerInfo = array();


if (isset($_POST["btnRegister"])) {

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $username = $_POST['username'];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["repeatPassword"];

    if (!$validate) {
        $firstNameError = ValidateFirstName($firstName);
        $customerInfo['firstName'] = $firstName;
        if (!empty($firstNameError)) {
            $errorArray["firstNameError"] = $firstNameError;
        }

        $lastNameError = ValidateLastName($lastName);
        $customerInfo['lastName'] = $lastName;
        if (!empty($lastNameError)) {
            $errorArray["lastNameError"] = $lastNameError;
        }

        $usernameError = ValidateUserName($username);
        $customerInfo["userName"] = $username;
        if (!empty($usernameError)) {
            $errorArray["usernameError"] = $usernameError;
        }

        $emailError = ValidateEmail($email);
        $customerInfo['email'] = $email;
        if (!empty($emailError)) {
            $errorArray["emailError"] = $emailError;
        }

        $phoneError = ValidatePhoneNumber($phone);
        $customerInfo['phone'] = $phone;
        if (!empty($phoneError)) {
            $errorArray["phoneError"] = $phoneError;
        }

        $passwordError = ValidatePassword($password);
        if (!empty($passwordError)) {
            $errorArray["passError"] = $passwordError;
        }

        $confirmPasswordError = ValidatePasswords($password, $confirmPassword);
        if (!empty($confirmPasswordError)) {
            $errorArray["confirmPasswordError"] = $confirmPasswordError;
        } else {
            //Create hashed password
            $hashedPassword = hash("sha512", $password);
        }

        if (getUserByUserName($username) != null) {
            $existError = "User with such username already exists!";
            $errorArray["existsError"] = $existError;
        }

        if (empty($errorArray)) $validate = true;

    }

    if ($validate) {
        try {
            addNewUser($username, $firstName, $lastName, $email, $hashedPassword, $phone);
            $user = getUserByUserName($username);
            if($user != null) {
                $_SESSION["user"] = $user;
                header("Location:Profile.php");
            }else {
                $errorArray["registerError"] = "Something bad happened";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}


?>


<div class="container centered mb-5">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <!--     REGISTER FORM       -->
                    <form method="post" action="Register.php" name="registerForm">
                        <div class="col-sm-12 col-md-8 col-lg-8 m-auto">
                            <div class="form-group-row">
                                <h1 class="text-center text-white mb-5" style="font-size:3.5rem;">Register</h1>
                            </div>

                            <div class="form-group row">
                            <?php if(!empty($errorArray["registerError"])):?>
                                <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                    <?php echo $errorArray['registerError'];?>
                                </small>
                            <?php endif;?>
                            </div>

                            <div class="form-group row">
                                <label for="firstName" class="inputlabel">First Name:</label>
                                <input type="text" name="firstName" id="firstName" class="form-control" value="<?php echo isset($customerInfo['firstName']) ? $customerInfo['firstName'] : '' ?>"\>
                                <?php if(!empty($errorArray["firstNameError"])):?>
                                    <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                        <?php echo $errorArray['firstNameError'];?>
                                    </small>
                                <?php endif;?>
                            </div>

                            <div class="form-group row">
                                <label for="lastName" class="inputlabel">Last Name:</label>
                                <input type="text" name="lastName" id="lastName" class="form-control" value="<?php echo isset($customerInfo['lastName']) ? $customerInfo['lastName'] : '' ?>"\>
                                <?php if(!empty($errorArray["lastNameError"])):?>
                                    <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                        <?php echo $errorArray['lastNameError'];?>
                                    </small>
                                <?php endif;?>
                            </div>


                            <div class="form-group row">
                                <label for="username" class="inputlabel">User Name:</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($customerInfo['userName']) ? $customerInfo['userName'] : '' ?>"\>
                                <?php if(!empty($errorArray["usernameError"])):?>
                                    <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                        <?php echo $errorArray['usernameError'];?>
                                    </small>
                                <?php endif;?>
                                <?php if(!empty($errorArray["existsError"])):?>
                                    <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                        <?php echo $errorArray["existsError"];?>
                                    </small>
                                <?php endif;?>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="inputlabel">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($customerInfo['email']) ? $customerInfo['email'] : '' ?>" \>
                                <?php if(!empty($errorArray["emailError"])):?>
                                    <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                        <?php echo $errorArray['emailError'];?>
                                    </small>
                                <?php endif;?>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="inputlabel">Phone Number:</label>
                                <input type="phone" name="phone" id="phone" class="form-control" placeholder="(nnn)-(nnn)-(nnnn)" value="<?php echo isset($customerInfo['phone']) ? $customerInfo['phone'] : '' ?>"/>
                                <?php if(!empty($errorArray["phoneError"])):?>
                                    <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                        <?php echo $errorArray['phoneError'];?>
                                    </small>
                                <?php endif;?>
                            </div>

                            <div class="form-group row">
                                <label for="passwordInput" class="inputlabel" ">Password:</label>
                                <input type="password" name="password" id="passwordInput" class="form-control" \>
                                <?php if(!empty($errorArray["passError"])):?>
                                    <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                        <?php echo $errorArray['passError'];?>
                                    </small>
                                <?php endif;?>
                                <div class="mt-4">
                                    <input type="checkbox" style="width:20px; height: 20px;" onclick="showPassword()"/>
                                    <span class=" mt-3 text-white">Show password</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="repeatPassword" class="inputlabel" ">Repeat Password:</label>
                                <input type="password" name="repeatPassword" id="repeatPassword" class="form-control" \>
                                <?php if(!empty($errorArray["confirmPasswordError"])):?>
                                    <small class="mt-3" style="color:yellow; font-weight: 600; font-size:15px;">
                                        <?php echo $errorArray['confirmPasswordError'];?>
                                    </small>
                                <?php endif;?>
                            </div>

                            <div class="form-group row mt-5">
                                <button type="submit" class="btn btn-block btn-primary btn-lg" name="btnRegister">Register</button>
                                <button type="reset" class="btn btn-block btn-danger btn-lg" name="reset">Clear</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <p class="text-white m-auto">Already have an account? You can login <button type="button" class="btn btn-outline-light" name="login"><a href="Login.php" style="text-decoration: azure">here</a></button></p>
                        </div>

                    </form>
                </div>
        </div>
    </div>
</div>


<?php include "CommonExample/Footer.php";?>
