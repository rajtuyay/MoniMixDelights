<?php session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} else {
    include "../Database/db.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../CSS/products.css">
    <link rel="stylesheet" href="../CSS/font.css">
    <link rel="icon" type="image/png" href="../IMG/logo-monimix.png">
</head>

<body>
    <?php include "header.php"?>
    <div id="description">
        <p id="h1">Our Products</p>
        <p id="p">From classic favorite to unique delights, Find the <br>perfect treat to satisfy your sweet cravings.</p>
    </div>
    <div id="categories">
        <div id="img-container">
            <?php
            $query = "SELECT * FROM tbl_categories";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $imgURL = '../IMG/Categories/' . $row['category_image'];
            ?>
                <div id="img">
                    <a id="img-direct" href="view-products.php?id=<?php echo $row['category_id']; ?>">
                        <div id="img-holder">
                            <img class="image" src="<?php echo $imgURL?>">
                            <div id="category-names">View More</div>
                        </div>
                    </a>
                    <p><?php echo $row['category_name'] ?></p>
                </div>
            <?php } ?>
        </div>
    </div>

    </div>
    <?php include "footer.php" ?>
</body>

</html>