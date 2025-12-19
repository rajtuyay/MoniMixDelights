<?php
include '../Database/db.php';

$product = mysqli_real_escape_string($connection, $_GET['product'] ?? 'all');

$query = "SELECT 
        DATE(tbl_reviews.created_at) AS created_at, 
        tbl_products.prod_name, 
        tbl_user.firstname, 
        tbl_user.lastname, 
        tbl_reviews.rating, 
        tbl_reviews.review_id,
        tbl_reviews.review_text,
        tbl_reviews.reply_text
        FROM tbl_products 
        JOIN tbl_reviews ON tbl_products.prod_id = tbl_reviews.prod_id
        JOIN tbl_user ON tbl_reviews.user_id = tbl_user.user_id";

if ($product !== 'all') {
    $query .= " WHERE tbl_products.prod_id = $product";
}

$query .= " ORDER BY tbl_reviews.created_at DESC";

$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
?><tr id="row-heads">
        <th>Date</th>
        <th>Product</th>
        <th>Name</th>
        <th>Rating</th>
        <th>Review</th>
        <th>Reply</th>
        <th>Action</th>
    </tr><?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
        <tr id="row-orders">
            <td><?php echo $row['created_at'] ?></td>
            <td><?php echo $row['prod_name'] ?></td>
            <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
            <td>
                <?php
                $rate = $row['rating'];
                for ($i = 0; $i < $rate; $i++) {
                ?><span class="star"></span><?php
                                        }
                                            ?>
            </td>
            <td style="text-align: justify;">
                <?php
                echo $row['review_text'];
                if ($row['reply_text'] != "") {
                    echo "<br><br>" . "<p>" . "Admin Response:<br>" . $row['reply_text'] . "</p>";
                }
                ?>
            </td>
            <td id="td-reply">
                <button class="btn-reply" data-id="<?php echo $row['review_id']; ?>">Reply</button>
            </td>
            <td id="td-action">
                <form action="delete-review.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                    <input type="hidden" name="reviewId" value="<?php echo $row['review_id']; ?>">
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </td>
        </tr>
<?php }
        } else {
            echo '<p style="display:block; text-align: center;">No reviews found.</p>';
        }

?>