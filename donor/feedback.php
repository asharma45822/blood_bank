<?php
// Create a database connection
$host = "localhost";
$username = "root";
$password = "";
$db = "bbms";
;$mysqli = new mysqli($host, $username, $password, $db);

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
        echo "<script type='text/javascript'>
          alert('feedback submit successfully');
          window.location.href = 'index.php';
      </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            margin-top: 50px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #ff0000;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color:#ff0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Feedback Form</h2>
        <form action="feedback.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Your name.." required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Your email.." required>

            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" placeholder="Your feedback.." style="height:200px" required></textarea>

            <input type="submit" value="Submit Feedback">
        </form>
    </div>
</body>
</html>