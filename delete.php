<?php
require_once 'functions.php';
require_once 'auth.php';
require_once 'database.php';

if (!isLoggedIn()) {
    redirect('../login.php');
}

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->execute([$task_id, $user_id]);
    $_SESSION['message'] = 'Task deleted successfully!';
}

redirect('dashboard.php');
?>