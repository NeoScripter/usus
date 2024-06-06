<?php

class Events extends Dbh {

    protected function setEvent($name, $start_date, $end_date, $venue, $frequency) {
        $stmt = $this->connect()->prepare('INSERT INTO events (event_name, event_start_date, event_end_date, event_venue, event_frequency) VALUES (?, ?, ?, ?, ?);');

        if (!$stmt->execute(array($name, $start_date, $end_date, $venue, $frequency))) {
            $stmt = null;
            header('location: ../pages/create-event.php?error-stmtfailed');
            exit();
        }
        
        $stmt = null;
    }

    protected function wasEventAlreadyCreated($name, $start_date, $end_date) {
        $stmt = $this->connect()->prepare('SELECT event_id FROM events WHERE event_name = ? AND event_start_date = ? AND event_end_date = ?;');

        if (!$stmt->execute(array($name, $start_date, $end_date))) {
            $stmt = null;
            header('location: ../pages/create-event.php?error-stmtfailed');
            exit();
        }
        
        $resultCheck;
        if ($stmt->rowCount() > 0) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        
        return $resultCheck;
    }
}