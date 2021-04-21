<?php
include_once "connection.php";

if($_SESSION['loggedIn'] == true){
    header("Location: index.php");
}


//Has person logged in before with cookies?
$username = $_POST['username'];
$password = $_POST['password'];


$hash = checkDatabaseForPassword($pdo, $username);

if (password_verify($password, $hash)) {
    setcookie("username", $username, time() + (86400 * 30), "/");
    setcookie("password", $password, time() + (86400 * 30), "/");
    echo "tada, je bent ingelogt";
} else {
    echo "fout wachtwoord";
}

header("Location: index.php");
function checkDatabaseForPassword(PDO $pdo, $username)
{
    $stmt = $pdo->prepare("SELECT password FROM user WHERE username = :user");
    $stmt->execute([":user" => $username]);
    $result = $stmt->fetchAll();
    $hash = $result[0]['password'];
    return $hash;
}
