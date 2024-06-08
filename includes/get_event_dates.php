<?php
include '../classes/dbh.classes.php';
include '../classes/dbh.handler.classes.php';

class EventDates extends DbhHandler {
    public function getEventDates() {
        $eventDates = $this->fetchEventDates();
        echo json_encode($eventDates);
    }
}

$eventDates = new EventDates();
$eventDates->getEventDates();
?>
