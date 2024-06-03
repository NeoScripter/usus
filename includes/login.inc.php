<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $uid = htmlspecialchars($_POST['uid'], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST['pwd'], ENT_QUOTES, 'UTF-8');

    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($uid, $pwd);

    $login->loginUser();
    $_SESSION["login_success"] = true;
    header("location: ../pages/main.php");
    exit();
}