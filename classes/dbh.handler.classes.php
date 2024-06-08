<?php

class DbhHandler extends Dbh {
    public function fetchCompanies() {
        try {
            $sql = "SELECT company_name FROM companies";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function fetchPreps() {
        try {
            $sql = "SELECT * FROM preps";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function fetchEventDates() {
        try {
            $sql = "SELECT DISTINCT event_start_date FROM events";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function fetchEventsByDate($date) {
        try {
            $sql = "SELECT * FROM events WHERE event_start_date = :event_date";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['event_date' => $date]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
