<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $templatePath = $_POST['doc-name'];

    $directory = '../templates/';
    $fullPath = $directory . $templatePath;

    header("Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Disposition: attachment; filename=\"" . basename($fullPath) . "\"");
    header("Content-Length: " . filesize($fullPath));

    readfile($fullPath);
    exit;
}
