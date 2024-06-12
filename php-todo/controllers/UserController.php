<?php
require_once '../config/Database.php';
require_once '../models/User.php';

class UserController {
    private $db;

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    public function register($username, $password) {
        $user = new User($this->db);
        $user->username = $username;
        $user->password = password_hash($password, PASSWORD_DEFAULT);

        if ($user->create()) {
            header('Location: login.php');
            exit();
        } else {
            echo "Registration failed.";
        }
    }

    public function login($username, $password) {
        $user = new User($this->db);

        if ($user->authenticate($username, $password)) {
            session_start();
            $_SESSION['user_id'] = $user->id; 
            header('Location: index.php');
            exit();
        } else {
            header('Location: login.php');
        }
    }
}

