<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GUVI";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);


// Assuming you're receiving data via POST
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$phone_number = $_POST['phone_number'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$country = $_POST['country'];


// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);



    $userEmail=$_POST["email"];
    $sql = "UPDATE users SET
            first_name = '$first_name',
            middle_name = '$middle_name',
            last_name = '$last_name',
            phone_number = '$phone_number',
            gender = '$gender',
            dob = '$dob',
            country = '$country'
            WHERE email_id = '$userEmail'";

    
if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
