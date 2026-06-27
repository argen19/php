<?php
include "dbConnect.php";
 
$sql = "SELECT id, d_name, d_breed, d_age, d_add, d_color, d_height, d_weight FROM dog_info";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dog Records</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
    <div class="container wide">
        <h1>All Dog Records</h1>
 
        <div class="table-wrap">
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Breed</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Color</th>
                            <th>Height (cm)</th>
                            <th>Weight (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo $row["d_name"]; ?></td>
                                <td><?php echo $row["d_breed"]; ?></td>
                                <td><?php echo $row["d_age"]; ?></td>
                                <td><?php echo $row["d_add"]; ?></td>
                                <td><?php echo $row["d_color"]; ?></td>
                                <td><?php echo $row["d_height"]; ?></td>
                                <td><?php echo $row["d_weight"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p class="message">No records found.</p>
            <?php } ?>
 
            <p class="link"><a href="DogRegister.php">Add New Dog Record</a></p>
        </div>
    </div>
 
</body>
</html>
<?php
mysqli_close($conn);
?>
 