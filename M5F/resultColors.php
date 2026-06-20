<?php
session_start();
 
if (!isset($_SESSION['color1'])) {
    header('Location: act3_FavoriteColor.php');
    exit();
}
 
$colors = [
    1 => isset($_SESSION['color1']) ? $_SESSION['color1'] : '',
    2 => isset($_SESSION['color2']) ? $_SESSION['color2'] : '',
    3 => isset($_SESSION['color3']) ? $_SESSION['color3'] : '',
    4 => isset($_SESSION['color4']) ? $_SESSION['color4'] : '',
    5 => isset($_SESSION['color5']) ? $_SESSION['color5'] : '',
];
 
if (isset($_GET['destroy'])) {
    session_unset();
    session_destroy();
    header('Location: favoriteColor.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favorite Colors</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
<header class="site-header">
    <div class="logo">PSA5 Technical</div>
    <div class="logo-line"></div>
</header>
 
<nav class="top-nav">
    <a href="get.php">Personal Info – GET</a>
    <a href="post.php">Personal Info – POST</a>
    <a href="cookies.php">Name Cookies</a>
    <a href="favoriteColors.php" class="active">Favorite Colors</a>
</nav>
 
<div class="result-box" style="max-width: 560px;">
    <h1 class="card-title" style="margin-bottom: 20px;">Your Favorite Colors</h1>
 
    <ul class="color-result-list">
        <?php foreach ($colors as $num => $colorVal):
            $safe = htmlspecialchars($colorVal);
        ?>
        <li>
            <span class="color-number"><?php echo $num; ?></span>
            <span class="big-swatch" style="background-color: <?php echo $safe; ?>;"></span>
            <span class="color-name-label" style="color: <?php echo $safe; ?>;">
                <?php echo $safe !== '' ? $safe : '<em style="color:#9e7b5e; font-weight:400;">Not set</em>'; ?>
            </span>
            <?php if ($safe !== ''): ?>
            <span class="color-hex-tag"><?php echo $safe; ?></span>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
 
    <p class="session-note">Stored in <code>$_SESSION</code> &mdash; available until the session ends.</p>
</div>
 
<div class="action-bar">
    <a href="act3_FavoriteColor.php" class="btn-secondary">Edit Colors</a>
    <a href="act3_ResultColors.php?destroy=1" class="btn-danger">End Session</a>
</div>
 
<footer class="page-footer" style="margin-top: 20px;">
    <span>Result Colors</span>
    <span>$_SESSION</span>
</footer>
 
</body>
</html>