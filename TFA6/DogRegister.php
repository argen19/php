<?php
include "dbConnect.php";
 
$message = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $d_name   = $_POST['d_name'];
    $d_breed  = $_POST['d_breed'];
    $d_age    = $_POST['d_age'];
    $d_add    = $_POST['d_add'];
    $d_color  = $_POST['d_color'];
    $d_height = $_POST['d_height'];
    $d_weight = $_POST['d_weight'];
 
    $sql = "INSERT INTO dog_info (d_name, d_breed, d_age, d_add, d_color, d_height, d_weight)
            VALUES ('$d_name', '$d_breed', '$d_age', '$d_add', '$d_color', '$d_height', '$d_weight')";
 
    if (mysqli_query($conn, $sql)) {
        $message = "Dog information saved successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dog Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
    <div class="container">
        <h1>Dog Information</h1>
 
        <?php if ($message != "") { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>
 
        <form action="DogRegister.php" method="post">
 
            <label>Name</label>
            <input type="text" name="d_name" required>
 
            <label>Breed</label>
            <input type="text" name="d_breed" required>
 
            <label>Age</label>
            <input type="text" name="d_age" required>
 
            <label>Address</label>
            <input type="text" name="d_add" required>
 
            <label>Color</label>
            <input type="text" name="d_color" required>
 
            <label>Height (cm)</label>
            <input type="text" name="d_height" required>
 
            <label>Weight (kg)</label>
            <input type="text" name="d_weight" required>
 
            <button type="submit">Save</button>
 
        </form>
 
        <p class="link"><a href="DogView.php">View All Dog Records</a></p>
    </div>
 
</body>
</html>
<?php
mysqli_close($conn);
?>