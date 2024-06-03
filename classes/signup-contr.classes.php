<?php

class SignupContr extends Signup {
     
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $company;

    public function __construct($uid, $pwd, $pwdRepeat, $company) {
        if (!mb_check_encoding($uid, 'UTF-8')) {
            $uid = mb_convert_encoding($uid, 'UTF-8');
        }
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->company = $company;
    }

    public function signupUser() {
        session_start();
        if ($this->emptyInput() == false) {
            $_SESSION["signup_errors"] = "Заполните все поля";
            header('location: ../pages/reg.php');
            exit();
        }
        if ($this->isUidValid() == false) {
            $_SESSION["signup_errors"] = "Введите свои полные фамилию, имя и отчество на русском языке";
            header('location: ../pages/reg.php');
            exit();
        }
        if ($this->pwdMatch() == false) {
            $_SESSION["signup_errors"] = "Пароли должны совпадать";
            header('location: ../pages/reg.php');
            exit();
        }
        if ($this->uidTakenCheck() == false) {
            $_SESSION["signup_errors"] = "Данный пользователь уже зарегистрирован";
            header('location: ../pages/reg.php');
            exit();
        }
        if ($this->companyNameExists() == false) {
            $_SESSION["signup_errors"] = "Введите правильное название организации";
            header('location: ../pages/reg.php');
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    private function emptyInput() {
        $result;
        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->company)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function isUidValid() {
        $result;
        $pattern = '/^[А-Яа-яЁё]+ [А-Яа-яЁё]+ [А-Яа-яЁё]+$/u';

        if (preg_match($pattern, $this->uid)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }


    private function pwdMatch() {
        $result;
        if ($this->pwd !== $this->pwdRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck() {
        $result;
        if (!$this->checkUser($this->uid)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function companyNameExists() {
        $result;
        if ($this->checkCompany($this->company)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function fetchUserId($uid) {
        $userId = $this->getUserId($uid);
        return $userId[0]["users_id"];
    }
}