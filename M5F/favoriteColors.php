<?php
session_start();
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_colors'])) {
    $_SESSION['color1'] = isset($_POST['color1']) ? trim($_POST['color1']) : '';
    $_SESSION['color2'] = isset($_POST['color2']) ? trim($_POST['color2']) : '';
    $_SESSION['color3'] = isset($_POST['color3']) ? trim($_POST['color3']) : '';
    $_SESSION['color4'] = isset($_POST['color4']) ? trim($_POST['color4']) : '';
    $_SESSION['color5'] = isset($_POST['color5']) ? trim($_POST['color5']) : '';
 
    header('Location: resultColors.php');
    exit();
}
 
$vals = [
    isset($_SESSION['color1']) ? $_SESSION['color1'] : '',
    isset($_SESSION['color2']) ? $_SESSION['color2'] : '',
    isset($_SESSION['color3']) ? $_SESSION['color3'] : '',
    isset($_SESSION['color4']) ? $_SESSION['color4'] : '',
    isset($_SESSION['color5']) ? $_SESSION['color5'] : '',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Colors</title>
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
 
<div class="card" style="max-width: 560px;">
    <h1 class="card-title">Favorite Colors</h1>
    <p class="card-subtitle hint">Enter a color name (e.g. red, coral) or a hex code (e.g. #ff6347). Use the picker for precision.</p>
 
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
 
        <?php
        $labels = ['Color 1', 'Color 2', 'Color 3', 'Color 4', 'Color 5'];
        $names  = ['color1', 'color2', 'color3', 'color4', 'color5'];
 
        for ($i = 0; $i < 5; $i++):
            $val = htmlspecialchars($vals[$i]);
        ?>
        <div class="color-input-row">
            <label for="<?php echo $names[$i]; ?>"><?php echo $labels[$i]; ?></label>
            <input type="text"
                   id="<?php echo $names[$i]; ?>"
                   name="<?php echo $names[$i]; ?>"
                   value="<?php echo $val; ?>"
                   placeholder="e.g. red or #ff0000"
                   oninput="syncPicker(this, 'picker<?php echo $i+1; ?>', 'swatch<?php echo $i+1; ?>')">
            <input type="color"
                   id="picker<?php echo $i+1; ?>"
                   value="<?php echo $val !== '' ? $val : '#8b5c3a'; ?>"
                   oninput="syncText(this, '<?php echo $names[$i]; ?>', 'swatch<?php echo $i+1; ?>')"
                   title="Pick a color">
            <div class="preview-swatch"
                 id="swatch<?php echo $i+1; ?>"
                 style="background-color: <?php echo $val !== '' ? $val : 'transparent'; ?>;"></div>
        </div>
        <?php endfor; ?>
 
        <button type="submit" name="send_colors" class="btn-submit">Save Colors</button>
    </form>
</div>
 
<footer class="page-footer">
    <span>Favorite Colors</span>
    <span>$_SESSION</span>
</footer>
 
<script>
function syncPicker(textInput, pickerId, swatchId) {
    var val = textInput.value.trim();
    document.getElementById(swatchId).style.backgroundColor = val !== '' ? val : 'transparent';
    if (/^#[0-9a-fA-F]{6}$/.test(val)) {
        document.getElementById(pickerId).value = val;
    }
}
 
function syncText(pickerInput, textId, swatchId) {
    var hex = pickerInput.value;
    document.getElementById(textId).value = hex;
    document.getElementById(swatchId).style.backgroundColor = hex;
}
 
window.addEventListener('DOMContentLoaded', function() {
    var names   = ['color1','color2','color3','color4','color5'];
    var swatches = ['swatch1','swatch2','swatch3','swatch4','swatch5'];
    for (var i = 0; i < 5; i++) {
        var txt = document.getElementById(names[i]);
        var sw  = document.getElementById(swatches[i]);
        if (txt && txt.value.trim() !== '') {
            sw.style.backgroundColor = txt.value.trim();
        }
    }
});
</script>
 
</body>
</html>