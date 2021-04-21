<?php
setcookie("username", "", time() - 3600, "/");
setcookie("password", "", time() - 3600, "/");
$_SESSION['loggedIn'] = false;

header("Location: index.php");
exit;