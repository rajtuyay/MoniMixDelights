<?php session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} else {
    include '../Database/db.php';
}

function truncateDescription($description, $wordLimit = 10)
{
    $words = explode(' ', $description);
    if (count($words) > $wordLimit) {
        return implode(' ', array_slice($words, 0, $wordLimit)) . '...';
    }
    return $description;
}

//default active slider
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now</title>
    <link rel="stylesheet" href="../CSS/order-now.css" type="text/css">
</head>


<body>
    <div class="first">
        <!-- Image and exit button -->
        <div class="show-picture">
            <?php
            $query1 = "SELECT * FROM tbl_categories WHERE category_id = $category_id";
            $result1 = mysqli_query($connection, $query1);

            if ($result1 && mysqli_num_rows($result1) > 0) {
                $row = mysqli_fetch_assoc($result1);
                $imgURL = '../IMG/Categories/' . $row['category_image'];
            ?>
                <img id="category-image" src="<?php echo $imgURL ?>" alt="Category Image">
            <?php } else { ?>
                <img id="category-image" src="../IMG/Categories/default.jpg" alt="Default Image">
            <?php } ?>

            <a href="index.php">
                <img src="../IMG/icon-back.png" alt="Left Arrow">
            </a>
        </div>

        <!-- Capsule container with two buttons -->
        <div class="DeliPickup">
            <button id="delivery-btn">Delivery</button>
            <button id="pickup-btn">Pick Up</button>
        </div>

        <!-- Search bar and slider -->
        <div class="searching">
            <button id="search-btn"><img src="../IMG/search-icon.png" alt=""></button>
            <input type="search" id="search-input" placeholder="Search..." style="display:none;">
            <button id="exit-btn" style="display:none;">&#10006;</button>

            <!-- Category slider -->
            <!-- Category slider -->
            <div id="categslider" class="categslider">
                <?php
                $query = "SELECT * FROM tbl_categories";
                $result = mysqli_query($connection, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $imgURL = '../IMG/Categories/' . $row['category_image']; // Get the image URL
                ?>
                        <a class="category-link" data-category-id="<?php echo $row['category_id']; ?>" data-image-url="<?php echo $imgURL; ?>">
                            <?php echo $row['category_name']; ?>
                        </a>
                <?php
                    }
                } else {
                    echo '<p>No categories found.</p>';
                }
                ?>
            </div>
        </div>
        <!-- End of Search bar and slider -->


        <!-- Product display section -->
        <div id="prod-show" class="prod-show">
            <div class="prod-contain">
                <?php
                $querylist = "SELECT tbl_products.prod_name, tbl_products.prod_price, tbl_products.prod_image, tbl_products.prod_id, tbl_products.category_id, tbl_products.product_description, tbl_categories.category_name
                      FROM tbl_products JOIN tbl_categories ON tbl_products.category_id = tbl_categories.category_id";
                $result2 = mysqli_query($connection, $querylist);

                if ($result2 && mysqli_num_rows($result2) > 0) {
                    $previousCategoryId = null; // Variable to track the previous category

                    // Loop through the products
                    while ($row = mysqli_fetch_assoc($result2)) {
                        // Check if the category has changed (or if it's the first product)
                        if ($row['category_id'] != $previousCategoryId) {
                            // Display the category title at the top of prod-contain
                            if ($previousCategoryId !== null) {
                                echo "</div>"; // Close the previous category section
                            }
                            echo "<h3>" . $row['category_name'] . "</h3>"; // Display category name
                            echo "<div class='category-products' data-category-id='" . $row['category_id'] . "'>";
                            $previousCategoryId = $row['category_id']; // Update the previous category to the current one
                        }
                ?>
                        <div class="prod-list">
                            <input type="hidden" class="prod-id" value="<?php echo $row['prod_id']; ?>">
                            <div class="prod-descrip">
                                <h5 class="prod-name"><?php echo $row['prod_name']; ?></h5>
                                <p class="prod-description"><?php echo truncateDescription($row['product_description']); ?></p>
                                <!-- Second description for full view, hidden initially -->
                                <p class="prod-description2" style="display:none;"><?php echo $row['product_description']; ?></p>
                                <h2 class="prod-price">&#8369;<?php echo number_format($row['prod_price'], 2); ?></h2>
                            </div>
                            <div class="prod-image">
                                <img src="../IMG/Products/<?php echo $row['prod_image']; ?>" alt="<?php echo $row['prod_name']; ?>">
                            </div>
                        </div>
                <?php
                    }
                    echo "</div>"; // Close the last category section
                } else {
                    echo "<p>No products found.</p>";
                }
                ?>
            </div>
        </div>


        <!-- SECOND -->
        <?php include 'order-now-second.php'; ?>
        <!-- SECOND -->

        <!-- form -->
        <?php include 'order-now-form.php' ?>
        <!-- form -->


        <!------------------------------->
        <!------------------------------->
        <!------------------------------->
        <script>
            // Para sa form mag papasa  ng value    
            // Show the overlay form when a product is clicked
            const prodListItems = document.querySelectorAll('.prod-list');

            prodListItems.forEach(item => {
                item.addEventListener("click", function() {
                    const overlay = document.getElementById("overlay");
                    const prodId = item.querySelector(".prod-id").value;
                    const prodName = item.querySelector(".prod-name").textContent;
                    const prodPrice = item.querySelector(".prod-price").textContent;
                    const prodImage = item.querySelector(".prod-image img").src;

                    const prodDesc = item.querySelector(".prod-description2").textContent;
                    // Set the product details in the overlay
                    document.getElementById("product-name").textContent = prodName;
                    document.getElementById("product-price").textContent = prodPrice;
                    document.getElementById("product-image").src = prodImage;
                    document.getElementById("product-description2").textContent = prodDesc;

                    // Show the overlay
                    overlay.style.visibility = "visible";
                    overlay.style.opacity = "1";
                });
            });

            // Close the overlay when the close button is clicked
            document.querySelector(".exit-button").addEventListener("click", function() {
                const overlay = document.getElementById("overlay");
                overlay.style.visibility = "hidden";
                overlay.style.opacity = "0";
            });

            document.getElementById("overlay").addEventListener("click", function(e) {
                const overlay = document.getElementById("overlay");

                // Check if the clicked element is inside the .formContainer, if so, do nothing
                if (!e.target.closest('.formContainer')) {
                    overlay.style.visibility = "hidden";
                    overlay.style.opacity = "0";
                }
            });
        </script>

        <!------------Scripts------------>
        <!------------Scripts------------>
        <!------------Scripts------------>
        <script>
            // Toggle active state for Delivery and Pick-Up buttons
            const deliveryBtn = document.getElementById("delivery-btn");
            const pickupBtn = document.getElementById("pickup-btn");

            deliveryBtn.addEventListener("click", () => {
                deliveryBtn.classList.add("active");
                pickupBtn.classList.remove("active");

            });

            pickupBtn.addEventListener("click", () => {
                pickupBtn.classList.add("active");
                deliveryBtn.classList.remove("active");
            });

            // Set default active button (optional)
            deliveryBtn.classList.add("active"); // Default: Delivery active
        </script>

        <script>
            // Horizontal scrolling for category slider
            const slider = document.getElementById('categslider');

            let isDown = false;
            let startX;
            let scrollLeft;

            slider.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
                e.preventDefault(); // Prevent default behavior
            });

            slider.addEventListener('mouseleave', () => {
                isDown = false;
            });

            slider.addEventListener('mouseup', () => {
                isDown = false;
            });

            slider.addEventListener('mousemove', (e) => {
                if (!isDown) return; // Stop if mouse isn't held down
                const x = e.pageX - slider.offsetLeft;
                const walk = (x - startX) * 2; // Scroll sensitivity
                slider.scrollLeft = scrollLeft - walk;
            });

            // Active class toggle for category links
            const categoryLinks = document.querySelectorAll('.categslider a');

            categoryLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault(); // Prevent default link behavior
                    categoryLinks.forEach(link => link.classList.remove(
                        'active')); // Remove active from all links
                    link.classList.add('active'); // Add active class to the clicked link
                });
            });

            document.addEventListener('DOMContentLoaded', () => {
                if (categoryLinks.length > 0) {
                    categoryLinks[0].classList.add('active'); // Add active to the first link
                }
            });

            // Get references to the button and search input
            // Get references to the button and search input
            const searchBtn = document.getElementById('search-btn');
            const searchInput = document.getElementById('search-input');
            const exitBtn = document.getElementById("exit-btn");

            // Add an event listener to toggle the visibility of the search input
            searchBtn.addEventListener('click', () => {
                // Check if the search input is currently hidden or visible
                if (searchInput.style.display === 'none' || searchInput.style.display === '') {
                    searchInput.style.display = 'inline-block'; // Show the search input
                    exitBtn.style.display = "inline-block"; // Show the exit button
                    searchBtn.classList.add('active'); // Add the 'active' class to the button
                    searchInput.focus(); // Focus on the search input
                } else {
                    searchInput.style.display = 'none'; // Hide the search input
                    exitBtn.style.display = 'none'; // Hide the exit button
                    searchBtn.classList.remove('active'); // Remove the 'active' class from the button
                }
            });

            // Add an event listener for the exit button to clear and hide the search input immediately
            exitBtn.addEventListener("click", () => {
                searchInput.value = ""; // Clear search input
                searchInput.style.display = "none"; // Hide the search input
                exitBtn.style.display = "none"; // Hide the exit button
                searchBtn.classList.remove('active'); // Remove the 'active' class from the button
            });

            searchInput.addEventListener("blur", () => {
                searchInput.style.display = "none"; // Hide the search input
                exitBtn.style.display = "none"; // Hide the exit button
                searchBtn.classList.remove('active'); // Remove the 'active' class from the button
            });

            document.addEventListener('DOMContentLoaded', () => {
                const categoryLinks = document.querySelectorAll('.category-link');
                const categoryImage = document.getElementById('category-image');
                const prodShowContainer = document.getElementById('prod-show');

                categoryLinks.forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault(); // Prevent default link behavior

                        // Get category info from data attributes
                        const categoryId = link.dataset.categoryId;
                        const imageUrl = link.dataset.imageUrl;

                        // Update the category image only if it changes
                        if (categoryImage.src !== imageUrl) {
                            categoryImage.src = imageUrl;
                        }

                        // Find and scroll to the first product that matches the selected category
                        const products = document.querySelectorAll('.category-products');
                        let found = false;

                        products.forEach(product => {
                            if (product.getAttribute('data-category-id') == categoryId && !found) {
                                // Scroll to the product with a slight offset
                                product.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start', // Align to the top of the viewport
                                });

                                // Add a dynamic offset based on current scroll position
                                const offset = 150; // Adjust this value as needed
                                const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

                                window.scrollTo({
                                    top: scrollPosition - offset, // Subtract offset from the current scroll position
                                    behavior: 'smooth'
                                });

                                found = true; // Stop after the first match
                            }
                        });

                        // Update active class for category links
                        categoryLinks.forEach(link => link.classList.remove('active'));
                        link.classList.add('active');
                    });
                });

            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const header = document.querySelector(".searching");
                const headerOffset = header.offsetTop; // Get the header's initial position

                window.addEventListener("scroll", function() {
                    if (window.scrollY > headerOffset) {
                        header.classList.add("sticky");
                    } else {
                        header.classList.remove("sticky");
                    }
                });
            });
        </script>

</body>

</html>