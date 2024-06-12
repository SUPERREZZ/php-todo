<?php
require_once '../controllers/TaskController.php';

$controller = new TaskController();
if (isset($_GET['id'])) {
    $controller->edit($_GET['id']);
}

