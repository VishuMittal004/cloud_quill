<?php
// Database connection settings
$host = "localhost"; // Change to your database host
$username = "root";  // Change to your database username
$password = "";      // Change to your database password
$dbname = "user_registration"; // Change to your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validate email and password
    if (!empty($email) && !empty($password)) {
        // Query to check if the user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists - Verify password
            $user = $result->fetch_assoc();
            
                header("Location: full_out.html");
                exit();
                echo "Incorrect password.";
        } else {
            // User does not exist - Redirect to sign-up page
            header("Location: signup.php");
            exit();
        }
        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}
$conn->close();
?>