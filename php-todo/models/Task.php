<?php
require_once '../config/database.php';

class Task {
    private $conn;
    private $table_name = "tasks";

    public $id;
    public $user_id;
    public $title;
    public $description;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read($user_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id =:user_id ORDER BY created_at ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt;
    }
    public function create() {
        session_start();
        $this->user_id = $_SESSION['user_id'];
        $query = "INSERT INTO " . $this->table_name . " (user_id, title, description, created_at) VALUES (:user_id, :title, :description, :created_at)";
        $stmt = $this->conn->prepare($query);
        date_default_timezone_set('Asia/Jakarta');
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->created_at = date('Y-m-d H:i:s' );
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":created_at", $this->created_at);
        return $stmt->execute();
    }
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
    public function edit() {
        $query = "UPDATE " . $this->table_name . " SET title=:title, description=:description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        return $stmt->execute();
    }
    public function getTaskById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

