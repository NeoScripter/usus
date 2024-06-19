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

$event_errors = '';
if (isset($_SESSION['event-error'])) {
    $event_errors = $_SESSION['event-error'];
} elseif (isset($_SESSION['event-success'])) {
    echo '<script>alert("Мероприятие успешно создано!")</script>';
}
unset($_SESSION['event-error'], $_SESSION['event-success']);

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
    <div class="main-outer-wrapper main-leaf-left">
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
                <h2>СОЗДАНИЕ МЕРОПРИЯТИЯ</h2>
                <form action="../includes/event.inc.php" class="create-event-form" method="post" id="eventForm">
                    <label for="name">Укажите название мероприятия</label>
                    <input type="text" name="name">
                    <label for="start-date">Выберите дату начала мероприятия</label>
                    <input type="date" name="start-date">
                    <label for="end-date">Выберите дату окончания мероприятия</label>
                    <input type="date" name="end-date">
                    <label for="venue">Выберите место проведения мероприятия</label>
                    <select name="venue">
                        <option value="Выездное">Выездное</option>
                        <option value="Учебный театр">Учебный театр</option>
                        <option value="Концертный зал">Концертный зал</option>
                        <option value="Холл">Холл</option>
                        <option value="137 аудитория">137 аудитория</option>
                        <option value="32 аудитория">32 аудитория</option>
                        <option value="113 аудитория">113 аудитория</option>
                        <option value="132 аудитория">132 аудитория</option>
                        <option value="50 аудитория">50 аудитория</option>
                        <option value="400 аудитория">400 аудитория</option>
                        <option value="302 аудитория">302 аудитория</option>
                    </select>
                    <label for="frequency">Выберите периодичность мероприятия</label>
                    <select name="frequency">
                        <option value="Ежегодное">Ежегодное</option>
                        <option value="Разовое">Разовое</option>
                    </select>
                    <p class="errors"><?php echo $event_errors ;?></p>
                    <button type="submit" class="event-form-btn">Создать</button>
                </form>
            </section>
        </main>
    </div>
    <script src="../assets/js/ajax-event-hd.js"></script>
</body>
</html>