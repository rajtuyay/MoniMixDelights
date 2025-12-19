<?php session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} else {
    include "../Database/db.php";
    $admin_id = $_SESSION['user'];

    $query = "SELECT username, display_photo FROM tbl_admin
                  WHERE admin_id = '$admin_id'";

    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $username = ucwords($row['username']);
    $imgURL = '../IMG/Profile-Image/' . $row['display_photo'];
    // Fetch categories from the database
    $query1 = "SELECT category_id, category_name FROM tbl_categories";
    $result1 = mysqli_query($connection, $query1);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/admin-index.css">
    <link rel="stylesheet" href="../CSS/font.css">
    <title>Dashboard</title>
    <script src="../Libraries/d3js.js"></script>
    <link href="../Libraries/flatpickr.css" rel="stylesheet">
    <script src="../Libraries/flatpickr-js.js"></script>
</head>

<body>
    <?php include "admin-navigation.php" ?>
    <div id="container">
        <?php include "admin-header.php" ?>

        <?php
        // Handle dynamic content loading
        $allowed_pages = ['admin-dashboard', 'admin-products', 'admin-order', 'admin-pending', 'admin-delivered', 'admin-cancelled', 'admin-reviews', 'admin-queries', 'admin-profile']; // Allowed pages
        $page = isset($_GET['page']) ? $_GET['page'] : 'admin-dashboard'; // Default to 'dashboard' if no 'page' parameter

        if (in_array($page, $allowed_pages)) {
            include $page . ".php"; // Include the corresponding content file
        } else {
            echo "<h2>Page not found!</h2>"; // Display an error for invalid pages
        }
        ?>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const buttons = document.querySelectorAll("button[data-page]");

                // Mapping of button IDs to their active images
                const activeImages = {
                    dashboard: "../IMG/icon-dashboard.png",
                    stats: "../IMG/icon-stats.png",
                    sales: "../IMG/icon-sales.png",
                    recent: "../IMG/icon-recent.png",
                    products: "../IMG/icon-products.png",
                    order: "../IMG/icon-orders.png",
                    perInfo: "../IMG/icon-info.png",
                    pending: "../IMG/icon-pending.png",
                    delivered: "../IMG/icon-delivered.png",
                    cancelled: "../IMG/icon-cancelled.png",
                    reviews: "../IMG/icon-review.png",
                    queries: "../IMG/icon-queries.png",
                    logout: "../IMG/icon-logout.png"
                };

                // Mapping of button IDs to their default images
                const defaultImages = {
                    dashboard: "../IMG/icon-dashboard-1.png",
                    stats: "../IMG/icon-stats-1.png",
                    sales: "../IMG/icon-sales-1.png",
                    recent: "../IMG/icon-recent-1.png",
                    products: "../IMG/icon-products-1.png",
                    order: "../IMG/icon-orders-1.png",
                    perInfo: "../IMG/icon-info-1.png",
                    pending: "../IMG/icon-pending-1.png",
                    delivered: "../IMG/icon-delivered-1.png",
                    cancelled: "../IMG/icon-cancelled-1.png",
                    reviews: "../IMG/icon-review-1.png",
                    queries: "../IMG/icon-queries-1.png",
                    logout: "../IMG/icon-logout-1.png"
                };

                // Get the last active button from localStorage (if any)
                const activeButtonId = localStorage.getItem("activeButton") || "perInfo"; // Default to perInfo
                const defaultButton = document.getElementById(activeButtonId);

                // Extract the current page from the URL query string
                const urlParams = new URLSearchParams(window.location.search);
                const currentPage = urlParams.get("page");

                // Ensure the current page matches the active button's data-page
                if (defaultButton) {
                    const intendedPage = defaultButton.getAttribute("data-page");

                    if (intendedPage && currentPage !== intendedPage) {
                        // Redirect only if the current page is different from the intended page
                        //window.location.href = `admin-index.php?page=${intendedPage}`;
                        //return; // Prevent further execution after redirection
                    }

                    // Highlight the active button
                    defaultButton.classList.add("active");
                    const img = defaultButton.querySelector("img");
                    const text = defaultButton.querySelector("p");
                    const tag = defaultButton.querySelector("a");

                    // Update the image for the active button
                    if (img && activeImages[activeButtonId]) {
                        img.src = activeImages[activeButtonId]; // Set to active image
                    }

                    // Update text color and font weight
                    if (text) {
                        text.style.color = "#FA8BCE"; // Set text color to pink
                        text.style.fontWeight = "700"; // Set font weight to bold
                    }
                    if (tag) {
                        tag.style.color = "#FA8BCE"; // Set text color to pink for <a> tag
                        tag.style.fontWeight = "700"; // Set font weight to bold for <a> tag
                    }

                    // Apply border and background color to the active button
                    defaultButton.style.borderLeft = "3px solid #FA8BCE";
                    defaultButton.style.background = "linear-gradient(to right, #fef8fb 0%, #FEE3F3 100%)"; // Set background color
                }

                // Event listener for button clicks
                buttons.forEach(button => {
                    button.addEventListener("click", () => {
                        // Remove 'active' class and reset styles for all buttons
                        buttons.forEach(btn => {
                            btn.classList.remove("active");
                            const img = btn.querySelector("img");
                            const text = btn.querySelector("p");
                            const tag = btn.querySelector("a");

                            // Reset image
                            if (img && defaultImages[btn.id]) {
                                img.src = defaultImages[btn.id]; // Reset to default image
                            }

                            // Reset text color and font weight
                            if (text) {
                                text.style.color = ""; // Reset text color
                                text.style.fontWeight = ""; // Reset font weight
                            }
                            if (tag) {
                                tag.style.color = ""; // Reset text color for <a> tag
                                tag.style.fontWeight = ""; // Reset font weight for <a> tag
                            }

                            // Reset button styles
                            btn.style.borderLeft = ""; // Reset border
                            btn.style.background = ""; // Reset background color
                        });

                        // Add 'active' class and apply styles to the clicked button
                        button.classList.add("active");

                        const img = button.querySelector("img");
                        const text = button.querySelector("p");
                        const tag = button.querySelector("a");

                        // Update the image for the active button
                        if (img && activeImages[button.id]) {
                            img.src = activeImages[button.id]; // Set to active image
                        }

                        // Update text color and font weight
                        if (text) {
                            text.style.color = "#FA8BCE"; // Set text color to pink
                            text.style.fontWeight = "700"; // Set font weight to bold
                        }
                        if (tag) {
                            tag.style.color = "#FA8BCE"; // Set text color to pink for <a> tag
                            tag.style.fontWeight = "700"; // Set font weight to bold for <a> tag
                        }

                        // Apply border and background color to the active button
                        button.style.borderLeft = "3px solid #FA8BCE";
                        button.style.background = "linear-gradient(to right, #fef8fb 0%, #FEE3F3 100%)"; // Set background color

                        // Save the active button ID in localStorage
                        localStorage.setItem("activeButton", button.id);

                        const page = button.getAttribute("data-page");
                        window.location.href = `admin-index.php?page=${page}`;
                    });
                });

                document.getElementById("logout").addEventListener("click", function(event) {
                    event.preventDefault(); // Prevent default action of the <a> tag
                    window.location.href = "logout.php"; // Redirect to logout.php
                    // Optionally, clear the activeButton from localStorage when logging out
                    localStorage.removeItem("activeButton");
                });
            });
        </script>
    </div>

    <div id="addProductModal" class="modal" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" id="closeProductModalBtn">&times;</button>
            <h2>Add New Product</h2>
            <form id="addProductForm" action="save-product.php" method="post" enctype="multipart/form-data">
                <!-- Product Name -->
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" placeholder="Enter product name" required>

                <!-- Product Description -->
                <label for="productDescription">Product Description:</label>
                <textarea id="productDescription" name="productDescription" placeholder="Enter product description" rows="4" required></textarea>

                <!-- Product Price -->
                <label for="productPrice">Product Price:</label>
                <input type="number" id="productPrice" name="productPrice" placeholder="Enter product price" step="0.01" min="0" required>

                <!-- Product Stock -->
                <label for="productStock">Product Stock:</label>
                <input type="number" id="productStock" name="productStock" placeholder="Enter product stock" min="0" required>

                <!-- Product Status -->
                <label for="productStatus">Product Status:</label>
                <select id="productStatus" name="productStatus" required>
                    <option value="" disabled selected>--Select Status--</option>
                    <option value="Available">Available</option>
                    <option value="Unavailable">Unavailable</option>
                </select>

                <!-- Product Category -->
                <label for="productCategory">Product Category:</label>
                <select id="productCategory" name="productCategory" required>
                    <option value="" disabled selected>--Select Category--</option>
                    <?php
                    // Loop through the categories and populate the options
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        echo "<option value='" . $row1['category_id'] . "'>" . $row1['category_name'] . "</option>";
                    }
                    ?>
                </select>

                <!-- Product Image -->
                <label for="productImage">Product Image:</label>
                <input type="file" id="productImage" name="productImage" accept="image/*" required>

                <!-- Submit Button -->
                <button id="addProductButton" type="submit">Save Product</button>
            </form>
            <script>
                // Close modal
                document.getElementById("closeProductModalBtn").addEventListener("click", function() {
                    const modal = document.getElementById("addProductModal");
                    modal.style.display = "none";
                });

                // Close modal when clicking outside the modal content
                window.addEventListener("click", function(event) {
                    const modal = document.getElementById("addProductModal");
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                });
            </script>
        </div>
    </div>

    <div id="addCategoryModal" class="modal" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" id="closeCategoryModalBtn">&times;</button>
            <h2>Add New Category</h2>
            <form id="addCategoryForm" action="save-category.php" method="post" enctype="multipart/form-data">
                <!-- Category Name -->
                <label for="categoryName">Category Name:</label>
                <input type="text" id="categoryName" name="categoryName" placeholder="Enter category name" required>

                <!-- Category Description -->
                <label for="categoryDescription">Category Description:</label>
                <textarea id="categoryDescription" name="categoryDescription" placeholder="Enter category description" rows="4"></textarea>

                <!-- Category Image -->
                <label for="categoryImage">Category Image:</label>
                <input type="file" id="categoryImage" name="categoryImage" accept="image/*" required>

                <!-- Submit Button -->
                <button id="addCategoryButton" type="submit">Save Category</button>
            </form>
            <script>
                // Close modal
                document.getElementById("closeCategoryModalBtn").addEventListener("click", function() {
                    const modal = document.getElementById("addCategoryModal");
                    modal.style.display = "none";
                });

                // Close modal when clicking outside the modal content
                window.addEventListener("click", function(event) {
                    const modal = document.getElementById("addCategoryModal");
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                });
            </script>
        </div>
    </div>

    <div id="editProductModal" class="modal" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" id="closeProductModalBtn">&times;</button>
            <h2>Edit Product</h2>
            <form id="editProductForm" action="edit-product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="productId" name="productId">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" required>

                <label for="productDescription">Product Description:</label>
                <textarea id="productDescription" name="productDescription" required></textarea>

                <label for="productPrice">Product Price:</label>
                <input type="number" id="productPrice" name="productPrice" step="0.01" min="0" required>

                <label for="productStock">Product Stock:</label>
                <input type="number" id="productStock" name="productStock" min="0" required>

                <label for="productStatus">Product Status:</label>
                <select id="productStatus" name="productStatus" required>
                    <option value="" disabled selected>--Select Status--</option>
                    <option value="Available">Available</option>
                    <option value="Unavailable">Unavailable</option>
                </select>

                <label for="productCategory">Product Category:</label>
                <select id="productCategory" name="productCategory" required>
                    <option value="" disabled selected>--Select Category--</option>
                    <?php
                    // Assuming $connection is your database connection
                    $categoryQuery = "SELECT category_id, category_name FROM tbl_categories";
                    $categoryResult = mysqli_query($connection, $categoryQuery);

                    while ($category = mysqli_fetch_assoc($categoryResult)) {
                        echo '<option value="' . $category['category_id'] . '">' . $category['category_name'] . '</option>';
                    }
                    ?>
                </select>

                <!-- Product Image -->
                <label for="productImage">Product Image:</label>
                <input type="file" id="productImage" name="productImage" accept="image/*" required>

                <button id="editProductButton" type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <div id="replyModal" class="modal" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" id="closeProductModalBtn">&times;</button>
            <h2>Reply</h2>
            <form id="replyForm" action="reply-admin.php" method="POST">
                <input type="hidden" id="reviewId" name="reviewId">
                <label id="userName">User Review:</label>
                <textarea id="reviewText" name="reviewText" style="cursor: default; outline: none;" readonly></textarea>
                
                <label for="adminName">Admin Reponse:</label>
                <textarea id="replyText" name="replyText" required></textarea>
                <button id="replyButton" type="submit">Reply</button>
            </form>
        </div>
    </div>
</body>

</html>