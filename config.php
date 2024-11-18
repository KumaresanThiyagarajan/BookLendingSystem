<?php
// Database credentials
$servername = "localhost"; // Usually 'localhost' for local server
$username = "root"; // The default MySQL username is 'root'
$password = ""; // The default password is empty for local XAMPP installation
$dbname = "book_lending_system"; // The database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
