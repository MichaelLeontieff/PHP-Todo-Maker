<?php
/**
 * Created by PhpStorm.
 * User: michaelleontieff
 * Date: 18/07/2016
 * Time: 4:46 PM
 */
    include_once('classes/class.ManageUsers.php');

    if (isset($_POST['register'])) {

        session_start();
        $user = new ManageUsers();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $email = $_POST['email'];
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $date = date("Y-m-d");
        $time = date("H:i:s");
        
        if (empty($username) || empty($password) || empty($email) || empty($repassword)) {
            $error = 'All fields are required';
        } elseif ($password != $repassword) {
            $error = 'Password does not match';
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Email is not valid';
        } else {
            $check_availability = $user->GetUserInfo($username);
            if ($check_availability == 0) {
                $register_user = $user->RegisterUsers($username, $email, $password, $ip_address, $time, $date);
                if ($register_user == 1) {
                    $make_sessions = $user->GetUserInfo($username);
                    foreach($make_sessions as $user_sessions) {
                        $_SESSION['todo_name'] = $user_sessions['username'];
                        if (isset($_SESSION['todo_name'])) {
                            header("location: index.php");
                        }
                    }
                }
            } else {
                $error = 'Username already exists';
            }
        }
    }

    if(isset($_POST['login'])) {
        session_start();
        $username = $_POST['login_username'];
        $password = $_POST['login_password'];

        if (empty($username) || empty($password)) {
            $error = 'All fields are required';
        }
        else {
            $login_users = new ManageUsers();
            $auth_user = $login_users->LoginUsers($username, $password);

            if($auth_user == 1) {
                $make_session = $login_users->GetUserInfo($username);
                foreach($make_session as $user_sessions) {
                    $_SESSION['todo_name'] = $user_sessions['username'];
                    if (isset($_SESSION['todo_name'])) {
                        header("location: index.php");
                    }
                }
            } else {
                $error = 'Invalid Credentials';
            }
        }
    }

?>