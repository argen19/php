<?php
session_start();

// If a user is already logged in, they should not be able to open the login page
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}

// Static credentials used for checking the login
$staticUsername = "ecarce";
$staticPassword = "denzel29";

$message = "";
$messageType = "";

// Pre-fill the fields if a "remember me" cookie exists
$rememberedUsername = isset($_COOKIE['remember_username']) ? $_COOKIE['remember_username'] : "";
$rememberedPassword = isset($_COOKIE['remember_password']) ? $_COOKIE['remember_password'] : "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    // Save or remove the "remember me" cookies
    if ($remember) {
        setcookie("remember_username", $username, time() + (86400 * 30));
        setcookie("remember_password", $password, time() + (86400 * 30));
    } else {
        setcookie("remember_username", "", time() - 3600);
        setcookie("remember_password", "", time() - 3600);
    }

    if ($username == $staticUsername && $password == $staticPassword) {
        $_SESSION['username'] = $username;
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
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($rememberedUsername); ?>" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($rememberedPassword); ?>" required>

            <div class="checkbox-row">
                <input type="checkbox" id="remember" name="remember" <?php echo $rememberedUsername ? "checked" : ""; ?>>
                <label for="remember" class="checkbox-label">Remember Me</label>
            </div>

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