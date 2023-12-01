<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GUVI";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST["email_id"];

// Select all records from the 'users' table
$sql = "SELECT * FROM users where email_id = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // User found, return user data as JSON
    $userData = $result->fetch_assoc();
    echo json_encode($userData);
} else {
    // User not found
    echo json_encode(array('error' => 'User not found'));
}

$conn->close();
?>
