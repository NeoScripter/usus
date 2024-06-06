<?php

class EventsView extends Events {
    protected function getEventByDate($date) {
        $stmt = $this->connect()->prepare('SELECT * FROM events WHERE ? BETWEEN event_start_date AND event_end_date;');

        if (!$stmt->execute(array($uid))) {
            $stmt = null;
            header('location: ../pages/create-event?error-stmtfailed');
            exit();
        }
        
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $events;
    }
}