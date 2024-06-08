<?php
include '../classes/dbh.classes.php';
include '../classes/dbh.handler.classes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_date = $_POST['event_date'];

    class Events extends DbhHandler {
        public function getEvents($date) {
            $events = $this->fetchEventsByDate($date);
            echo json_encode($events);
        }
    }

    $events = new Events();
    $events->getEvents($event_date);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
