<!-- Nazar Pasika for Web Security Class -->
<?php
include_once "Model/User.php";

//Summary
//Validate Password
function ValidatePassword($password) : string
{
    if (strlen($password) < 6
        || !preg_match('/[\d]/', $password)
        || !preg_match('/[[:lower:]]/', $password)
        || !preg_match('/[[:upper:]]/', $password)) {
        return "The password must be at least 6 characters long, "
            . "contains at least one upper case, one lowercase and one digit";
    }

    return "";
}
//Validate Email Address
function ValidateEmail($email) : string {
    if(empty($email)){
        return "Email Address is required";
    }
    if(preg_match("/[A-Za-z\d.]+\@[A-Za-z\d]+\.[A-Za-z.]{2,4}$/", $email) === 1){
        return "";
    }else{
        return "Email Address in invalid";
    }
}
//Validate User Name
function ValidateUserName($userName) : string {
    return (empty($userName)) ? "Username is required" : "";
}
//Validate First Name
function ValidateFirstName($name) : string {
    return (empty($name)) ? "First Name is required" : "";
}
//Validate Phone Number
function ValidatePhoneNumber($phoneNumber) : string {
    return (empty($phoneNumber)) ? "Phone Number is required" : "";
}
//Validate Last Name
function ValidateLastName($name) : string {
    return (empty($name)) ? "Last Name is required" : "";
}
//Validate if passwords match
function ValidatePasswords($password, $passConfirm) : string{

    if(empty($passConfirm)) return "Password confirmation required";

    return ($password != $passConfirm) ? "Password did not match. Try again." : "";
}


/*
 * Following functions provide SQL Injection preventions
 * including serializing user inputs
 * */

function getPDO() : PDO
{
    static $db = null;

    if ($db === null) {
        $config = parse_ini_file("db_connection.ini");

        $db = new PDO($config['dsn'], $config['user'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

    }
    return $db;
}

function getUserByUserName($userName)
{
    $pdo = getPDO();
    //Sanitize username
    $userName = htmlspecialchars($userName);
    $sql = "SELECT * FROM users WHERE username = :userN";
    $resultSet = $pdo->prepare($sql);
    $resultSet->execute(['userN' => $userName]);

    if(!$resultSet) return null;

    $row = $resultSet->fetch(PDO::FETCH_ASSOC);

    return ($row) ? new User(
        $row['id'],
        $row['firstName'],
        $row['lastName'],
        $row['username'],
        $row['phone'],
        $row['email']
    ) : null;
}

function addNewUser($userName, $firstName, $lastName, $email, $pass, $phone) : bool
{
    $pdo = getPDO();
    $userName = htmlspecialchars($userName);
    $firstName = htmlspecialchars($firstName);
    $lastName = htmlspecialchars($lastName);
    $email = htmlspecialchars($email);
    $pass = htmlspecialchars($pass);
    $phone = htmlspecialchars($phone);
    $created_at = date("Y/m/d");
    $sql = "INSERT INTO users (firstName, lastName, email, password, username, phone, create_at) VALUES(:firstName, :lastName, :email, :pass, :userName, :phone, :created_at)";
    $result = $pdo->prepare($sql);

    $result->execute([
        'firstName' => $firstName,
        "lastName" => $lastName,
        "email" => $email,
        "pass" => $pass,
        "userName" => $userName,
        "phone" => $phone,
        "created_at" => $created_at
    ]);

    return ($result) ? true : false;
}

function getUserByIdAndPassword($userName, $password)
{
    $pdo = getPDO();
    $userName = htmlspecialchars($userName);
    $password = htmlspecialchars($password);
    $sql = "SELECT * FROM users WHERE username = :userName AND password = :password";

    $resultSet = $pdo->prepare($sql);

    $resultSet->execute([
        'userName' => $userName,
        "password" => $password
    ]);

    if(!$resultSet) return null;

    $row = $resultSet->fetch(PDO::FETCH_ASSOC);

    return ($row) ? new User(
        $row['id'],
        $row['firstName'],
        $row['lastName'],
        $row['username'],
        $row['phone'],
        $row['email']
    ) : null;
}



