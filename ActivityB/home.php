<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$message = "";
$messageType = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword     = $_POST['new_password'];
    $reenterPassword = $_POST['reenter_password'];

    $query = "SELECT password FROM users WHERE id = '$userId'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($currentPassword !== $row['password']) {
        $message = "Current password is not the same with the old password";
        $messageType = "error";
    } elseif ($newPassword !== $reenterPassword) {
        $message = "New password and Re-Enter new password should be the same.";
        $messageType = "error";
    } else {
        $updateQuery = "UPDATE users SET password = '$newPassword' WHERE id = '$userId'";
        if (mysqli_query($conn, $updateQuery)) {
            $message = "Password successfully changed!";
            $messageType = "success";
        } else {
            $message = "Something went wrong. Please try again.";
            $messageType = "error";
        }
    }
}

$query = "SELECT * FROM users WHERE id = '$userId'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$fullName = trim($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']);
$birthdayDisplay = $user['birthday'] ? date("F j Y", strtotime($user['birthday'])) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Information Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>
            User Information Form
            <span class="logout-link"><a href="logout.php">Log-out</a></span>
        </h1>

        <div class="content">
            <p><strong>Welcome</strong> <?php echo htmlspecialchars($fullName); ?></p>
            <p><strong>Birthday:</strong> <?php echo htmlspecialchars($birthdayDisplay); ?></p>
            <p><strong>Contact Details</strong></p>
            <p class="indent">Email: <?php echo htmlspecialchars($user['email']); ?></p>
            <p class="indent">Contact: <?php echo htmlspecialchars($user['contact_number']); ?></p>

            <hr>

            <p class="section-label">RESET PASSWORD</p>

            <form method="POST" action="home.php">
                <label for="current_password">Enter Current Password</label>
                <input type="password" id="current_password" name="current_password" required>

                <label for="new_password">Enter New Password</label>
                <input type="password" id="new_password" name="new_password" required>

                <label for="reenter_password">Re-Enter New Password</label>
                <input type="password" id="reenter_password" name="reenter_password" required>

                <button type="submit">Reset Password</button>
            </form>

            <?php if ($message != "") { ?>
                <div class="message <?php echo $messageType; ?>">
                    <?php echo $message; ?>
                </div>
            <?php } ?>
        </div>

        <div class="footer">@ECARCE</div>
    </div>
</body>
</html>