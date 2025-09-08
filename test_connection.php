<?php
require_once 'config/database.php';

try {
    $stmt = $pdo->query("SELECT 1");
    echo "<h2>Database Connection Successful! ✓</h2>";
    
    $tables = $pdo->query("SHOW TABLES")->fetchAll();
    echo "<p>Tables found: " . count($tables) . "</p>";
    
    if (count($tables) > 0) {
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>" . $table[0] . "</li>";
        }
        echo "</ul>";
    }
    
} catch (PDOException $e) {
    echo "<h2>Connection Failed: ✗</h2>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<p>Please run <a href='setup_database.php'>setup_database.php</a> first.</p>";
}
?>