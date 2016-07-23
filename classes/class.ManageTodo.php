<?php
/**
 * Created by PhpStorm.
 * User: michaelleontieff
 * Date: 19/07/2016
 * Time: 7:27 PM
 */

    include_once('class.database.php');
    
    class ManageTodo {
        public $link;

        function __construct() {
            $db_connection = new dbConnection();
            $this->link = $db_connection->connect();
            return $this->link;
        }
        
        function createTodo($username, $title, $description, $due_date, $created_on, $status) {
            $query = $this->link->prepare("INSERT INTO todo.todo (username, title, desc, due_date, created_date, status)
              VALUES (?, ?, ?, ?, ?, ?)");
            $values = array();
            $query->execute($values);
            return $query->rowCount();
        }

        function ListTodo($username, $status) {
            $query = $this->link->query("SELECT * FROM todo.todo WHERE username = '$username' AND status = '$status'");
            $counts = $query->rowCount();
            if($counts >= 1) {
                $result = $query->fetchAll();
            } else {
                $result = $counts;
            }
            return $result;
        }

        function CountTodo($username, $status) {
            $query = $this->link->query("SELECT count(*) AS TOTAL_TODO FROM todo.todo WHERE username = '$username' AND status = '$status'");
            $query->setFetchMode(PDO::FETCH_OBJ);
            $counts = $query->fetchAll();
            return $counts;
        }

        function EditTodo($username, $id, $values) {
            $x = 0;
            foreach ($values as $key => $value) {
                $query = $this->link->query("UPDATE todo.todo SET $key = '$value' WHERE username = '$username' AND id = '$id'");
                $x++;
            }
            return $x;
        }

        function DeleteTodo($username, $id) {
            $query = $this->link->query("DELETE FROM todo.todo WHERE username = '$username' AND id = '$id'");
            return $query->rowCount();
        }
    }