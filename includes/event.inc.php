<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
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
        $_SESSION['event-error'] = $event->error;
        header("location: ../pages/create-event.php");
        exit();
    } else {
        $_SESSION['event-created'] = true;
        header("location: ../pages/create-event.php");
        exit();
    }
} else {
    header("location: ../pages/main.php");
}