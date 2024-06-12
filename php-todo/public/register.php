<?php
require_once '../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'register') {
    $userController = new UserController();
    $userController->register($_POST['username'], $_POST['password']);
} else {
    include '../views/users/register.php';
}
