<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "bookstore"; // Replace with your actual database name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_name'])) {
    $bookName = $conn->real_escape_string($_POST['book_name']);

    // Validate input
    if (!empty($bookName)) {
        // Use a prepared statement to avoid SQL injection
        $sql = "SELECT * FROM books WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $bookName); // 's' indicates that bookName is a string
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Book found, redirect to 1984.html
            header("Location: 1984.html");
            exit(); // Ensure no further code is executed
        } else {
            // Book not found, redirect to 1984.html
            header("Location: 1984.html");
            exit();
        }
    } else {
        echo "Please fill in the book name.";
    }
}

$conn->close();
?>
