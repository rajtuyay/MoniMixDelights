<?php session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} else {
    include "../Database/db.php";
    $user_id = $_SESSION['user'];

    $query = "SELECT tbl_user.username, tbl_user.display_photo, tbl_wallet.balance FROM tbl_user
                  INNER JOIN tbl_wallet
                  ON tbl_user.user_id = tbl_wallet.user_id
                  WHERE tbl_user.user_id = '$user_id'";
                  
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $imgURL = '../IMG/Profile-Image/' . $row['display_photo'];
    $balance = $row['balance'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/profile.css">
    <link rel="stylesheet" href="../CSS/font.css">
    <title>Profile</title>
</head>

<body>
    <?php include "header.php" ?>
    <div id="bg">
        <div id="container">
            <div id="column1">
                <div id="avatarholder">
                    <img src="<?php echo $imgURL?>" id="avatar">
                    <button id="editProfile">
                        <img src="../IMG/icon-edit.png" alt="">
                    </button>
                    <h3><?php echo $username ?></h3>
                    <h4><?php echo "₱{$balance}"?></h4>
                    <p>Balance</p>
                </div>

                <script src="../JS/image-upload.js"></script>

                <div id="uploadImageModal" class="image-modal">
                    <div class="modal-content">
                        <button class="close-btn" id="closeModalBtn">&times;</button>
                        <h2>Select Image File to Upload:</h2>
                        <form id="imageForm" action="upload-profile.php" method="post" enctype="multipart/form-data">
                            <label for="inputFile">Choose File</label> <!-- Custom styled label -->
                            <input type="file" id="inputFile" name="file" accept="image/png, image/gif, image/jpeg" required>
                            <div id="fileName" class="file-name">No file selected</div> <!-- Optional file name display -->
                            <input type="submit" id="submitFile" name="submit" value="Upload">
                        </form>
                    </div>
                </div>

                <div class="info1">
                    <button type="button" id="wallet" data-page="wallet">
                        <img src="../IMG/icon-wallet-1.png" alt="Wallet">
                        <p>My Wallet</p>
                    </button>
                    <button type="button" id="order" data-page="order">
                        <img src="../IMG/icon-order-1.png" alt="Orders">
                        <p>My Orders</p>
                    </button>
                </div>

                <div class="info2">
                    <button type="button" id="perInfo" data-page="personal-information">
                        <img src="../IMG/icon-info-1.png" alt="Personal Info">
                        <p>Personal Information</p>
                    </button>
                    <button type="button" id="address" data-page="addresses">
                        <img src="../IMG/icon-address-1.png" alt="Addresses">
                        <p>Addresses</p>
                    </button>
                    <button type="button" id="paymentMethod" data-page="payment-options">
                        <img src="../IMG/icon-payment-1.png" alt="Payment Method">
                        <p>Payment Options</p>
                    </button>
                    <button type="button" id="security" data-page="security">
                        <img src="../IMG/icon-security-1.png" alt="Security">
                        <p>Security</p>
                    </button>
                </div>
                <div class="space"></div>
                <div class="info3">
                    <button id="logout">
                        <img src="../IMG/icon-logout-1.png" alt="Logout">
                        <a href="logout.php">Logout</a>
                    </button>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const buttons = document.querySelectorAll("button[data-page]");

                    // Mapping of button IDs to their active images
                    const activeImages = {
                        wallet: "../IMG/icon-wallet.png",
                        order: "../IMG/icon-order.png",
                        perInfo: "../IMG/icon-info.png",
                        address: "../IMG/icon-address.png",
                        paymentMethod: "../IMG/icon-payment.png",
                        security: "../IMG/icon-security.png",
                        logout: "../IMG/icon-logout.png"
                    };

                    // Mapping of button IDs to their default images
                    const defaultImages = {
                        wallet: "../IMG/icon-wallet-1.png",
                        order: "../IMG/icon-order-1.png",
                        perInfo: "../IMG/icon-info-1.png",
                        address: "../IMG/icon-address-1.png",
                        paymentMethod: "../IMG/icon-payment-1.png",
                        security: "../IMG/icon-security-1.png",
                        logout: "../IMG/icon-logout-1.png"
                    };

                    // Get the last active button from localStorage (if any)
                    const activeButtonId = localStorage.getItem("activeButton") || "perInfo"; // Default to perInfo
                    const defaultButton = document.getElementById(activeButtonId);

                    // Extract the current page from the URL query string
                    const urlParams = new URLSearchParams(window.location.search);
                    const currentPage = urlParams.get("page");

                    // Ensure the current page matches the active button's data-page
                    if (defaultButton) {
                        const intendedPage = defaultButton.getAttribute("data-page");

                        if (intendedPage && currentPage !== intendedPage) {
                            // Redirect only if the current page is different from the intended page
                            window.location.href = `profile.php?page=${intendedPage}`;
                            return; // Prevent further execution after redirection
                        }

                        // Highlight the active button
                        defaultButton.classList.add("active");
                        const img = defaultButton.querySelector("img");
                        const text = defaultButton.querySelector("p");
                        const tag = defaultButton.querySelector("a");

                        // Update the image for the active button
                        if (img && activeImages[activeButtonId]) {
                            img.src = activeImages[activeButtonId]; // Set to active image
                        }

                        // Update text color and font weight
                        if (text) {
                            text.style.color = "#FA8BCE"; // Set text color to pink
                            text.style.fontWeight = "700"; // Set font weight to bold
                        }
                        if (tag) {
                            tag.style.color = "#FA8BCE"; // Set text color to pink for <a> tag
                            tag.style.fontWeight = "700"; // Set font weight to bold for <a> tag
                        }

                        // Apply border and background color to the active button
                        defaultButton.style.borderLeft = "3px solid #FA8BCE";
                        defaultButton.style.background = "linear-gradient(to right, #fef8fb 0%, #FEE3F3 100%)"; // Set background color
                    }

                    // Event listener for button clicks
                    buttons.forEach(button => {
                        button.addEventListener("click", () => {
                            // Remove 'active' class and reset styles for all buttons
                            buttons.forEach(btn => {
                                btn.classList.remove("active");
                                const img = btn.querySelector("img");
                                const text = btn.querySelector("p");
                                const tag = btn.querySelector("a");

                                // Reset image
                                if (img && defaultImages[btn.id]) {
                                    img.src = defaultImages[btn.id]; // Reset to default image
                                }

                                // Reset text color and font weight
                                if (text) {
                                    text.style.color = ""; // Reset text color
                                    text.style.fontWeight = ""; // Reset font weight
                                }
                                if (tag) {
                                    tag.style.color = ""; // Reset text color for <a> tag
                                    tag.style.fontWeight = ""; // Reset font weight for <a> tag
                                }

                                // Reset button styles
                                btn.style.borderLeft = ""; // Reset border
                                btn.style.background = ""; // Reset background color
                            });

                            // Add 'active' class and apply styles to the clicked button
                            button.classList.add("active");

                            const img = button.querySelector("img");
                            const text = button.querySelector("p");
                            const tag = button.querySelector("a");

                            // Update the image for the active button
                            if (img && activeImages[button.id]) {
                                img.src = activeImages[button.id]; // Set to active image
                            }

                            // Update text color and font weight
                            if (text) {
                                text.style.color = "#FA8BCE"; // Set text color to pink
                                text.style.fontWeight = "700"; // Set font weight to bold
                            }
                            if (tag) {
                                tag.style.color = "#FA8BCE"; // Set text color to pink for <a> tag
                                tag.style.fontWeight = "700"; // Set font weight to bold for <a> tag
                            }

                            // Apply border and background color to the active button
                            button.style.borderLeft = "3px solid #FA8BCE";
                            button.style.background = "linear-gradient(to right, #fef8fb 0%, #FEE3F3 100%)"; // Set background color

                            // Save the active button ID in localStorage
                            localStorage.setItem("activeButton", button.id);

                            const page = button.getAttribute("data-page");
                            window.location.href = `profile.php?page=${page}`;
                        });
                    });

                    document.getElementById("logout").addEventListener("click", function(event) {
                        event.preventDefault(); // Prevent default action of the <a> tag
                        window.location.href = "logout.php"; // Redirect to logout.php
                        // Optionally, clear the activeButton from localStorage when logging out
                        localStorage.removeItem("activeButton");
                    });
                });
            </script>

            <div id="column2">
                <?php
                // Handle dynamic content loading
                $allowed_pages = ['personal-information', 'wallet', 'order', 'addresses', 'payment-options', 'security']; // Allowed pages
                $page = isset($_GET['page']) ? $_GET['page'] : 'personal-information'; // Default to 'info' if no 'page' parameter

                if (in_array($page, $allowed_pages)) {
                    include $page . ".php"; // Include the corresponding content file
                } else {
                    echo "<h2>Page not found!</h2>"; // Display an error for invalid pages
                }
                ?>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>

</html>