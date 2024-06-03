<?php

class Signup extends Dbh {

    protected function setUser($uid, $pwd, $company) {
        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_company) VALUES (?, ?, ?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($uid, $hashedPwd, $company))) {
            $stmt = null;
            header('location: ../pages/reg.php?error-stmtfailed');
            exit();
        }
        
        $stmt = null;
    }

    protected function checkUser($uid) {
        $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ?;');

        if (!$stmt->execute(array($uid))) {
            $stmt = null;
            header('location: ../pages/reg.php?error-stmtfailed');
            exit();
        }
        
        $resultCheck;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        
        return $resultCheck;
    }

    protected function checkCompany($company) {
        $stmt = $this->connect()->prepare('SELECT company_name FROM companies WHERE company_name = ?;');

        if (!$stmt->execute(array($company))) {
            $stmt = null;
            header('location: ../pages/reg.php?error-stmtfailed');
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