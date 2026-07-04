<?php
session_start();
include "db.php";

if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}

$message = "";
$messageType = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id']  = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("Location: home.php");
        exit;
    } else {
        $message = "Invalid username or password";
        $messageType = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <form method="POST" action="login.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <?php if ($message != "") { ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <div class="link">
            Don't have an account? <a href="register.php">Register here</a>
        </div>

        <div class="footer">@ECARCE</div>
    </div>
</body>
</html>