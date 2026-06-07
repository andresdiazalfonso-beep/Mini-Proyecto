<?php
session_start();
$_SESSION = [];
session_destroy();
setcookie("recordar_email","", time() - 3600, "/");
setcookie("recordar_password", "", time() - 3600, "/");
header("Location: ../pages/index.php");
exit();
?>