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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you're receiving data via POST
    $email_id = $_POST['email_id'];
    $password = $_POST['password'];

    // Fetch user data based on email_id
    $sql = "SELECT * FROM users WHERE email_id = '$email_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            // Password is correct, login successful
            echo "Success";
        } else {
            // Incorrect password
            echo "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        echo "User not found. Please check your email id.";
    }
}

$conn->close();
?>
