<?php session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} else {
    include '../Database/db.php';
}

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
} else {
    echo "Category ID is missing.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../CSS/view-products.css">
    <link rel="stylesheet" href="../CSS/font.css">
    <link rel="icon" type="image/png" href="../IMG/logo-monimix.png">
</head>

<body>
    <?php include "header.php" ?>
    <div id="description">
        <p id="h1">Our Products</p>
        <p id="p">From classic favorite to unique delights, Find the <br>perfect treat to satisfy your sweet cravings.</p>
    </div>
    <div id="categories">
        <div id="img-container">
            <?php
            $query = "SELECT tbl_categories.category_name, tbl_products.prod_image, tbl_products.prod_name, 
            tbl_products.stock_quantity, tbl_products.prod_price, 
            tbl_products.product_description, tbl_products.prod_id
            FROM tbl_products 
            INNER JOIN tbl_categories 
            ON tbl_categories.category_id = tbl_products.category_id 
            WHERE tbl_products.category_id = $category_id";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Fetch average rating, total reviews, and total sold for each product
                    $prod_id = $row['prod_id'];
                    $imgURL = '../IMG/Products/' . $row['prod_image'];

                    // Get the average rating and total reviews
                    $ratingQuery = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews 
                                    FROM tbl_reviews WHERE prod_id = $prod_id AND rating > 0"; // Exclude 0 rating reviews
                    $ratingResult = mysqli_query($connection, $ratingQuery);
                    $ratingRow = mysqli_fetch_assoc($ratingResult);
                    $rating = $ratingRow['avg_rating'] ?? 0;
                    $total_reviews = $ratingRow['total_reviews'] ?? 0;

                    // Get the total number of reviews (including those with rating 0) for the sold count
                    $soldQuery = "SELECT COUNT(review_id) AS total_sold FROM tbl_reviews WHERE prod_id = $prod_id";
                    $soldResult = mysqli_query($connection, $soldQuery);
                    $soldRow = mysqli_fetch_assoc($soldResult);
                    $total_sold = $soldRow['total_sold'] ?? 0;

                    // Calculate the percentage of the star to be filled based on the rating
                    $star_class = "filled"; // Full star
            ?>
                    <div id="img">
                        <a id="img-tag" href="product-details.php?id=<?php echo $row['prod_id']; ?> ">
                            <div id="img-holder">
                                <img src="<?php echo $imgURL ?>" alt="<?php echo $row['prod_name']; ?>">
                                <div id="category-names">View Product</div>
                            </div>
                        </a>

                        <div id="details">
                            <p id="name"><?php echo $row['prod_name'] ?></p>
                            <p id="price"><?php echo "₱{$row['prod_price']}.00" ?></p>
                            <div class="star-rating">
                                <?php if ($total_reviews > 0) { ?>

                                    <span class="star <?php echo $star_class; ?>"></span> <!-- Dynamically change class based on rating -->

                                <?php } else { ?>
                                    <span style="background-color:#d3d3d3" class="star <?php echo $star_class; ?>"></span>
                                <?php } ?>

                                <?php
                                if ($total_reviews > 0) { ?>
                                    <p style="margin: 0; font-size: 14px;padding-top: 3px;"><?php echo number_format($rating, 1); ?> | (<?php echo $total_reviews; ?>) | <?php echo $total_sold; ?> sold</p>
                                <?php
                                } else { ?>
                                    <p style="margin: 0; font-size: 14px;padding-top: 3px;"><?php echo "No reviews | " . $total_sold . " sold"; ?></p><?php
                                                                                                                                                    }
                                                                                                                                                        ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p style='text-align: center; width: 100%;'>No products found in this category.</p>";
            }
            ?>
        </div>


    </div>
    <?php include "footer.php" ?>
</body>

</html>