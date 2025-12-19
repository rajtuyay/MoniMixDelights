<?php
// Include database connection
include('../Database/db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $categoryName = $_POST['categoryName'];
    $categoryDescription = $_POST['categoryDescription'];

    // File upload processing
    $targetDir = "../IMG/Categories/"; // Directory where category images will be uploaded
    $targetFile = $targetDir . basename($_FILES["categoryImage"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["categoryImage"]["tmp_name"]);
    if ($check === false) {
        echo "<script>
                alert('File is not an image.');
                window.location.href = 'admin-index.php?page=admin-products'; // Redirect to the categories page
              </script>";
        exit;
    }

    // Check file size (for example, limit it to 5MB)
    if ($_FILES["categoryImage"]["size"] > 5000000) {
        echo "<script>
                alert('Sorry, your file is too large.');
                window.location.href = 'admin-index.php?page=admin-products'; // Redirect to the categories page
              </script>";
        exit;
    }

    // Allow only certain file formats (e.g., JPG, PNG, JPEG, GIF)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<script>
                alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
                window.location.href = 'admin-index.php?page=admin-products'; // Redirect to the categories page
              </script>";
        exit;
    }

    // If the file is valid, move it to the upload directory
    if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["categoryImage"]["name"])) . " has been uploaded.";
    } else {
        echo "<script>
                alert('Sorry, there was an error uploading your file.');
                window.location.href = 'admin-index.php?page=admin-products'; // Redirect to the categories page
              </script>";
        exit;
    }

    // Get only the file name (not the full path)
    $categoryImageName = basename($_FILES["categoryImage"]["name"]);

    // Insert category data into the database
    $query = "INSERT INTO tbl_categories (category_name, category_description, category_image)
              VALUES ('$categoryName', '$categoryDescription', '$categoryImageName')";

    // Run the query
    if (mysqli_query($connection, $query)) {
        echo "<script>
                alert('Category added successfully!');
                window.location.href = 'admin-index.php?page=admin-products'; // Redirect to the categories page
              </script>";
        exit();
    } else {
        echo "<script>
                alert('An error occurred while adding the category. Please try again later or contact support if the issue persists.');
                window.location.href = 'admin-index.php?page=admin-products'; // Redirect to the categories page
              </script>";
        exit();
    }
}
?>
