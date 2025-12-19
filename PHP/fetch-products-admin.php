<?php
include '../Database/db.php';
$category = $_GET['category'] ?? 'all';
$query = "SELECT * FROM tbl_products";
if ($category !== 'all') {
    $query .= " WHERE category_id = $category";
}
$result = mysqli_query($connection, $query);
$number = 0;
if (mysqli_num_rows($result) > 0) {
?><tr id="row-heads">
        <th>No.</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Status</th>
        <th>Action</th>
    </tr><?php
            while ($row = mysqli_fetch_assoc($result)) {
                $number += 1;
            ?>
        <tr id="row-orders">
            <td><?php echo $number ?></td>
            <td><?php echo $row['prod_name'] ?></td>
            <td><?php echo "₱" . $row['prod_price'] ?></td>
            <td><?php echo $row['stock_quantity'] ?></td>
            <td><?php echo $row['status'] ?></td>
            <td id="td-action">
                <button class="btn-edit" data-id="<?php echo $row['prod_id']; ?>">Edit</button>
                <form action="delete-product.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    <input type="hidden" name="productId" value="<?php echo $row['prod_id']; ?>">
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </td>
        </tr>
<?php }
        } else {
            echo '<p style="display:block; text-align: center;">No products found.</p>';
        } ?>