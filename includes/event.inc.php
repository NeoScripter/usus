<?php
session_start();

function isAjaxRequest() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $start_date = htmlspecialchars($_POST['start-date'], ENT_QUOTES, 'UTF-8');
    $end_date = htmlspecialchars($_POST['end-date'], ENT_QUOTES, 'UTF-8');
    $venue = htmlspecialchars($_POST['venue'], ENT_QUOTES, 'UTF-8');
    $frequency = htmlspecialchars($_POST['frequency'], ENT_QUOTES, 'UTF-8');

    include "../classes/dbh.classes.php";
    include "../classes/event.classes.php";
    include "../classes/event-contr.classes.php";
    $event = new EventsContr();

    $event->updateEventsTable($name, $start_date, $end_date, $venue, $frequency);

    if ($event->error !== '') {
        if (isAjaxRequest()) {
            echo json_encode(['success' => false, 'error' => $event->error]);
        } else {
            $_SESSION['event-error'] = $event->error;
            header("Location: ../pages/create-event.php");
        }
    } else {
        if (isAjaxRequest()) {
            echo json_encode(['success' => true, 'message' => 'Мероприятие успешно создано!']);
        } else {
            $_SESSION['event-success'] = 'Мероприятие успешно создано!';
            header("Location: ../pages/create-event.php");
        }
    }
    exit();
} else {
    header("Location: ../pages/main.php");
    exit();
}
?>
