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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="main-outer-wrapper">
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
        <main class="docs-main">
            <h2 class="docs-heading">Организационные документы</h2>
            <div class="docs-wrapper">
                <section class="form-wrapper">
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
                </section>
                <section class="form-wrapper">
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
            </div>
        </main>
    </div>
    <script src="../assets/js/ajax-event-hd.js"></script>
</body>
</html>