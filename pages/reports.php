<?php
session_start();
$first_name = '';
if (isset($_SESSION["useruid"])) {
    $full_name = explode(' ', $_SESSION["useruid"]);
    $first_name = $full_name[1];
}

if ($first_name === '') {
    header("location: reg.php");
    exit();
}

include_once "../classes/dbh.classes.php";
include_once "../classes/dbh.handler.classes.php";

$dbhhandler = new DbhHandler();
$preps = $dbhhandler->fetchPreps();
?>
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
    <div class="main-outer-wrapper main-leaf-right">
        <header class="main-header">
            <div class="logo-wrapper">
                <h1><a href="main.php" class="main-page-link"><img src="../assets/images/svgs/logo-small.svg" alt="logo" class="logo-mobile-heading">USUS</a></h1>
                <a href="main.php" class="main-page-link__arrow"><img src="../assets/images/svgs/arrow-left.svg" alt="logo"></a>
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
        <main>
            <section class="form-wrapper">
                <h2>ОТЧЕТ ПО МЕРОПРИЯТИЮ</h2>
                <h3>ЧЕК-ЛИСТ ПОДГОТОВКИ</h3>
                <form action="../includes/prep.inc.php" class="preparation-form" method="post">
                    <div class="checkbox-group">
                        <?php foreach($preps as $prep):?>
                            <label><input type="checkbox" name="preps[]" value="<?php echo $prep['prep_name']; ?>"> <?php echo $prep['prep_name']; ?></label>
                        <?php endforeach;?>
                    </div>
                    <button type="submit" class="prep-form-btn">Скачать</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>