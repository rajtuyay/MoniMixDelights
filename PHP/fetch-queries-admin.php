<style>

</style>

<?php
include '../Database/db.php';

// Sanitize the query parameter to prevent SQL injection
$queries = isset($_GET['query']) ? intval($_GET['query']) : 0;

// Query to fetch user and query data
$query = "SELECT 
            tbl_user.firstname, 
            tbl_user.lastname, 
            tbl_user.email,
            tbl_user.display_photo, 
            tbl_queries.query_id, 
            tbl_queries.subject, 
            tbl_queries.query_text,
            tbl_queries.query_reply 
          FROM tbl_user 
          JOIN tbl_queries ON tbl_user.user_id = tbl_queries.user_id 
          WHERE tbl_queries.query_id = $queries";

$result = mysqli_query($connection, $query);

$query1 = "SELECT * FROM tbl_admin WHERE admin_id = 1";
$result1 = mysqli_query($connection, $query1);
$row1 = mysqli_fetch_assoc($result1);

if (!$result) {
    // If query fails, show error message
    die('<p style="display:block; text-align: center;">Error executing query: ' . mysqli_error($connection) . '</p>');
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $query_id = $row['query_id']; // Unique query_id
?> 
        <div class="subject">
            <h2><?php echo htmlspecialchars($row['subject']); ?></h2>
            <img src="../IMG/icon-dropdown.png" class="dropdown" data-query-id="<?php echo $query_id; ?>" alt="Dropdown" width="15" height="15">
        </div>
        <div class="message" id="message-<?php echo $query_id; ?>">
            <h2><?php echo htmlspecialchars($row['firstname'] . " " . $row['lastname']); ?></h2>
            <div class="msg-content">
                <img src="<?php echo "../IMG/Profile-Image/" . htmlspecialchars($row['display_photo']); ?>" alt="User">
                <p><?php echo htmlspecialchars($row['query_text']); ?></p>
            </div>
        </div>

        <?php if ($row['query_reply'] != "") {
        ?>
            <div class="message1" id="message-<?php echo $query_id; ?>">
                <h2><?php echo htmlspecialchars($row1['username'])?></h2>
                <div class="msg-content">
                    <p><?php echo htmlspecialchars($row['query_reply']); ?></p>
                    <img src="<?php echo "../IMG/Profile-Image/" . htmlspecialchars($row1['display_photo']); ?>" alt="User">
                </div>
            </div>

        <?php } ?>

        <div class="admin-reply">
            <form method="POST" action="send-email.php?query=<?php echo $queries?>">
                <input type="hidden" name="subject" value="<?php echo $row['subject'] ?>" required>
                <textarea class="response" name="message" placeholder="Type your message here..." rows="1" required></textarea>
                <input type="hidden" name="user_email" value="<?php echo $row['email'] ?>"> <!-- Replace this with actual user email -->
                <button id="reply-btn" type="submit" name="reply"><img src="../IMG/icon-send.png" alt=""></button>
            </form>
        </div>
<?php
    }
} else {
    // Show a message if no queries are found
    echo '<p style="display:block; text-align: center;">No queries found.</p>';
}
?>