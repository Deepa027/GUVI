<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GUVI";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sqlCreateDB) === FALSE) {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Connect to the created database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection to the database
if ($conn->connect_error) {
    die("Connection to the database failed: " . $conn->connect_error);
}

// Select the created database
$conn->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    middle_name VARCHAR(255),
    last_name VARCHAR(255),
    email_id VARCHAR(100) NOT NULL UNIQUE,
    phone_number BIGINT NOT NULL UNIQUE,
    gender VARCHAR(10),
    dob DATE,
    country VARCHAR(50),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Assuming you're receiving data via POST
$phone_number = $_POST['phone_number'];

// Hash the password before storing it
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if the update parameter is set
$isUpdate = isset($_POST['update']) && $_POST['update'] === 'true';

$email_id = $_POST['email_id'];
$sql = "INSERT INTO users (email_id, phone_number, password)
        VALUES ('$email_id', '$phone_number', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
