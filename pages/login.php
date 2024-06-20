<?php
    session_start();
    $login_errors = isset($_SESSION["login_errors"]) ? $_SESSION["login_errors"] : '';
    unset($_SESSION["login_errors"]);

    if (isset($_SESSION["useruid"])) {
        header("location: main.php");
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
                <a href="main.php" class="login nav-desktop">
                    <img src="../assets/images/svgs/arrow-left.svg" alt="user">На главную
                </a>
                <a href="main.php" class="login-mobile nav-mobile">
                    <img src="../assets/images/svgs/arrow-left.svg" alt="logo" class="logo-mobile">
                </a>
            </div>
        </header>
        <main class="main-leaf-right">
            <section class="reg-form-section">
                <div class="form-main-wrapper">
                    <div class="main-login form-wrapper">
                        <h2>Войти</h2>
                        <form action="../includes/login.inc.php" method="post" class="login-form" autocomplete="on">
                            <input type="text" name="uid" placeholder="Введите свое имя...">
                            <input type="password" name="pwd" placeholder="Введите пароль...">
                            <p class="errors"><?php echo $login_errors ;?></p>
                            <button type="submit" name="submit" class="submit-btn">Войти</button>
                        </form>
                    </div>
                    <div class="reg-form-link-wrapper">
                        <h2>НОВЫЙ ПОЛЬЗОВАТЕЛЬ?</h2>
                        <p>Введите свои данные в форме и можете начать работу.</p>
                        <a href="reg.php">ЗАРЕГИСТРИРОВАТЬСЯ</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>