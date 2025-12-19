<?php
include '../Database/db.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $query = "SELECT * FROM tbl_products WHERE prod_id = '$productId'";
    $result = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        echo json_encode($product);  // Return product data in JSON format
    } else {
        echo json_encode(["error" => "Product not found"]);
    }
} else {
    echo json_encode(["error" => "No product ID provided"]);
}
?>
