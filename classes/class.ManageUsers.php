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

        function RegisterUsers($username, $password, $ip_address, $time, $date) {
            $query = $this->link->prepare("INSERT INTO todo.users (username, password, ip_address, reg_time, reg_date) 
                VALUES (?, ?, ?, ?, ?)");
            $values = array($username, $password, $ip_address, $time, $date);
            $query->execute($values);
            $counts = $query->rowCount();
            return $counts;
        }

        function LoginUsers($username, $password) {
            $query = $this->link->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
            $rowcount = $query->rowCount();
            return $rowcount;
        }

        function GetUserInfo($username) {
            $query = $this->link->query("SELECT * FROM users WHERE username = '$username'");
            $rowcount = $query->rowCount();
            if ($rowcount == 1) {
                $result = $query->fetchAll();
                return $result;
            } else {
                return $rowcount;
            }
        }
    }

    $users = new ManageUsers();
//   echo $users->registerUsers('bob', 'bob', '127.0.0.1', '12:00', '29-02-2012');

?>