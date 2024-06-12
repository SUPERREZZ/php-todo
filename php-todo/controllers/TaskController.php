<?php
require_once '../models/Task.php';
class TaskController {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function index($user_id) {
        $task = new Task($this->db);
        $tasks = $task->read($user_id)->fetchAll(PDO::FETCH_ASSOC);
        include '../views/tasks/index.php';
    }
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = new Task($this->db);
            $task->user_id = $_POST['user_id'];
            $task->title = $_POST['title'];
            $task->description = $_POST['description'];
            $task->created_at = date('Y-m-d H:i:s');
            $task->create();
            header('Location: index.php');
        } else {
            include '../views/tasks/create.php';
        }
    }
    public function edit($id) {
        $task = new Task($this->db);
        $taskData = $task->getTaskById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task->id = $id;
            $task->title = $_POST['title'];
            $task->description = $_POST['description'];
            $task->edit();
            header('Location: index.php');
        } else {
            include '../views/tasks/edit.php';
        }
    }
    public function delete($id) {
        $task = new Task($this->db);
        $task->id = $id;
        $task->delete();
        header('Location: index.php');
    }
}

