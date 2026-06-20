<?php
$action = isset($_POST['action']) ? $_POST['action'] : '';
 
if ($action === 'set') {
    $firstname  = isset($_POST['firstname'])  ? $_POST['firstname']  : '';
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
    $lastname   = isset($_POST['lastname'])   ? $_POST['lastname']   : '';
 
    setcookie('firstname',  $firstname,  time() + 10, '/');
    setcookie('middlename', $middlename, time() + 20, '/');
    setcookie('lastname',   $lastname,   time() + 30, '/');
 
    header('Location: ' . $_SERVER['PHP_SELF'] . '?set=1');
    exit();
}
 
if ($action === 'delete') {
    setcookie('firstname',  '', time() - 3600, '/');
    setcookie('middlename', '', time() - 3600, '/');
    setcookie('lastname',   '', time() - 3600, '/');
    header('Location: ' . $_SERVER['PHP_SELF'] . '?deleted=1');
    exit();
}
 
$c_firstname  = isset($_COOKIE['firstname'])  ? htmlspecialchars($_COOKIE['firstname'])  : null;
$c_middlename = isset($_COOKIE['middlename']) ? htmlspecialchars($_COOKIE['middlename']) : null;
$c_lastname   = isset($_COOKIE['lastname'])   ? htmlspecialchars($_COOKIE['lastname'])   : null;
 
$justSet     = isset($_GET['set']);
$justDeleted = isset($_GET['deleted']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Cookies</title>
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
    <a href="cookies.php" class="active">Name Cookies</a>
    <a href="favoriteColors.php">Favorite Colors</a>
</nav>
 
<div class="card">
    <h1 class="card-title">Name Cookies</h1>
    <p class="card-subtitle">Each name is saved as a cookie with a different expiry time.</p>
 
    <?php if ($justSet): ?>
    <div class="alert-banner alert-success">
        Cookies saved. First name expires in 10s &mdash; Middle name in 20s &mdash; Last name in 30s.
        <div id="countdown-box"></div>
    </div>
    <?php endif; ?>
 
    <?php if ($justDeleted): ?>
    <div class="alert-banner alert-info">All cookies have been cleared.</div>
    <?php endif; ?>
 
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="action" value="set">
 
        <div class="form-group">
            <label for="firstname">First Name <small style="font-weight:400; color:#b09070;">(10 seconds)</small></label>
            <input type="text" id="firstname" name="firstname"
                   value="<?php echo $c_firstname ?? ''; ?>" placeholder="Joseph">
        </div>
 
        <div class="form-group">
            <label for="middlename">Middle Name <small style="font-weight:400; color:#b09070;">(20 seconds)</small></label>
            <input type="text" id="middlename" name="middlename"
                   value="<?php echo $c_middlename ?? ''; ?>" placeholder="Santos">
        </div>
 
        <div class="form-group">
            <label for="lastname">Last Name <small style="font-weight:400; color:#b09070;">(30 seconds)</small></label>
            <input type="text" id="lastname" name="lastname"
                   value="<?php echo $c_lastname ?? ''; ?>" placeholder="Calleja">
        </div>
 
        <button type="submit" class="btn-submit">Save Cookies</button>
    </form>
 
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" style="margin-top: 10px;">
        <input type="hidden" name="action" value="delete">
        <button type="submit" class="btn-submit btn-delete">Clear All Cookies</button>
    </form>
</div>
 
<div class="result-box">
    <h2 class="card-title" style="font-size:1.15rem; margin-bottom:16px;">Cookie Status</h2>
 
    <?php
    $cookies = [
        'firstname'  => ['label' => 'First Name',  'expires' => '10s', 'value' => $c_firstname],
        'middlename' => ['label' => 'Middle Name',  'expires' => '20s', 'value' => $c_middlename],
        'lastname'   => ['label' => 'Last Name',    'expires' => '30s', 'value' => $c_lastname],
    ];
 
    foreach ($cookies as $key => $info):
        $isSet    = $info['value'] !== null;
        $rowClass = $isSet ? 'status-active' : 'status-expired';
        $tagHtml  = $isSet
            ? '<span class="tag-active">Active</span>'
            : '<span class="tag-expired">Expired</span>';
    ?>
    <div class="cookie-row <?php echo $rowClass; ?>">
        <span class="c-label"><?php echo $info['label']; ?> <?php echo $tagHtml; ?></span>
        <span class="c-value"><?php echo $isSet ? $info['value'] : '—'; ?></span>
        <span class="c-expires"><?php echo $isSet ? 'Expires in ' . $info['expires'] : 'Not set'; ?></span>
    </div>
    <?php endforeach; ?>
</div>
 
<footer class="page-footer">
    <span>Cookie Management</span>
    <span>setcookie()</span>
</footer>
 
<?php if ($justSet): ?>
<script>
var refreshTimes = [11000, 21000, 31000];
var countdownEl = document.getElementById('countdown-box');
var start = Date.now();
 
function updateCountdown() {
    var elapsed = Math.floor((Date.now() - start) / 1000);
    var next = refreshTimes.find(function(t) { return t / 1000 > elapsed; });
    if (next !== undefined) {
        var remaining = Math.ceil(next / 1000 - elapsed);
        countdownEl.textContent = 'Page refreshes in ' + remaining + 's...';
        setTimeout(updateCountdown, 500);
    } else {
        countdownEl.textContent = '';
    }
}
updateCountdown();
 
refreshTimes.forEach(function(delay) {
    setTimeout(function() { location.reload(); }, delay);
});
</script>
<?php endif; ?>
 
</body>
</html>