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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../assets/js/jquery.js"></script>
</head>
<body>
    <div class="main-outer-wrapper">
        <header class="main-header">
            <div class="logo-wrapper">
                <h1>USUS</h1>
            </div>
            <div class="login-nav-menu">
                <a href="main.php" class="main-page-link">Главная</a>
            </div>
            <div class="btn-wrapper">
                <a href="reg.php" style="display: <?php echo ($first_name === '') ? 'flex' : 'none';?>;">
                    <div class="signup">Регистрация</div>
                    <div class="login">Вход</div>
                </a>
                <div class="login-nav-menu" style="display: <?php echo ($first_name === '') ? 'none' : 'flex';?>;">
                    <div class="greeting">Здравствуйте, <?php echo $first_name;?></div>
                    <a href="../includes/logout.inc.php" class="logout">Выйти</a>
                </div>
            </div>
        </header>