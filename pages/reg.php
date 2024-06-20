<?php
    session_start();
    $signup_errors = isset($_SESSION["signup_errors"]) ? $_SESSION["signup_errors"] : '';
    if (isset($_SESSION["signup_success"])) {
        echo '<script>alert("Пользователь успешно зарегистрирован!")</script>';
    }
    unset($_SESSION["signup_errors"], $_SESSION["signup_success"]);

    if (isset($_SESSION["useruid"])) {
        header("location: main.php");
    }

    include "../classes/dbh.classes.php";
    include "../classes/dbh.handler.classes.php";
    $dbhandler = new DbhHandler;
    $companies = $dbhandler->fetchCompanies();
;?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUS</title>
    <link rel="stylesheet" href="../assets/css/reset.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
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
        <main class="main-leaf-left">
            <section class="reg-form-section">
                <div class="form-main-wrapper">
                    <div class="reg-form-link-wrapper">
                        <h2>УЖЕ ЕСТЬ АККАУНТ?</h2>
                        <p>Для того, чтобы продолжить работу введите данные своего аккаунта.</p>
                        <a href="login.php">Войти</a>
                    </div>
                    <div class="main-signup form-wrapper">
                        <h2>Зарегистрироваться</h2>
                        <form action="../includes/signup.inc.php" method="post" class="signup-form" autocomplete="on">
                            <input type="text" name="uid" placeholder="Введите свое ФИО...">
                            <input type="password" name="pwd" placeholder="Введите пароль">
                            <input type="password" name="pwdrepeat" placeholder="Повторите пароль">
                            <select name="company">
                                <?php foreach($companies as $company):?>
                                    <option value="<?php echo $company['company_name'];?>"><?php echo $company['company_name'];?></option>
                                <?php endforeach;?>
                            </select>
                            <p class="errors"><?php echo $signup_errors ;?></p>
                            <button type="submit" name="submit" class="submit-btn">Зарегистрироваться</button>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>