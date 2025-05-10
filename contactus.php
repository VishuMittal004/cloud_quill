<?php
// Database connection settings
$host = "localhost"; // Change to your database host
$username = "root";  // Change to your database username
$password = "";      // Change to your database password
$dbname = "user_registration"; // Change to your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate required fields
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO contactus (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: thankyoudonate.html");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "All fields are required!";
    }
}

// Close the connection
$conn->close();
?>