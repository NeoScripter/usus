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
    <link rel="stylesheet" href="../assets/css/style.css">
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
        <main>
            <section class="event-form-wrapper">
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
    <script src="../assets/js/ajax-event-hd.js"></script>
</body>
</html>