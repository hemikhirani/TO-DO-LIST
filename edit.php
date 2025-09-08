<?php
require_once 'functions.php';
require_once 'auth.php';
require_once 'database.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = intval($_POST['task_id']);
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssii", $title, $description, $task_id, $user_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = 'Task updated successfully!';
    redirect('dashboard.php');
}

// Get task for editing
if (isset($_GET['id'])) {
    $task_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();
    $stmt->close();
    
    if (!$task) {
        redirect('dashboard.php');
    }
}
?>

<?php include 'header.php'; ?>

<div class="auth-container">
    <div class="auth-form">
        <h2>Edit Task</h2>
        
        <form method="POST" action="">
            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
            
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($task['title'] ?? '', ENT_QUOTES); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description"><?php echo htmlspecialchars($task['description'] ?? '', ENT_QUOTES); ?></textarea>
            </div>
            
            <button type="submit" class="btn">Update Task</button>
            <a href="dashboard.php" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
