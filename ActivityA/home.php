<?php
session_start();

// If there is no active session, the user cannot open this page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Home Page</h1>

        <div class="content">
            <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! You are logged in.</p>
        </div>

        <div class="link">
            <a href="logout.php">Logout</a>
        </div>

        <div class="footer">@ECARCE</div>
    </div>
</body>
</html>