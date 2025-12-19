<?php
include '../Database/db.php';

$product = $_GET['product'] ?? 'all';
$status = $_GET['status'] ?? 'Pending';

if ($status == 'Pending'){
    $disable = 'submit';
} else {
    $disable = 'button';
}

// Validate input
if ($product !== 'all' && !ctype_digit($product)) {
    die('Invalid product ID');
}
$product = mysqli_real_escape_string($connection, $product);
$status = mysqli_real_escape_string($connection, $status);

// Build the query
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
          JOIN tbl_user ON tbl_orders.user_id = tbl_user.user_id
          WHERE tbl_orders.status = '$status'";

if ($product !== 'all') {
    $query .= " AND tbl_products.prod_id = $product";
}

$query .= " ORDER BY tbl_orders.order_date DESC";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
?><tr id="row-heads">
        <th>Date</th>
        <th>Product</th>
        <th>Username</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Status</th>
        <th>Action</th>
    </tr><?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr id="row-orders">
                <td>' . $row['order_date'] . '</td>
                <td>' . $row['prod_name'] . '</td>
                <td>' . $row['firstname'] . " " . $row['lastname'] . '</td>
                <td>' . $row['quantity'] . '</td>
                <td>₱' . $row['total_amount'] . '</td>
                <td>' . $row['status'] . '</td>
                <td id="td-action">'; ?>
                    <form id="btn-action" action="accept-order.php" method="POST" onsubmit="return confirm('Are you sure you want to accept this product?')">
                        <input type="hidden" name="orderId" value="<?php echo $row['order_id'] ?>">
                        <button id="btn-accept" type="<?php echo $disable?>">Accept</button>
                    </form>
                    <form id="btn-action" action="cancel-order.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this product?')">
                        <input type="hidden" name="orderId" value="<?php echo $row['order_id'] ?>">
                        <button id="btn-cancel" type="<?php echo $disable?>">Cancel</button>
                    </form>
                </td>
              </tr><?php
            }
    } else {
        echo '<p style="display:block; text-align: center;">No ' . $status . ' Orders found.</p>';
    }
?>