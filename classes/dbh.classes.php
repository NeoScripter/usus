<?php

class Dbh {
    protected function connect() {
        try {
            $username = "root";
            $password = "";
            $host = 'localhost';
            $dbname = 'ususlogin';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $dsnWithoutDb = 'mysql:host=' . $host . ';charset=utf8mb4';

            $dbh = new PDO($dsnWithoutDb, $username, $password, $options);

            $dbh->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

            $dsnWithDb = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8mb4';

            $dbh = new PDO($dsnWithDb, $username, $password, $options);

            $dbh->exec("SET NAMES 'utf8mb4'");
            $dbh->exec("SET CHARACTER SET utf8mb4");

            $createTableUsers = "CREATE TABLE IF NOT EXISTS users (
                users_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
                users_uid TINYTEXT not null,
                users_pwd LONGTEXT not null,
                users_company TINYTEXT not null,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $createTableCompanies = "CREATE TABLE IF NOT EXISTS companies (
                company_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
                company_name LONGTEXT not null
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $createTableEvents = "CREATE TABLE IF NOT EXISTS events (
                event_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
                event_name TINYTEXT not null,
                event_start_date DATE not null,
                event_end_date DATE not null,
                event_venue TINYTEXT not null,
                event_frequency TINYTEXT not null,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $createTablePreps = "CREATE TABLE IF NOT EXISTS preps (
                prep_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
                prep_name TINYTEXT not null
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $dbh->exec($createTableUsers);
            $dbh->exec($createTableCompanies);
            $dbh->exec($createTableEvents);
            $dbh->exec($createTablePreps);

            return $dbh;

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
