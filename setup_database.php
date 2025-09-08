<?php
$servername = "sql102.infinityfree.com";
$username = "if0_39805193";
$password = "hemik1234567890";
$dbname = "if0_39805193_todo_app";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Run SQL file
$sql = file_get_contents("todo_app.sql");
if ($conn->multi_query($sql)) {
    echo "Database and tables created successfully!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
