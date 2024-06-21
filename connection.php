<?php
$servername = "localhost";  // Server name or IP
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "olp";   // Name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
    echo '<script>';
    echo 'alert("Connection failed: ' . $conn->connect_error . '");';
    echo 'window.location.href = "index.html";'; // Redirect to your form page
    echo '</script>';
}
?>