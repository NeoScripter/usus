<?php
    session_start();
    $login_errors = isset($_SESSION["login_errors"]) ? $_SESSION["login_errors"] : '';
    $signup_errors = isset($_SESSION["signup_errors"]) ? $_SESSION["signup_errors"] : '';
    if (isset($_SESSION["signup_success"])) {
        echo '<script>alert("Пользователь успешно зарегистрирован!")</script>';
    }
    unset($_SESSION["login_errors"], $_SESSION["signup_errors"], $_SESSION["signup_success"]);

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
                <h1><a href="main.php" class="main-page-link">USUS</a></h1>
            </div>
            <div class="btn-wrapper">
                <a href="main.php" class="back-btn">
                    Назад
                </a>
            </div>
        </header>
        <main>
        <section class="options">
                <div class="desc">
                    <p>Войдите в систему для того, чтобы получить доступ к работе с секциями "Календарь" и "Мероприятия"</p>
                </div>
            <div class="form-main-wrapper">
                <div class="main-signup form-wrapper">
                    <h3>Зарегистрироваться</h3>
                    <p>Введите ваши данные для регистрации</p>
                    <form action="../includes/signup.inc.php" method="post" class="signup-form" autocomplete="on">
                        <input type="text" name="uid" placeholder="ФИО">
                        <input type="password" name="pwd" placeholder="Пароль">
                        <input type="password" name="pwdrepeat" placeholder="Повторите пароль">
                        <label for="company">Выберите организацию</label>
                        <select name="company">
                            <?php foreach($companies as $company):?>
                                <option value="<?php echo $company['company_name'];?>"><?php echo $company['company_name'];?></option>
                            <?php endforeach;?>
                        </select>
                        <p class="errors"><?php echo $signup_errors ;?></p>
                        <button type="submit" name="submit" class="submit-btn">Создать</button>
                    </form>
                </div>
                <div class="main-login form-wrapper">
                    <h3>Войти</h3>
                    <p>Нет аккаунта? Создайте учетную запись!</p>
                    <form action="../includes/login.inc.php" method="post" class="login-form" autocomplete="on">
                        <input type="text" name="uid" placeholder="Имя">
                        <input type="password" name="pwd" placeholder="Пароль">
                        <p class="errors"><?php echo $login_errors ;?></p>
                        <button type="submit" name="submit" class="submit-btn">Войти</button>
                    </form>
                </div>
            </div>
            </section>
        </main>
    </div>
</body>
</html>