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
?>
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
                <a href="reg.php" class="login" style="display: <?php echo ($first_name === '') ? 'flex' : 'none';?>;">
                    <img src="../assets/images/svgs/user-right-01.svg" alt="user">Вход
                </a>
                <div class="login-nav-menu" style="display: <?php echo ($first_name === '') ? 'none' : 'flex';?>;">
                    <div class="greeting">Здравствуйте, <?php echo $first_name;?></div>
                    <a href="../includes/logout.inc.php" class="logout">Выйти</a>
                </div>
            </div>
        </header>
        <main>
            <section class="calendar-form-wrapper">
                <div class="calendar-group">
                    <div id="calendar"></div>
                    <div id="events"></div>
                </div>
            </section>
        </main>
    </div>
    <script src="../assets/js/ajax-calendar-hd.js"></script>
</body>
</html>