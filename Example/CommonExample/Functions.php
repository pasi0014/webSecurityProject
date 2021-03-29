<!-- Nazar Pasika for Web Security Class-->
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
function ValidateUserName($userName) : string
{
    return (empty($userName)) ? "Username is required" : "";
}
//Validate First Name
function ValidateFirstName($name) : string {
    return (empty($userName)) ? "First Name is required" : "";
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
 * Purpose of following functions is to
 * present SQL Injection and highlight common vulnerabilities
 * */


/*
 * Creates PDO object
 *
 * @return PDO object
 * */
function getPDO() : PDO
{
    $dbConnection = parse_ini_file("db_connection.ini");
    extract($dbConnection);
    return new PDO($dsn, $user, $password);
}

/*
 * @param string
 *
 * @return User object or 0
 * */
function getUserByUserName($userName)
{
    $pdo = getPDO();
    $sql = "SELECT * FROM users WHERE username = '$userName'";
    $resultSet = $pdo->query($sql);

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

/*
 * @param string
 *
 * @return bool
 * */
function addNewUser($userName, $firstName, $lastName, $email, $pass, $phone) : bool
{
    $pdo = getPDO();
    $created_at = date("Y/m/d");
    $sql = "INSERT INTO users (firstName, lastName, email, password, username, phone, create_at) VALUES('$firstName', '$lastName', '$email', '$pass', '$userName', '$phone', '$created_at')";
    $result = $pdo->exec($sql);

    return ($result) ? true : false;
}

/*
 * @param string
 *
 * @return User object or 0
 * */
function getUserByIdAndPassword($userName, $password)
{
    $pdo = getPDO();
    $sql = "SELECT * FROM users WHERE username = '$userName' AND password = '$password'";

    $resultSet = $pdo->query($sql);

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

