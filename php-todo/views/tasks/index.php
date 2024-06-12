<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Todo List</h1>
        <div class="text-right mb-3">
            <a href="create.php" class="btn btn-success">Create New Task</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <ul class="list-group">
            <?php foreach ($tasks as $task): ?>
                <li class="list-group-item">
                    <h2><?php echo htmlspecialchars($task['title']); ?></h2>
                    <p><?php echo htmlspecialchars($task['description']); ?></p>
                    <p><?php echo htmlspecialchars($task['created_at']); ?></p>
                    <div class="text-right">
                        <a href="edit.php?id=<?php echo htmlspecialchars($task['id']); ?>" class="btn btn-primary">Edit</a>
                        <a href="delete.php?id=<?php echo htmlspecialchars($task['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
