<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="../CSS/product-details.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php
    include '../Database/db.php';

    if (isset($_GET['id']) && $_GET['id'] != "") { // Check if the product ID is passed via GET
        $id = $_GET['id']; // Get the product ID from the URL

        // Query to get product information
        $query = "SELECT tbl_categories.category_name, tbl_products.prod_image, tbl_products.prod_name, 
    tbl_products.prod_price, tbl_products.product_description 
    FROM tbl_products INNER JOIN tbl_categories on tbl_categories.category_id = tbl_products.category_id WHERE prod_id = $id";

        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            $imgURL = '../IMG/Products/' . $row['prod_image'];

            // Query to get the average rating and the total number of reviews with a valid rating (rating > 0)
            $ratingQuery = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews 
                            FROM tbl_reviews WHERE prod_id = $id AND rating > 0"; // Exclude reviews with 0 rating
            $ratingResult = mysqli_query($connection, $ratingQuery);
            $ratingRow = mysqli_fetch_assoc($ratingResult);
            $rating = $ratingRow['avg_rating'] ?? 0; // Default to 0 if no valid reviews exist
            $total_reviews = $ratingRow['total_reviews'] ?? 0; // Get the total number of valid reviews for the product

            // Query to get the total number of reviews (including reviews with 0 rating) for the "sold" count
            $soldQuery = "SELECT COUNT(review_id) AS total_sold FROM tbl_reviews WHERE prod_id = $id";
            $soldResult = mysqli_query($connection, $soldQuery);
            $soldRow = mysqli_fetch_assoc($soldResult);
            $total_sold = $soldRow['total_sold'] ?? 0; // Total reviews (including those with rating = 0)

            // Calculate full stars, fractional stars, and empty stars for the rating
            $full_stars = floor($rating); // Full stars (integer part)
            $decimal_part = $rating - $full_stars; // Fractional part (decimal)
            $total_stars = 5; // Always 5 stars to display
            $empty_stars = $total_stars - $full_stars - ($decimal_part > 0 ? 1 : 0); // Empty stars (remaining stars)
            include "header.php";
    ?>
            <!-------------------------------->

            <h1 id="cat-name"><?php echo $row['category_name']; ?></h1><!-- Product category -->
            <div class="outer">
                <br>
                <div class="inner">
                    <div class="left">
                        <a id="popup" href="#popup1">
                            <img class="proimage" src="<?php echo $imgURL ?>" height="100%" width="300">
                            <div id="overlay">
                                <p>See Photo</p>
                            </div>
                        </a><!-- Product image -->
                    </div><!--left-->
                    <!-- Popup -->
                    <div class="popup-image" id="popup1">
                        <span id="close-btn">&times;</span> <!-- Close button -->
                        <img class="proimage" src="<?php echo $imgURL ?>">
                    </div>
                    <!-- Popup End -->

                    <div class="right">
                        <div class="up">
                            <div class="uleft">
                                <h2><?php echo $row['prod_name']; ?></h2><!-- Product name -->
                                <!-- Display Rating and Reviews Count -->
                                <p><?php echo number_format($rating, 1); ?>/5 (<?php echo $total_reviews; ?> Reviews) Sold: <?php echo $total_sold; ?> </p><!-- Total number of reviews (including rating 0) -->
                                <!-- Rating Stars -->
                                <div class="star-rating">
                                    <?php for ($i = 0; $i < $full_stars; $i++): ?>
                                        <div class="star full"></div>
                                    <?php endfor; ?>
                                    <?php if ($decimal_part > 0): ?>
                                        <div class="star" style="background: linear-gradient(to right, gold <?php echo $decimal_part * 100; ?>%, #d3d3d3 <?php echo $decimal_part * 100; ?>%);"></div>
                                    <?php endif; ?>
                                    <?php for ($i = 0; $i < $empty_stars; $i++): ?>
                                        <div class="star"></div>
                                    <?php endfor; ?>
                                </div>
                                <!-- Rating Stars End -->
                            </div>

                            <div class="uright">
                                <h3>&#8369;<?php echo number_format($row['prod_price'], 2); ?></h3><!-- Price -->
                                <button id="orderButton">ORDER</button>
                            </div>
                        </div><!--up-->
                        <br>
                        <div class="bottom">
                            <p><?php echo $row['product_description']; ?></p><!-- Product description -->
                        </div><!--bottom-->
                    </div><!--right-->
                </div><!--inner-->
            </div><!--outer-->
            <!-------------------------------->
            <br><br><br>
            <center id="review-tag">Reviews:<span id="total-reviews">(3)</span></center>
            <div id="prod-review">
                <div id="review-card">
                    <img src="../IMG/Profile-Image/Lunox_DG.jpg" alt="User">
                    <div id="name-rating">
                        <p>Raj Tuyay</p>
                        <span class="rating"></span>
                        <span class="rating"></span>
                        <span class="rating"></span>
                        <span class="rating"></span>
                        <span class="rating"></span>
                    </div>
                    <p id="comment">Shuper mega ultra sherepsh ng lasa, omg pak na pak talaga! Di ko kinaya mga teh, as in parang nasa heaven aketch sa sobrang sherepsh to the max! Itich ang irerekomend ko sa lahat ng mga mars at teh, charotera, best desserts evahhh ng taon!</p>
                </div>

                <div id="review-card">
                    <img src="../IMG/Profile-Image/rainalyn.jpg" alt="User">
                    <div id="name-rating">
                        <p>Rainalyn Datu</p>
                        <span class="rating"></span>
                    </div>
                    <p id="comment">Di ko keri ang lasa, teh! Matamlay, charot, at parang kadiri everrr. Muntik na akong mashokot at matransform sa Maria Clara sa suka levels! Promise, di na talaga ako bibili ulit, ang waley ng peg, walang kabog!</p>
                </div>

                <div id="review-card">
                    <img src="../IMG/Profile-Image/shane.jpg" alt="User">
                    <div id="name-rating">
                        <p>Shane Balagtas</p>
                        <span class="rating"></span>
                        <span class="rating"></span>
                        <span class="rating"></span>
                    </div>
                    <p id="comment">Charotera mga ateng, saktohan lang teh, hindi pangit pero hindi rin nakakaloka sa sarap. Mas yummy pa akiz, charot! Pero sige na nga, try ko pa rin yung iba nilang ganaps, pero etong isa? Diko betchorlit.</p>
                </div>
            </div>
            <?php
        } else {
            echo "<p class='status-error'>Product not found...</p>";
        }
    } else {
        if (isset($_GET['search']) && $_GET['search'] != "") {
            $search = $_GET['search'];
            $query = "SELECT tbl_categories.category_name, tbl_products.prod_id, tbl_products.prod_image, tbl_products.prod_name, 
    tbl_products.prod_price, tbl_products.product_description 
    FROM tbl_products INNER JOIN tbl_categories on tbl_categories.category_id = tbl_products.category_id WHERE prod_name = '$search'";

            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_assoc($result);
                $id = $row['prod_id'];
                $imgURL = '../IMG/Products/' . $row['prod_image'];

                // Query to get the average rating and the total number of reviews with a valid rating (rating > 0)
                $ratingQuery = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews 
                    FROM tbl_reviews WHERE prod_id = $id AND rating > 0"; // Exclude reviews with 0 rating
                $ratingResult = mysqli_query($connection, $ratingQuery);
                $ratingRow = mysqli_fetch_assoc($ratingResult);
                $rating = $ratingRow['avg_rating'] ?? 0; // Default to 0 if no valid reviews exist
                $total_reviews = $ratingRow['total_reviews'] ?? 0; // Get the total number of valid reviews for the product

                // Query to get the total number of reviews (including reviews with 0 rating) for the "sold" count
                $soldQuery = "SELECT COUNT(review_id) AS total_sold FROM tbl_reviews WHERE prod_id = $id";
                $soldResult = mysqli_query($connection, $soldQuery);
                $soldRow = mysqli_fetch_assoc($soldResult);
                $total_sold = $soldRow['total_sold'] ?? 0; // Total reviews (including those with rating = 0)

                // Calculate full stars, fractional stars, and empty stars for the rating
                $full_stars = floor($rating); // Full stars (integer part)
                $decimal_part = $rating - $full_stars; // Fractional part (decimal)
                $total_stars = 5; // Always 5 stars to display
                $empty_stars = $total_stars - $full_stars - ($decimal_part > 0 ? 1 : 0); // Empty stars (remaining stars)
                include "header.php";
            ?>
                <!-------------------------------->

                <h1 id="cat-name"><?php echo $row['category_name']; ?></h1><!-- Product category -->
                <div class="outer">
                    <br>
                    <div class="inner">
                        <div class="left">
                            <a id="popup" href="#popup1">
                                <img class="proimage" src="<?php echo $imgURL ?>" height="100%" width="300">
                                <div id="overlay">
                                    <p>See Photo</p>
                                </div>
                            </a><!-- Product image -->
                        </div><!--left-->
                        <!-- Popup -->
                        <div class="popup-image" id="popup1">
                            <span id="close-btn">&times;</span> <!-- Close button -->
                            <img class="proimage" src="<?php echo $imgURL ?>">
                        </div>
                        <!-- Popup End -->

                        <div class="right">
                            <div class="up">
                                <div class="uleft">
                                    <h2><?php echo $row['prod_name']; ?></h2><!-- Product name -->
                                    <!-- Display Rating and Reviews Count -->
                                    <p><?php echo number_format($rating, 1); ?>/5 (<?php echo $total_reviews; ?> Reviews) Sold: <?php echo $total_sold; ?> </p><!-- Total number of reviews (including rating 0) -->
                                    <!-- Rating Stars -->
                                    <div class="star-rating">
                                        <?php for ($i = 0; $i < $full_stars; $i++): ?>
                                            <div class="star full"></div>
                                        <?php endfor; ?>
                                        <?php if ($decimal_part > 0): ?>
                                            <div class="star" style="background: linear-gradient(to right, gold <?php echo $decimal_part * 100; ?>%, #d3d3d3 <?php echo $decimal_part * 100; ?>%);"></div>
                                        <?php endif; ?>
                                        <?php for ($i = 0; $i < $empty_stars; $i++): ?>
                                            <div class="star"></div>
                                        <?php endfor; ?>
                                    </div>
                                    <!-- Rating Stars End -->
                                </div>

                                <div class="uright">
                                    <h3>&#8369;<?php echo number_format($row['prod_price'], 2); ?></h3><!-- Price -->
                                    <button>BUY</button>
                                </div>
                            </div><!--up-->
                            <br>
                            <div class="bottom">
                                <p><?php echo $row['product_description']; ?></p><!-- Product description -->
                            </div><!--bottom-->
                        </div><!--right-->
                    </div><!--inner-->
                </div><!--outer-->
                <!-------------------------------->
                <br><br><br>
                <center id="review-tag">Reviews:<span id="total-reviews">(3)</span></center>
                <div id="prod-review">
                    <div id="review-card">
                        <img src="../IMG/Profile-Image/Lunox_DG.jpg" alt="User">
                        <div id="name-rating">
                            <p>Raj Tuyay</p>
                            <span class="rating"></span>
                            <span class="rating"></span>
                            <span class="rating"></span>
                            <span class="rating"></span>
                            <span class="rating"></span>
                        </div>
                        <p id="comment">Shuper mega ultra sherepsh ng lasa, omg pak na pak talaga! Di ko kinaya mga teh, as in parang nasa heaven aketch sa sobrang sherepsh to the max! Itich ang irerekomend ko sa lahat ng mga mars at teh, charotera, best desserts evahhh ng taon!</p>
                    </div>

                    <div id="review-card">
                        <img src="../IMG/Profile-Image/rainalyn.jpg" alt="User">
                        <div id="name-rating">
                            <p>Rainalyn Datu</p>
                            <span class="rating"></span>
                        </div>
                        <p id="comment">Di ko keri ang lasa, teh! Matamlay, charot, at parang kadiri everrr. Muntik na akong mashokot at matransform sa Maria Clara sa suka levels! Promise, di na talaga ako bibili ulit, ang waley ng peg, walang kabog!</p>
                    </div>

                    <div id="review-card">
                        <img src="../IMG/Profile-Image/shane.jpg" alt="User">
                        <div id="name-rating">
                            <p>Shane Balagtas</p>
                            <span class="rating"></span>
                            <span class="rating"></span>
                            <span class="rating"></span>
                        </div>
                        <p id="comment">Charotera mga ateng, saktohan lang teh, hindi pangit pero hindi rin nakakaloka sa sarap. Mas yummy pa akiz, charot! Pero sige na nga, try ko pa rin yung iba nilang ganaps, pero etong isa? Diko betchorlit.</p>
                    </div>
                </div>
    <?php
                header("Refresh: 0");
            } else {
                echo "<p class='status-error'>Product not found...</p>";
            }
        }
    }
    ?>

    <script>
        const closeBtn = document.getElementById('close-btn');
        const popup = document.getElementById('popup');
        const popupImage = document.querySelector('.popup-image');

        popup.addEventListener('click', function() {
            popupImage.style.display = 'block';
        });

        popupImage.addEventListener('click', function() {
            popupImage.style.display = 'none';
        });

        closeBtn.addEventListener('click', function() {
            popupImage.style.display = 'none';
        });

        function goToOrder() {
            window.location.href = "order-now.php"; // Redirects to the order-now.php page
        }

        // Bind the function to a button click event (example)
        document.getElementById("orderButton").addEventListener("click", goToOrder);
    </script>

</body>

</html>