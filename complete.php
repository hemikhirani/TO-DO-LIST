<?php
require_once 'functions.php';
require_once 'auth.php';
require_once 'database.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

if (isset($_GET['id'])) {
    $task_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE tasks SET status = 'completed' WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Task marked as complete!";
}

redirect('dashboard.php');
?>
