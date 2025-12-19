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
    <title>MoniMix Delights</title>
    <link rel="icon" type="image/png" href="../IMG/monimix-favicon.png">
    <link rel="stylesheet" href="../CSS/style.css" type="text/css">
    <link rel="stylesheet" href="../CSS/font.css">
</head>



<body>
    <!--------header start----------------->
    <?php include "header.php" ?>
    <!--------header end----------------->

    <!--------Homescroll1 start----------------->
    <div class="home1">
        <div class="home11">
            <h1>A Delight in Every Bite!</h1>
            <p>Discover a variety of freshly made treats that bring comfort and joy to every bite. From decadent cupcakes and cookies to classic Filipino desserts.</p>
            <br><a href="order-now.php">order now</a>
        </div>
    </div>

    <script>
        window.addEventListener('resize', () => {
            const paragraph = document.querySelector('.home11 p');
            if (window.innerWidth <= 486) {
                paragraph.textContent = "Indulge in freshly made treats, from cupcakes and cookies to classic Filipino desserts.";
            } else {
                paragraph.textContent = "Discover a variety of freshly made treats that bring comfort and joy to every bite. From decadent cupcakes and cookies to classic Filipino desserts.";
            }
        });

        // Run the check on page load as well
        document.addEventListener('DOMContentLoaded', () => {
            const paragraph = document.querySelector('.home11 p');
            if (window.innerWidth <= 486) {
                paragraph.textContent = "Indulge in freshly made treats, from cupcakes and cookies to classic Filipino desserts.";
            }
        });
    </script>
    
    <!--------Homescroll1 end----------------->

    <!--------Homescroll2 start----------------->
    <div class="home2">
        <div class="home21">
            <center><img src="../IMG/girl-baker.png"></center>
        </div>

        <div class="home22">
            <div class="home222">
                <h4>Deliciously <span class="spanhome22">Crafted</span> just for <span class="spanhome22">you</span></h4><br>
                <p> ✓ Homemade Freshness<br>
                    ✓ Wide Variety of Desserts<br>
                    ✓ Perfect for any occasion<br>
                    ✓ Fast & Reliable Delivery<br>
                </p> <br>
                <a href="about.php">See More</a>
            </div>
        </div>
    </div><!--home2 end-->
    <!--------Homescroll2 end----------------->


    <!--------Homescroll3 start----------------->
    <div class="home3">
        <div class="home31">
            <img src="../IMG/white-brush.png" alt="Image">
            <div class="text-overlay">
                <p>OUR PRODUCTS</p>
            </div>
        </div><!---home31-->


        <div class="home32">
            <div class="home321">
                <div class="slider">
                    <div class="image-container">
                        <img src="../IMG/Categories/filipino-desserts.jpg">
                        <div class="image-text">CLASSIC FILIPINO TREATS</div>
                    </div>
                    <div class="image-container">
                        <img src="../IMG/Categories/cupcakes&donuts.png">
                        <div class="image-text">CUPCAKES AND DONUTS</div>
                    </div>
                    <div class="image-container">
                        <img src="../IMG/Categories/coookies&brownies.jpg">
                        <div class="image-text">COOKIES AND BROWNIES</div>
                    </div>
                    <div class="image-container">
                        <img src="../IMG/Categories/cheesecake&delights.jpg">
                        <div class="image-text">CHEESECAKE AND DELIGHTS</div>
                    </div>
                </div>
            </div>
            <script src="../JS/image-slider.js"></script>
            <div class="home322">
                <br>
                <h4>Treat Yourself to Our Sweet Selection</h4><br>
                <p>From classic favorites to unique delights, find the perfect treat to satisfy your sweet cravings</p><br>
                <a href="products.php">view all</a>
            </div>
        </div>
    </div>
    <!--------Homescroll3 end----------------->

    <!--------Homescroll4 start----------------->
    <?php include "contact-us.php" ?>
    <!--------Homescroll4 end----------------->


    <!--------Homescroll5 start----------------->
    <?php include "footer.php" ?>
    <!--------Homescroll5 end----------------->
</body>

</html>