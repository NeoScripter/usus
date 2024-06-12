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
    public function fetchTemplates() {
        try {
            $sql = "SELECT * FROM templates";
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
            $sql = "SELECT event_start_date, event_end_date FROM events";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $dates = [];
            foreach ($events as $event) {
                $startDate = new DateTime($event['event_start_date']);
                $endDate = new DateTime($event['event_end_date']);
                $interval = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($startDate, $interval, $endDate->modify('+1 day'));

                foreach ($period as $date) {
                    $dates[] = $date->format('Y-m-d');
                }
            }

            return array_values(array_unique($dates));
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function fetchEventsByDate($date) {
        try {
            $sql = "SELECT * FROM events WHERE :event_date BETWEEN event_start_date AND event_end_date";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['event_date' => $date]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
}
