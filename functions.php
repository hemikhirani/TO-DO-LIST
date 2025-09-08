<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Keep only this one
function redirect($url) {
    header("Location: $url");
    exit;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function getUserId() {
    return $_SESSION['user_id'] ?? null;
}
?>
