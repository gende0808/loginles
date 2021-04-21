<?php
include_once "connection.php";
if (!empty($_COOKIE['username']) && !empty($_COOKIE['password'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];

    $hash = checkDatabaseForPassword($pdo, $username);

    if (password_verify($password, $hash)) {
        $_SESSION['loggedIn'] = true;
    }

}

function checkDatabaseForPassword(PDO $pdo, $username)
{
    $stmt = $pdo->prepare("SELECT password FROM user WHERE username = :user");
    $stmt->execute([":user" => $username]);
    $result = $stmt->fetchAll();
    $hash = $result[0]['password'];
    return $hash;
}