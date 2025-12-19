<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

// Get raw POST data
$data = json_decode(file_get_contents('php://input'), true);

error_log('Received data: ' . print_r($data, true));

// Check if the required keys are present
if (!isset($data['orderItems'], $data['address'], $data['contact'], $data['paymentMethod'], $data['totalAmount'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
    exit;
}

// Assign data to variables
$orderItems = $data['orderItems'];
$address = $data['address'];
$contact = $data['contact'];
$paymentMethod = $data['paymentMethod'];
$totalAmount = $data['totalAmount'];
$userId = $_SESSION['user'];  // Get the user ID from the session

// Split the concatenated address into its components (street, barangay, city, province)
$addressParts = explode(", ", $address);
if (count($addressParts) == 4) {
    list($street, $barangay, $city, $province) = $addressParts;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid address format']);
    exit;
}

// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_monimix', 'root', ''); // Update with your credentials
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the payment method is Moni-Wallet and if balance is sufficient
    if ($paymentMethod == 'Moni-Wallet') {
        // Check the wallet balance for the user
        $query = "SELECT balance FROM tbl_wallet WHERE user_id = :user_id LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        $walletBalance = 0;
        if ($stmt->rowCount() > 0) {
            $walletBalance = $stmt->fetch(PDO::FETCH_ASSOC)['balance'];
        }

        // Check if the wallet balance is sufficient
        if ($walletBalance < $totalAmount) {
            echo json_encode(['status' => 'error', 'message' => 'Insufficient wallet balance']);
            exit;
        }

        // Deduct the total order amount from the wallet balance
        $newBalance = $walletBalance - $totalAmount;
        $query = "UPDATE tbl_wallet SET balance = :new_balance WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':new_balance', $newBalance);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }

    // Check if the address already exists in the user's address book
    $query = "SELECT address_id FROM tbl_addresses WHERE user_id = :user_id AND street = :street AND barangay = :barangay AND city = :city AND province = :province LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':barangay', $barangay);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':province', $province);
    $stmt->execute();

    $addressId = null;
    if ($stmt->rowCount() > 0) {
        // Address exists, get the address ID
        $addressId = $stmt->fetch(PDO::FETCH_ASSOC)['address_id'];
    } else {
        // Address does not exist, insert it into the database
        $query = "INSERT INTO tbl_addresses (user_id, street, barangay, city, province, phone_number) VALUES (:user_id, :street, :barangay, :city, :province, :contact)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':barangay', $barangay);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':province', $province);
        $stmt->bindParam(':contact', $contact);
        $stmt->execute();

        // Get the newly inserted address ID
        $addressId = $pdo->lastInsertId();
    }

    // Insert the order into tbl_orders
    $query = "INSERT INTO tbl_orders (user_id, address_id, total_amount, status) 
              VALUES (:user_id, :address_id, :total_amount, 'Pending')";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':address_id', $addressId); // Use address ID from the addresses table
    $stmt->bindParam(':total_amount', $totalAmount);
    $stmt->execute();

    // Get the ID of the newly inserted order
    $orderId = $pdo->lastInsertId();

    foreach ($data['orderItems'] as $item) {
        $productName = $item['product_name'];

        // Fetch the product ID based on the product name
        $query = "SELECT prod_id FROM tbl_products WHERE prod_name = :product_name LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':product_name', $productName);
        $stmt->execute();

        // Check if the product exists
        if ($stmt->rowCount() > 0) {
            // Get the product ID
            $prodId = $stmt->fetch(PDO::FETCH_ASSOC)['prod_id'];

            // Insert the payment record into tbl_payments
            try {
                $query = "INSERT INTO tbl_payments (order_id, prod_id, amount, payment_method) 
                          VALUES (:order_id, :prod_id, :amount, :payment_method)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':order_id', $orderId);
                $stmt->bindParam(':prod_id', $prodId);  // Use the prod_id fetched directly
                $stmt->bindParam(':amount', $item['price']); // Use the price of the product
                $stmt->bindParam(':payment_method', $paymentMethod);
                $stmt->execute();
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error inserting into tbl_payments: ' . $e->getMessage()]);
                exit;
            }

            // Insert the order items into tbl_order_items
            try {
                $query = "INSERT INTO tbl_order_items (order_id, prod_id, package, quantity, price) 
                          VALUES (:order_id, :prod_id, :package, :quantity, :price)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':order_id', $orderId);
                $stmt->bindParam(':prod_id', $prodId); // Use the prod_id fetched directly
                $stmt->bindParam(':quantity', $item['quantity']);
                $stmt->bindParam(':price', $item['price']);
                $packageDescription = "Box of " . $item['package'];
                $stmt->bindParam(':package', $packageDescription);
                $stmt->execute();
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error inserting into tbl_order_items: ' . $e->getMessage()]);
                exit;
            }
        } else {
            // Product does not exist in the database
            echo json_encode(['status' => 'error', 'message' => 'Product does not exist: ' . $productName]);
            exit;
        }
    }

    // Return success response
    echo json_encode(['status' => 'success', 'message' => 'Order placed successfully']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
