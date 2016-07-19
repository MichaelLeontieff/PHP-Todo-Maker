<?php
/**
 * Created by PhpStorm.
 * User: michaelleontieff
 * Date: 17/07/2016
 * Time: 12:19 PM
 */

    include_once('class.database.php');

    class ManageUsers {
        public $link;
    
        function __construct() {
            $db_connection = new dbConnection();
            $this->link = $db_connection->connect();
            return $this->link;
        }

        function RegisterUsers($username, $email, $password, $ip_address, $time, $date) {
            $query = $this->link->prepare("INSERT INTO todo.users (username, email, password, ip_address, reg_time, reg_date) 
                VALUES (?, ?, ?, ?, ?, ?)");
            $values = array($username, $email, $password, $ip_address, $time, $date);
            $query->execute($values);
            $counts = $query->rowCount();
            return $counts;
        }

        function LoginUsers($username, $password) {
            $query = $this->link->query("SELECT * FROM todo.users WHERE username = '$username' AND password = '$password'");
            $rowcount = $query->rowCount();
            return $rowcount;
        }

        function GetUserInfo($username) {
            $query = $this->link->query("SELECT * FROM todo.users WHERE username = '$username'");
            $rowcount = $query->rowCount();
            if ($rowcount == 1) {
                $result = $query->fetchAll();
                return $result;
            } else {
                return $rowcount;
            }
        }
    }


?>