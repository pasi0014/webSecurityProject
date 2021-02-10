<?php


//Get PDO Connection
function getPDO()
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




// functions

//function addNewUser($userId, $name, $phone, $password)
//{
//    $pdo = getPDO();
//    $userId = htmlentities($userId);
//    $name = htmlentities($name);
//    $password = htmlentities($password);
//    $sql = "INSERT INTO user (UserId, Name, Phone, Password) VALUES( :user_id, :name, :phone, :password)";
//
//    $resultSet = $pdo->prepare($sql);
//
//    $resultSet->execute(["user_id"=>$userId, "name"=>$name, "phone"=>$phone, "password"=>$password]);
//}


//function getUserByIdAndPassword($userId, $password)
//{
//    $pdo = getPDO();
//    $userId = htmlentities($userId);
//    $password = htmlentities($password);
//    $sql = "SELECT UserId, Name, Phone FROM user WHERE UserId = :userId AND Password = :password";
//    $resultSet = $pdo->prepare($sql);
//
//    $resultSet->execute(["userId"=>$userId, "password"=>$password]);
//    if ($resultSet)
//    {
//        $row = $resultSet->fetch();
//        if ($row)
//        {
//            return new User($row['UserId'], $row['Name'], $row['Phone'] );
//        }
//        else
//        {
//            return null;
//        }
//    }
//    else
//    {
//        throw new Exception("Query failed! SQL statement: $sql");
//    }
//}