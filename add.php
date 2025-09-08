<?php
require_once 'functions.php';
require_once 'auth.php';
require_once 'database.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
    
    if (!empty($title)) {
        $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $title, $description]);
        $_SESSION['message'] = 'Task added successfully!';
    }
}

redirect('dashboard.php');
?>