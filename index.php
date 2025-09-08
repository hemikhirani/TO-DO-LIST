<?php
require_once 'functions.php';
?>

<?php include 'header.php'; ?>

<div class="hero">
    <div class="hero-content">
        <h1>Welcome to Todo App</h1>
        <p>Organize your tasks and boost your productivity</p>
        
        <?php if (!isLoggedIn()): ?>
            <div class="hero-buttons">
                <a href="register.php" class="btn btn-primary">Get Started</a>
                <a href="login.php" class="btn">Login</a>
            </div>
        <?php else: ?>
            <div class="hero-buttons">
                <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="features">
    <h2>Features</h2>
    <div class="feature-grid">
        <div class="feature">
            <h3>✓ User Authentication</h3>
            <p>Secure login and registration system</p>
        </div>
        <div class="feature">
            <h3>✓ Task Management</h3>
            <p>Create, edit, and delete tasks easily</p>
        </div>
        <div class="feature">
            <h3>✓ Mark Complete</h3>
            <p>Track your progress with completion status</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>