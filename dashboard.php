<?php
require_once 'functions.php';
require_once 'auth.php';


if (!isLoggedIn()) {
    redirect('login.php');
}

require_once 'database.php';

// Get user's tasks
$result = $conn->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC");

$result->bind_param("i", $_SESSION['user_id']);
$result->execute();
$tasks = $result->get_result()->fetch_all(MYSQLI_ASSOC);
$result->close();

// Display success message if exists
if ($stmt->affected_rows > 0) {
    $_SESSION['message'] = "Task marked as complete!";
} else {
    $_SESSION['message'] = "⚠️ No task updated! Check if task belongs to you.";
}


?>

<?php include 'header.php'; ?>

<div class="dashboard">
    <h2>Your Todo List</h2>
   <?php if ($message): ?>
    <div class="alert alert-success">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

    
    <!-- Add Task Form -->
    <div class="add-task-form">
        <h3>Add New Task</h3>
        <form method="POST" action="add.php">
            <div class="form-group">
                <input type="text" name="title" placeholder="Task title" required>
            </div>
            <div class="form-group">
                <textarea name="description" placeholder="Task description"></textarea>
            </div>
            <button type="submit" class="btn">Add Task</button>
        </form>
    </div>
    
    <!-- Tasks List -->
    <div class="tasks-list">
        <h3>Your Tasks</h3>
        
        <?php if (empty($tasks)): ?>
            <p>No tasks yet. Add your first task above!</p>
        <?php else: ?>
            <?php foreach ($tasks as $task): ?>
                <div class="task-item <?php echo $task['status'] === 'completed' ? 'completed' : ''; ?>">
                    <h4><?php echo htmlspecialchars($task['title']); ?></h4>
                    <p><?php echo htmlspecialchars($task['description']); ?></p>
                    <div class="task-meta">
                        <small>Created: <?php echo date('M j, Y g:i A', strtotime($task['created_at'])); ?></small>
                        <?php if ($task['status'] === 'completed'): ?>
                            <span class="status-completed">✓ Completed</span>
                        <?php else: ?>
                            <span class="status-pending">⏳ Pending</span>
                        <?php endif; ?>
                    </div>
                   <div class="task-actions">
    <?php if ($task['status'] !== 'completed'): ?>
        <a href="complete.php?id=<?php echo $task['id']; ?>" class="btn btn-success">Complete</a>
    <?php endif; ?>
    <a href="edit.php?id=<?php echo $task['id']; ?>" class="btn btn-primary">Edit</a>
    <a href="delete.php?id=<?php echo $task['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
</div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
