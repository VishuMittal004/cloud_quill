<?php
// Start the session
session_start();

// Check if the user is logged in (by verifying session data)
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the sign-in page
    header("Location: http://localhost/dwb_project/signin.php");
    exit();
}

// If logged in, display the home page content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="overlay">
        <div class="container">
            <h1>Welcome to the Home Page</h1>
            <p>Welcome back, <?php echo htmlspecialchars($_SESSION['email']); ?>!</p>
            <a href="logout.php" class="home-button">Log Out</a>
        </div>
    </div>
</body>
</html>
