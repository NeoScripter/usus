<?php

class LoginContr extends Login {
     
    private $uid;
    private $pwd;

    public function __construct($uid, $pwd) {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    public function loginUser() {
        session_start();
        if ($this->emptyInput() == false) {
            $_SESSION["login_errors"] = "Заполните все поля";
            header('location: ../pages/login.php');
            exit();
        }

        $this->getUser($this->uid, $this->pwd);
    }

    private function emptyInput() {
        $result;
        if (empty($this->uid) || empty($this->pwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}