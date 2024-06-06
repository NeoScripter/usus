<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $preps = isset($_POST['preps']) ? $_POST['preps'] : [];

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=document.doc");

    ob_start();
    echo '<html>';
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
    echo '<body>';
    echo '<h1>Список</h1>';
    $index = 1;
    if (!empty($preps)) {
        foreach($preps as $prep) {
            echo nl2br($index . ') ' . htmlspecialchars($prep, ENT_QUOTES, 'UTF-8') . "\n");
            $index++;
        }
    } else {
        echo '<p>Список пуст.</p>';
    }
    echo '</body>';
    echo '</html>';

    $output = ob_get_clean();
    echo $output;
    exit;
} else {
    header("Location: ../pages/main.php");
    exit;
}
