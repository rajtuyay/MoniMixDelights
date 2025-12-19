<?php
// search.php
if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];
    $results = [];

    include "../Database/db.php";

    $stmt = $connection->prepare("SELECT * FROM tbl_products WHERE prod_name LIKE ?");
    $searchTerm = $searchTerm . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }

    echo json_encode($results);

    $stmt->close();
    $connection->close();
}
?>