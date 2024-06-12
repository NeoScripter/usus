<?php
session_start();
$first_name = '';
if (isset($_SESSION["useruid"])) {
    $full_name = explode(' ', $_SESSION["useruid"]);
    $first_name = $full_name[1];
}

include_once "../classes/dbh.classes.php";
include_once "../classes/dbh.handler.classes.php";

$dbhhandler = new DbhHandler();
$templates = $dbhhandler->fetchTemplates();
?>
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
        <main>
            <h2 class="docs-heading">Организационные документы</h2>
            <section class="docs-form-wrapper">
                <form action="../includes/generate-doc.inc.php" class="docs-form" method="post">
                    <label for="doc-name">Совещание ректора</label>
                    <select name="doc-name">
                        <?php foreach ($templates as $template): ?>
                            <?php if ($template['template_menu'] === 'rector'): ?>
                                <option value="<?php echo $template['template_url']; ?>"><?php echo $template['template_name']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="event-form-btn">Скачать</button>
                </form>
                <form action="../includes/generate-doc.inc.php" class="docs-form" method="post">
                    <label for="doc-name">Шаблоны документов</label>
                    <select name="doc-name">
                        <?php foreach ($templates as $template): ?>
                            <?php if ($template['template_menu'] === 'other'): ?>
                                <option value="<?php echo $template['template_url']; ?>"><?php echo $template['template_name']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="prep-form-btn">Скачать</button>
                </form>
            </section>
        </main>
    </div>
    <script src="../assets/js/ajax-event-hd.js"></script>
</body>
</html>