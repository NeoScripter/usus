<?php

class Login extends Dbh {

    protected function getUser($uid, $pwd) {
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid = ?;');

        if (!$stmt->execute(array($uid))) {
            $stmt = null;
            $_SESSION["login_errors"] = "Не удалось подключиться к базе данных";
            header('location: ../pages/reg.php');
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            $_SESSION["login_errors"] = "Данный пользователь не зарегистрирован";
            header('location: ../pages/reg.php');
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);
        
        if ($checkPwd == false) {
            $stmt = null;
            $_SESSION["login_errors"] = "Неверные имя пользователя или пароль";
            header('location: ../pages/reg.php');
            exit();
        } elseif ($checkPwd == true) {
            echo 'Password verified';
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = ?;');

            if (!$stmt->execute(array($uid))) {
                $stmt = null;
                $_SESSION["login_errors"] = "Не удалось подключиться к базе данных";
                header('location: ../pages/reg.php');
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                $_SESSION["login_errors"] = "Данный пользователь не зарегистрирован";
                header('location: ../pages/reg.php');
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