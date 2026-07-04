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
    $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middleName = mysqli_real_escape_string($conn, $_POST['middle_name']);
    $lastName  = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $birthday  = mysqli_real_escape_string($conn, $_POST['birthday']);
    $username  = mysqli_real_escape_string($conn, $_POST['username']);
    $password  = $_POST['password'];
    $confirm   = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $message = "Password and Confirm Password are not the same";
        $messageType = "error";
    } else {
        $checkQuery = "SELECT id FROM users WHERE username = '$username'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $message = "Username already exists. Please choose another one.";
            $messageType = "error";
        } else {
            $insertQuery = "INSERT INTO users (first_name, middle_name, last_name, email, contact_number, birthday, username, password)
                             VALUES ('$firstName', '$middleName', '$lastName', '$email', '$contactNumber', '$birthday', '$username', '$password')";

            if (mysqli_query($conn, $insertQuery)) {
                $message = "Registration successful! You may now login.";
                $messageType = "success";
            } else {
                $message = "Something went wrong. Please try again.";
                $messageType = "error";
            }
        }
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

        <?php if ($message != "") { ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <div class="link">
            Already have an account? <a href="login.php">Login here</a>
        </div>

        <div class="footer">@ECARCE</div>
    </div>
</body>
</html>