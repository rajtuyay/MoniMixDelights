<?php
include "../Database/db.php";

// Get the year from the request, or use the current year as default
$selected_year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// SQL query to get data for the selected year
$sql = "
SELECT
    YEAR(date) AS year,
    MONTH(date) AS month,
    SUM(total_revenue) AS total_revenue,
    -- Revenue growth calculation with proper handling of the first month
    CASE
        WHEN COALESCE(LAG(SUM(total_revenue)) OVER (ORDER BY YEAR(date), MONTH(date)), 0) = 0 THEN 100
        ELSE (SUM(total_revenue) - COALESCE(LAG(SUM(total_revenue)) OVER (ORDER BY YEAR(date), MONTH(date)), 0)) / 
            COALESCE(LAG(SUM(total_revenue)) OVER (ORDER BY YEAR(date), MONTH(date)), 1) * 100
    END AS revenue_growth_percentage
FROM tbl_sales
WHERE YEAR(date) = '$selected_year'
GROUP BY YEAR(date), MONTH(date)
ORDER BY YEAR(date) ASC, MONTH(date) ASC  -- Order by year and month in ascending order (earliest first)
";

// Execute the query
$result1 = $connection->query($sql);

// Prepare the data as JSON
$data = [];
$firstRow = true;  // Flag to identify the first row (earliest month)

// Loop through the result and prepare the data
while ($row1 = $result1->fetch_assoc()) {
    // For the first row, set growth percentage to 'N/A'
    if ($firstRow) {
        $row1['revenue_growth_percentage'] = 'N/A';
        $firstRow = false;
    }
    
    // Add the row data to the result array
    $data[] = [
        'year' => $row1['year'], 
        'month' => $row1['month'], 
        'total_revenue' => (float)$row1['total_revenue'],
        'revenue_growth_percentage' => $row1['revenue_growth_percentage']  // Either growth percentage or 'N/A'
    ];
}

// Return JSON
header('Content-Type: application/json');
echo json_encode($data);
exit;
?>
