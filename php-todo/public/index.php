<?php
require_once '../controllers/TaskController.php';

session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('Location: login.php');
    exit();
}
$controller = new TaskController();
$controller->index($user_id);
