<?php
header('Content-Type: application/json');
include "../Database/db.php";

$monthNames = [
    "January" => 1, "February" => 2, "March" => 3, "April" => 4,
    "May" => 5, "June" => 6, "July" => 7, "August" => 8,
    "September" => 9, "October" => 10, "November" => 11, "December" => 12
];

$current_month = isset($_GET['month']) ? ucfirst(strtolower($_GET['month'])) : date('F');
$current_year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

if (!array_key_exists($current_month, $monthNames)) {
    $current_month = date('F');
}
$month_number = $monthNames[$current_month];
$date_filter = sprintf("%04d-%02d", $current_year, $month_number);

$query = "
    SELECT SUM(total_revenue) AS total_revenue
    FROM tbl_sales
    WHERE DATE_FORMAT(date, '%Y-%m') = ?
";

$stmt = $connection->prepare($query);
if (!$stmt) {
    die(json_encode(["error" => "Failed to prepare statement: " . $connection->error]));
}
$stmt->bind_param("s", $date_filter);
$stmt->execute();
$result = $stmt->get_result();

$response = [];
if ($result && $row = $result->fetch_assoc()) {
    $total_revenue = $row['total_revenue'] ?? 0;
    $response['total_revenue'] = $total_revenue;
    $response['month'] = $current_month;

    // Debug log
    error_log("Month: $current_month, Year: $current_year, Total Revenue: $total_revenue");
} else {
    $response['total_revenue'] = 0;
    $response['month'] = $current_month;

    // Debug log
    error_log("No data found for Month: $current_month, Year: $current_year");
}

echo json_encode($response);
$stmt->close();
$connection->close();
?>
