<?php
include "../Database/db.php";

// Sanitize the dates to ensure no time components cause issues
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

// If start and end dates are provided, ensure they include the full range of the week (start of day and end of day)
if ($start_date && $end_date) {
    // Adjust the end date to include the full day (23:59:59) if needed
    $start_date .= " 00:00:00";  // Start of day for start date
    $end_date .= " 23:59:59";     // End of day for end date
}

// Initialize the SQL query
$sql = "SELECT DATE(date) AS date, SUM(total_revenue) AS total_revenue FROM tbl_sales";

// Apply the date range filter (use DATE() to ignore time)
if ($start_date && $end_date) {
    $sql .= " WHERE DATE(date) BETWEEN '$start_date' AND '$end_date'";  // Use DATE() to ignore time
}

$sql .= " GROUP BY DATE(date) ORDER BY DATE(date) ASC";  // Group by date and order by date

// Execute the query
$result1 = $connection->query($sql);

// Initialize an array to hold the data
$data = [];

// Loop through the result and prepare the data
while ($row1 = $result1->fetch_assoc()) {
    $data[] = [
        'date' => $row1['date'],  // Date in the format YYYY-MM-DD
        'total_revenue' => (float)$row1['total_revenue']  // Ensure revenue is treated as a float
    ];
}

// Set header to indicate JSON response
header('Content-Type: application/json');

// Output the data as JSON
echo json_encode($data);
exit;  // Ensure no additional output is sent after JSON
?>
