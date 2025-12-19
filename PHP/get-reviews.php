<?php
include '../Database/db.php';

if (isset($_GET['id'])) {
    $reviewId = $_GET['id'];
    $query = "SELECT tbl_reviews.review_text FROM tbl_reviews JOIN tbl_user ON tbl_reviews.user_id = tbl_user.user_id WHERE review_id = '$reviewId'";
    $result = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $review = mysqli_fetch_assoc($result);
        echo json_encode($review);  // Return product data in JSON format
    } else {
        echo json_encode(["error" => "Review not found"]);
    }
} else {
    echo json_encode(["error" => "No review ID provided"]);
}
?>
