<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $uid = htmlspecialchars($_POST['uid'], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST['pwd'], ENT_QUOTES, 'UTF-8');
    $pwdRepeat = htmlspecialchars($_POST['pwdrepeat'], ENT_QUOTES, 'UTF-8');
    $company = htmlspecialchars($_POST['company'], ENT_QUOTES, 'UTF-8');

    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $company);

    $signup->signupUser();

    $_SESSION["signup_success"] = true;
    header("location: ../pages/reg.php");
    exit();
}