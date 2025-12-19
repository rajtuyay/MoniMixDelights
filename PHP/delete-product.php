<?php
// Include database connection
include "../Database/db.php";

// Check if the productId is passed via POST
if (isset($_POST['productId'])) {
    $productId = $_POST['productId']; // Get the product ID from the POST data

    // Step 1: Retrieve the image filename before deleting the product
    $query1 = "SELECT prod_image FROM tbl_products WHERE prod_id = ?";
    $stmt1 = $connection->prepare($query1);
    $stmt1->bind_param('i', $productId);
    $stmt1->execute();
    $stmt1->bind_result($imageName);
    $stmt1->fetch();
    $stmt1->close();

    // Step 2: Delete the image file from the server if it exists
    if (!empty($imageName) && $imageName != 'default.jpg') { // Avoid deleting a default image if applicable
        $imagePath = "../IMG/Products/" . $imageName;
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath); // Delete the image file
        } else {
            echo "Error: Image file does not exist or is a directory.";
        }
    }

    // Step 3: Delete the product from the database
    $query2 = "DELETE FROM tbl_products WHERE prod_id = ?";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param('i', $productId);

    if ($stmt2->execute()) {
        echo "<script>
                alert('Product deleted successfully!');
                window.location.href = 'admin-index.php?page=admin-products'; // Redirect to the products page
              </script>";
    } else {
        echo "<script>
                alert('An error occurred while deleting the product. Please try again.');
                window.location.href = 'admin-index.php?page=admin-products'; // Redirect back to the products page
              </script>";
    }

    $stmt2->close();
} else {
    // If no productId is provided in the POST data
    echo "<script>
            alert('Invalid product ID. Unable to delete the product.');
            window.location.href = 'admin-index.php?page=admin-products'; // Redirect back to the products page
          </script>";
}
?>