<?php
session_start();
include "../Database/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Make sure session has user_id
    if (!isset($_SESSION['user'])) {
        echo "<script>alert('User not logged in.'); window.location.href = 'login.php';</script>";
        exit();
    }

    // Get the currently logged-in user's ID
    $userId = $_SESSION['user'];

    // 1. Validate the current password
    $query = "SELECT password FROM tbl_user WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if the current password matches the stored password
    if (password_verify($currentPassword, $row['password'])) {
        // 2. Strong password validation
        if (strlen($newPassword) < 8) {
            echo "<script>alert('Password must be at least 8 characters long.'); window.location.href = 'profile.php?page=security';</script>";
            exit();
        }
        if (!preg_match('/[A-Z]/', $newPassword) || !preg_match('/[a-z]/', $newPassword) || !preg_match('/[0-9]/', $newPassword)) {
            echo "<script>alert('Password must contain at least one uppercase letter, one lowercase letter, and one number.'); window.location.href = 'profile.php?page=security';</script>";
            exit();
        }
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $newPassword)) {
            echo "<script>alert('Password must contain at least one special character.'); window.location.href = 'profile.php?page=security';</script>";
            exit();
        }

        // 3. Check if new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // 4. Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // 5. Update the password in the database
            $updateQuery = "UPDATE tbl_user SET password = ? WHERE user_id = ?";
            $updateStmt = $connection->prepare($updateQuery);
            $updateStmt->bind_param('si', $hashedPassword, $userId);

            if ($updateStmt->execute()) {
                echo "<script>alert('Password changed successfully!'); window.location.href = 'profile.php?page=security';</script>";
                exit();
            } else {
                echo "<script>alert('Error updating password. Please try again.'); window.location.href = 'profile.php?page=security';</script>";
                exit();
            }
        } else {
            echo "<script>alert('New password and confirmation do not match.'); window.location.href = 'profile.php?page=security';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Current password is incorrect.'); window.location.href = 'profile.php?page=security';</script>";
        exit();
    }
}
?>
