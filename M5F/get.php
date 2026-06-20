<?php
$firstname  = isset($_GET['firstname'])  ? htmlspecialchars($_GET['firstname'])  : '';
$middlename = isset($_GET['middlename']) ? htmlspecialchars($_GET['middlename']) : '';
$lastname   = isset($_GET['lastname'])   ? htmlspecialchars($_GET['lastname'])   : '';
$dob        = isset($_GET['dob'])        ? htmlspecialchars($_GET['dob'])        : '';
$address    = isset($_GET['address'])    ? htmlspecialchars($_GET['address'])    : '';
$submitted  = isset($_GET['submit']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
<header class="site-header">
    <div class="logo">PSA5 Technical</div>
    <div class="logo-line"></div>
</header>
 
<nav class="top-nav">
    <a href="get.php" class="active">Personal Info – GET</a>
    <a href="post.php">Personal Info – POST</a>
    <a href="cookies.php">Name Cookies</a>
    <a href="favoriteColors.php">Favorite Colors</a>
</nav>
 
<div class="card">
    <h1 class="card-title">Personal Information</h1>
    <p class="card-subtitle">Fill in your details below and click Submit.</p>
 
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
 
        <div class="form-row">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname"
                       value="<?php echo $firstname; ?>" placeholder="Joseph">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname"
                       value="<?php echo $lastname; ?>" placeholder="Calleja">
            </div>
        </div>
 
        <div class="form-group">
            <label for="middlename">Middle Name</label>
            <input type="text" id="middlename" name="middlename"
                   value="<?php echo $middlename; ?>" placeholder="Santos">
        </div>
 
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>">
        </div>
 
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address"
                   value="<?php echo $address; ?>" placeholder="Manila, Philippines">
        </div>
 
        <button type="submit" name="submit" class="btn-submit">Submit</button>
    </form>
</div>
 
<?php if ($submitted): ?>
<div class="result-box">
    <h2 class="card-title">Submitted Details</h2>
 
    <div class="result-item">
        <span class="result-label">First Name</span>
        <span class="result-value"><?php echo $firstname !== '' ? $firstname : '<em>—</em>'; ?></span>
    </div>
    <div class="result-item">
        <span class="result-label">Middle Name</span>
        <span class="result-value"><?php echo $middlename !== '' ? $middlename : '<em>—</em>'; ?></span>
    </div>
    <div class="result-item">
        <span class="result-label">Last Name</span>
        <span class="result-value"><?php echo $lastname !== '' ? $lastname : '<em>—</em>'; ?></span>
    </div>
    <div class="result-item">
        <span class="result-label">Date of Birth</span>
        <span class="result-value"><?php echo $dob !== '' ? date('F j, Y', strtotime($dob)) : '<em>—</em>'; ?></span>
    </div>
    <div class="result-item">
        <span class="result-label">Address</span>
        <span class="result-value"><?php echo $address !== '' ? $address : '<em>—</em>'; ?></span>
    </div>
</div>
<?php endif; ?>
 
<footer class="page-footer">
    <span>Personal Information Form</span>
    <span>Method: GET</span>
</footer>
 
</body>
</html>
 