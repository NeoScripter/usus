<?php 
    session_start();
    $first_name = '';
    if (isset($_SESSION["useruid"])) {
        $full_name = explode(' ', $_SESSION["useruid"]);
        $first_name = $full_name[1];
    }
;?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUS</title>
    <link rel="stylesheet" href="../assets/css/reset.min.css">
    <link rel="stylesheet" href="../assets/css/style.min.css">
</head>
<body>
    <div class="main-outer-wrapper">
        <header class="main-header">
            <div class="logo-wrapper">
                <h1><a href="main.php" class="main-page-link"><img src="../assets/images/svgs/logo-small.svg" alt="logo" class="logo-mobile-heading">USUS</a></h1>
            </div>
            <div class="btn-wrapper">
                <div class="login-nav-menu nav-desktop" style="display: <?php echo ($first_name === '') ? 'none' : '';?>;">
                    <div class="greeting">Добро пожаловать, <?php echo $first_name . '!';?></div>
                </div>
                <a href="reg.php" class="login nav-desktop" style="display: <?php echo ($first_name === '') ? '' : 'none';?>;">
                    <img src="../assets/images/svgs/user-right-01.svg" alt="user">Вход
                </a>
                <a href="../includes/logout.inc.php" class="login nav-desktop" style="display: <?php echo ($first_name === '') ? 'none' : '';?>;">
                    <img src="../assets/images/svgs/user-right-01.svg" alt="user">Выйти
                </a>
                <a href="reg.php" class="login-mobile nav-mobile" style="display: <?php echo ($first_name === '') ? '' : 'none';?>;">
                <img src="../assets/images/svgs/user-right-01.svg" alt="logo" class="logo-mobile">
                </a>
                <a href="../includes/logout.inc.php" class="login-mobile nav-mobile" style="display: <?php echo ($first_name === '') ? 'none' : '';?>;">
                <img src="../assets/images/svgs/arrow-left.svg" alt="logo" class="logo-mobile">
                </a>
            </div>
        </header>