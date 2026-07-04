<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}

$showResult = false;
$errorMessage = "";

$fullName = "";
$username = "";
$password = "";
$birthday = "";
$email = "";
$contact = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName  = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName   = $_POST['last_name'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $confirm    = $_POST['confirm_password'];
    $birthday   = $_POST['birthday'];
    $email      = $_POST['email'];
    $contact    = $_POST['contact_number'];

    if ($password !== $confirm) {
        $errorMessage = "Password and Confirm Password are not the same";
    } else {
        $fullName = trim($firstName . " " . $middleName . " " . $lastName);
        $showResult = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>My Personal Information</h1>

        <form method="POST" action="register.php">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="middle_name">Middle Name</label>
            <input type="text" id="middle_name" name="middle_name">

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <label for="birthday">Birthday</label>
            <input type="date" id="birthday" name="birthday" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="contact_number">Contact Number</label>
            <input type="text" id="contact_number" name="contact_number" required>

            <button type="submit">Register</button>
        </form>

        <?php if ($errorMessage != "") { ?>
            <div class="message error">
                <?php echo $errorMessage; ?>
            </div>
        <?php } ?>

        <?php if ($showResult) { ?>
            <div class="message success">
                Full Name: <?php echo htmlspecialchars($fullName); ?><br>
                Username: <?php echo htmlspecialchars($username); ?><br>
                Password: <?php echo htmlspecialchars($password); ?><br>
                Birthday: <?php echo $birthday ? date("F j Y", strtotime($birthday)) : ""; ?><br>
                Email: <?php echo htmlspecialchars($email); ?><br>
                Contact Number: <?php echo htmlspecialchars($contact); ?>
            </div>
        <?php } ?>

        <div class="link">
            Already have an account? <a href="login.php">Login here</a>
        </div>

        <div class="footer">@ECARCE</div>
    </div>
</body>
</html>