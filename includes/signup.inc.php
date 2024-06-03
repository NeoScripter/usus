<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $uid = htmlspecialchars($_POST['uid'], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST['pwd'], ENT_QUOTES, 'UTF-8');
    $pwdRepeat = htmlspecialchars($_POST['pwdrepeat'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');

    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);

    $signup->signupUser();

    header("location: ../pages/reg.php");
}