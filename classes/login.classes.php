<?php

class Login extends Dbh {

    protected function getUser($uid, $pwd) {
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid = ?;');

        if (!$stmt->execute(array($uid))) {
            $stmt = null;
            $_SESSION["login_errors"] = "Не удалось подключиться к базе данных";
            header('location: ../pages/login.php');
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            $_SESSION["login_errors"] = "Данный пользователь не зарегистрирован";
            header('location: ../pages/login.php');
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);
        
        if ($checkPwd == false) {
            $stmt = null;
            $_SESSION["login_errors"] = "Неверные имя пользователя или пароль";
            header('location: ../pages/login.php');
            exit();
        } elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = ?;');

            if (!$stmt->execute(array($uid))) {
                $stmt = null;
                $_SESSION["login_errors"] = "Не удалось подключиться к базе данных";
                header('location: ../pages/login.php');
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                $_SESSION["login_errors"] = "Данный пользователь не зарегистрирован";
                header('location: ../pages/login.php');
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useruid"] = $user[0]["users_uid"];

            $stmt = null;
        }

        $stmt = null;
    }

    
    
}