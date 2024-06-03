<?php
// Database connection parameters
$host = "localhost";
$username = " ";
$password = " ";
$database = "bbms";

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $bbms);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $feedback = $_POST["feedback"];

    // Prepare and execute an SQL query to insert feedback into the database
    $stmt = $mysqli->prepare("INSERT INTO feedback (name, email, feedback) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $feedback);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$mysqli->close();
?>