<?php session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../CSS/about.css">
    <link rel="stylesheet" href="../CSS/font.css">
</head>

<body>
    <?php include "header.php" ?>
    <div class="container">
        <div id="description">
            <p id="h1">About Us</p>
            <p id="p">Welcome to MoniMix Delights, where every bite is a celebration of flavor and joy! We specialize in crafting homemade sweets inspired by cherished Filipino traditions and global dessert favorites. From our rich leche flan to delectable cheesecakes, cupcakes, cookies, and brownies, we bring love and passion to every treat we bake.
                <br><br>
                Founded with the goal of spreading happiness through delightful desserts, we take pride in using only the finest ingredients to ensure every creation is as memorable as it is delicious. Whether you're craving classic Filipino kakanin or indulging in our premium cheesecakes and tarts, our menu promises to satisfy your sweet tooth.
                <br><br>
                <b>MoniMix Delights: <span style="font-weight: 600; font-style: italic;">A Delight in Every Bite!</span></b>
            </p>
        </div>
        <div id="image">
            <center><img src="../IMG/girl-baker-centered.png"></center>
        </div>
    </div>
    <?php include "contact-us.php"?>
    <?php include "footer.php" ?>
</body>

</html>