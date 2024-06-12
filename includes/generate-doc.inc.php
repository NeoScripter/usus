<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $templatePath = $_POST['doc-name'];
    $content = file_get_contents($templatePath);

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=document.doc");

    ob_start();
    echo $content;

    $output = ob_get_clean();

    echo $content;
    exit;
}
