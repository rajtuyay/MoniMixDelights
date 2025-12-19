<?php
// Include database connection
include('../Database/db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];
    $productStatus = $_POST['productStatus'];
    $productCategory = $_POST['productCategory']; // Category ID from the form

    // File upload processing
    $targetDir = "../IMG/Products/"; // Directory where images will be uploaded
    $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit;
    }

    // Check file size (for example, limit it to 5MB)
    if ($_FILES["productImage"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        exit;
    }

    // Allow only certain file formats (e.g., JPG, PNG, GIF)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        exit;
    }

    // If the file is valid, move it to the upload directory
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["productImage"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit;
    }

    // Get only the file name (not the full path)
    $imageName = basename($_FILES["productImage"]["name"]);

    // Insert product data into the database including the category_id
    $query = "INSERT INTO tbl_products (prod_name, product_description, prod_price, stock_quantity, status, prod_image, category_id)
              VALUES ('$productName', '$productDescription', '$productPrice', '$productStock', '$productStatus', '$imageName', '$productCategory')";

    // Run the query
    if (mysqli_query($connection, $query)) {
        echo "<script>
                alert('Product added successfully!');
                window.location.href = 'admin-index.php?page=admin-products'; // Redirect to the products page
              </script>";
        exit();
    } else {
        echo "<script>
            alert('An error occurred while adding the product. Please try again later or contact support if the issue persists.');
            window.location.href = 'admin-index.php?page=admin-products'; // Redirect to the products page
            </script>";
        exit();
    }
}
