<style>
    .notAllowed {
        background-color: gray;
        cursor: not-allowed;
        box-sizing: border-box;
        color: white;
        border: none;
        width: 70%;
        margin: 3px 0;
        padding: 2px 0;
        user-select: none;
        border-radius: 0.5vh;
    }
</style>
<?php
include '../Database/db.php';

$product = mysqli_real_escape_string($connection, $_GET['product'] ?? 'all');

$query = "SELECT 
            DATE(tbl_orders.order_date) AS order_date, 
            tbl_products.prod_name, 
            tbl_user.firstname, 
            tbl_user.lastname, 
            tbl_order_items.quantity, 
            tbl_orders.total_amount, 
            tbl_orders.status,
            tbl_orders.order_id
          FROM tbl_products 
          JOIN tbl_order_items ON tbl_products.prod_id = tbl_order_items.prod_id
          JOIN tbl_orders ON tbl_order_items.order_id = tbl_orders.order_id 
          JOIN tbl_user ON tbl_orders.user_id = tbl_user.user_id";

if ($product !== 'all') {
    $query .= " WHERE tbl_products.prod_id = $product";
}

$query .= " ORDER BY tbl_orders.order_date DESC";

$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
?>
    <tr id="row-heads">
        <th>Date</th>
        <th>Product</th>
        <th>Username</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr class="row-orders" data-status="<?php echo $row['status'] ?>">
            <td><?php echo $row['order_date'] ?></td>
            <td><?php echo $row['prod_name'] ?></td>
            <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
            <td><?php echo $row['quantity'] ?></td>
            <td>₱<?php echo $row['total_amount'] ?></td>
            <td><?php echo $row['status'] ?></td>
            <td id="td-action">
                <form id="btn-action" action="accept-order-main.php" method="POST" onsubmit="return confirm('Are you sure you want to accept this product?')">
                    <input type="hidden" name="orderId" value="<?php echo $row['order_id'] ?>">
                    <button class="<?php echo ($row['status'] == 'Delivered' || $row['status'] == 'Cancelled') ? 'notAllowed' : 'btn-accept'; ?>" type="<?php echo ($row['status'] == 'Delivered' || $row['status'] == 'Cancelled') ? 'button' : 'submit'; ?>">Accept</button>
                </form>
                <form id="btn-action" action="cancel-order-main.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this product?')">
                    <input type="hidden" name="orderId" value="<?php echo $row['order_id'] ?>">
                    <button class="<?php echo ($row['status'] == 'Delivered' || $row['status'] == 'Cancelled') ? 'notAllowed' : 'btn-accept'; ?>" type="<?php echo ($row['status'] == 'Delivered' || $row['status'] == 'Cancelled') ? 'button' : 'submit'; ?>">Cancel</button>
                </form>
            </td>
        </tr>
<?php
    }
} else {
    echo '<p style="display:block; text-align: center;">No orders found.</p>';
}
?>