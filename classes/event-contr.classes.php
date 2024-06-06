<?php

class EventsContr extends Events {
    public $error;

    public function __construct() {
        $this->error = '';
    }

    public function updateEventsTable($name, $start_date, $end_date, $venue, $frequency) {
        // Error handlers
        if ($this->emptyInputCheck($name, $start_date, $end_date, $venue, $frequency) == true) {
            $this->error = 'Заполните все поля!';
            return;
        }
        if ($this->checkEventNameLetters($name) == true) {
            $this->error = 'Название мероприятия должно содержать только буквы и пробелы!';
            return;
        }
        if ($this->isEventNameTooShort($name) == true) {
            $this->error = 'Слишком короткое название мероприятия!';
            return;
        }
        if ($this->isEventNameTooLong($name) == true) {
            $this->error = 'Слишком длинное название мероприятия!';
            return;
        }
        if ($this->checkEventDateFormat($start_date, $end_date) == true) {
            $this->error = 'Неправильный формат даты мероприятия!';
            return;
        }
        if ($this->checkEventDateOrder($start_date, $end_date) == true) {
            $this->error = 'Дата начала мероприятия должна быть раньше даты его окончания!';
            return;
        }
        if ($this->checkEventVenue($venue) == true) {
            $this->error = 'Выберите место проведения мероприятия из предоставленного списка!';
            return;
        }
        if ($this->checkEventFrequency($frequency) == true) {
            $this->error = 'Выберите частоту проведения мероприятия из предоставленного списка!';
            return;
        }
        if ($this->doesEventAlreadyExist($name, $start_date, $end_date) == true) {
            $this->error = 'Данное мероприятие уже находится в списке!';
            return;
        }


        // Update events table
        $this->setEvent($name, $start_date, $end_date, $venue, $frequency);
    }

    private function emptyInputCheck($name, $start_date, $end_date, $venue, $frequency) {
        $result;
        if (empty($name) || empty($start_date) || empty($end_date) || empty($venue) || empty($frequency)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    private function checkEventNameLetters($eventName) {
        $result;
        if (!preg_match("/^[a-zA-Zа-яА-Я\s\-]+$/u", $eventName)) {
            $result = true; // The event name contains invalid characters
        } else {
            $result = false;
        }
        return $result;
    }

    private function isEventNameTooShort($eventName) {
        $result;
        if (strlen($eventName) < 3) {
            $result = true; // The event name length is not between 3 and 30 characters
        } else {
            $result = false;
        }
        return $result;
    }

    private function isEventNameTooLong($eventName) {
        $result;
        if (strlen($eventName) > 100) {
            $result = true; // The event name length is not between 3 and 30 characters
        } else {
            $result = false;
        }
        return $result;
    }
    
    private function checkEventDateFormat($eventStartDate, $eventEndDate) {
        $result;
        if (!DateTime::createFromFormat('Y-m-d', $eventStartDate) || !DateTime::createFromFormat('Y-m-d', $eventEndDate)) {
            $result = true; // The event date format is incorrect
        } else {
            $result = false;
        }
        return $result;
    }
    
    private function checkEventDateOrder($eventStartDate, $eventEndDate) {
        $result;
        if (strtotime($eventStartDate) > strtotime($eventEndDate)) {
            $result = true; // The event start date is not earlier than the event end date
        } else {
            $result = false;
        }
        return $result;
    }

    private function doesEventAlreadyExist($name, $start_date, $end_date) {
        $result;
        if ($this->wasEventAlreadyCreated($name, $start_date, $end_date)) {
            $result = true; // The event was already created
        } else {
            $result = false;
        }
        return $result;
    }
    
    private function checkEventVenue($eventVenue) {
        $result;
        $validVenues = [
            "Выездное",
            "Учебный театр",
            "Концертный зал",
            "Холл",
            "137 аудитория",
            "32 аудитория",
            "113 аудитория",
            "132 аудитория",
            "50 аудитория",
            "400 аудитория",
            "302 аудитория"
        ];
        if (!in_array($eventVenue, $validVenues)) {
            $result = true; // The event venue is not valid
        } else {
            $result = false;
        }
        return $result;
    }
    
    private function checkEventFrequency($eventFrequency) {
        $result;
        $validFrequencies = ["Ежегодное", "Разовое"];
        if (!in_array($eventFrequency, $validFrequencies)) {
            $result = true; // The event frequency is not valid
        } else {
            $result = false;
        }
        return $result;
    }
    
}