<?php
require_once '../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'login') {
    $userController = new UserController();
    $userController->login($_POST['username'], $_POST['password']);
} else {
    include '../views/users/login.php';
}

