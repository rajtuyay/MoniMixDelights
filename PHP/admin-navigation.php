<style>
    #navigation {
        position: fixed;
        width: 20%;
        height: 100vh;
        left: 0;
        top: 0;
        visibility: visible;
        opacity: 1;
        transform: opacity 0.5s ease-in-out, visibility 0.3s ease-in-out, width 0.3s ease-in-out;
        overflow-x: hidden;
        z-index: 1001;
        box-shadow: 5px 0 6px rgba(0, 0, 0, 0.1);
    }

    #column1 {
        position: relative;
        font-family: 'Open Sans';
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        text-align: center;
        color: #B91EB3;
        background-color: #ffc7e9;
        transition: 0.5s ease-in-out;
    }

    #avatarholder {
        background-color: #ffc7e9;
        padding: 5px;
        text-align: center;
        width: 100%;
        height: 35%;
        border-top-right-radius: 10px;
    }

    #avatarholder #avatar {
        width: 140px;
        height: 140px;
        margin: 20px auto 10px auto;
        border: 1px solid #B91EB3;
        border-radius: 70%;
    }

    #avatarholder h3 {
        font-size: 1.2rem;
        margin: 0 0 15px 0;
        /* color: #ff52bb; */
        color: #B91EB3;
    }

    #avatarholder #editProfile {
        background-color: transparent;
        border: none;
        padding: 0;
        position: absolute;
        cursor: pointer;
    }

    #avatarholder #editProfile img {
        width: 20px;
        height: 20px;
    }

    .info1 {
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
        justify-content: flex-start;
        background-color: #ffc7e9;
        height: 55%;
        flex-direction: column;
        max-height: 55%;
        width: 100%;
    }

    .info2 {
        background-color: #ffc7e9;
        height: 10%;
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: flex-end;
    }

    .info1 .btnNav,
    .info2 #logout,
    .info1 div {
        font-family: 'Open Sans';
        display: flex;
        justify-content: flex-end;
        align-items: center;
        background-color: #ffc7e9;
        color: #B91EB3;
        cursor: pointer;
        border: none;
        width: 100%;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
    }

    .info1 #subBtn {
        display: none;
        justify-content: flex-start;
        align-items: end;
        flex-direction: column;
        background-color: #fdd0ec;
        height: auto;
        width: 100%;
        gap: 10px;
        padding: 10px 0;
        text-align: left;
        transition: 0.3s ease-in-out;
    }

    .info1 #subBtn a {
        display: flex;
        gap: 5px;
        height: auto;
        text-decoration: none;
        color: #B91EB3;
        width: 90%;
    }

    .info1 .btnNav {
        display: flex;
        background-color: #fdd0ec;
        height: 12%;
        width: 100%;
        text-align: left;
    }

    .info1 #subBtn button {
        display: flex;
        gap: 5px;
        height: auto;
        text-decoration: none;
        color: #B91EB3;
        width: 90%;
        background-color: #fdd0ec;
        border: none;
        cursor: pointer;
    }
    
    .info1 .btnNav #show-more {
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: normal;
        width: 10%;
        text-align: center;
        margin-right: 3px;
    }

    .info1 .btnNav #show-more img {
        width: 11px;
        height: 11px;
    }

    .info1 .btnNav.rotated #show-more img {
        transform: rotate(90deg);
    }

    .info1 .btnNav img,
    .info2 #logout img,
    .info1 div img {
        width: 20px;
        height: 20px;
        margin-left: 10px;
        width: auto;
    }

    .info1 .btnNav p,
    .info2 button a {
        width: 85%;
        margin-left: 5px;
    }

    .info1 #subBtn button p{
        font-size: 0.9rem;
    }

    .info1 #subBtn button{
        padding-left: 0; 
        padding-right: 0; 
    }

    .info1 {
        justify-content: flex-start;
        gap: 5px;
    }

    .info2 #logout {
        background-color: #fdd0ec;
        height: 70%;
        text-align: left;
    }

    #order #order-img {
        transform: scale(1.3);
    }

    #address img {
        transform: scale(1.1);
    }

    .info2 #logout a {
        font-family: 'Open Sans';
        color: #B91EB3;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
    }

    .info2 #logout {
        padding: 0 6px;
        bottom: 0;
    }

    /* Modal container */
    #uploadImageModal {
        display: none;
        /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Dark background */
        z-index: 9999;
        /* Ensure modal is on top */
    }

    /* Modal content */
    #uploadImageModal .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* Center the modal */
        width: 700px;
        /* Fixed width */
        max-height: 80%;
        /* Max height to prevent overflow */
        overflow-y: auto;
        /* Scroll if content is too tall */
    }

    /* Close button */
    #uploadImageModal .modal-content .close-btn {
        font-weight: 700;
        background-color: #ff5c5c;
        font-size: 14px;
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        margin-top: -10px;
        margin-right: -10px;
    }

    #uploadImageModal .modal-content .close-btn:hover {
        background-color: #ff3b3b;
    }

    #imageForm {
        display: flex;
        flex-direction: column;
        gap: 10px;
        /* Space between form fields */
    }

    #inputFile {
        display: none;
    }

    /* Style the custom label acting as the file input button */
    label[for="inputFile"] {
        display: inline-block;
        padding: 10px 20px;
        background-color: #c050bd;
        /* Custom button color */
        color: white;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    label[for="inputFile"]:hover {
        background-color: #a03da0;
        /* Hover effect */
    }

    /* Submit Button */
    #submitFile {
        padding: 10px 20px;
        background-color: #ffc7e9;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #submitFile:hover {
        background-color: #f95cba;
    }
</style>

<div id="navigation">
    <div id="column1">
        <div id="avatarholder">
            <img src="<?php echo $imgURL ?>" id="avatar">
            <button id="editProfile">
                <img src="../IMG/icon-edit.png" alt="">
            </button>
            <h3><?php echo $username ?></h3>
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
            <button type="button" id="dashboard" class="btnNav" data-page="admin-dashboard">
                <img src="../IMG/icon-dashboard-1.png" alt="Dashboard" style="transform: scale(0.9);">
                <p>Dashboard</p>
                <p id="show-more" class="more1"><img src="../IMG/icon-shownav.png" alt=""></p>
            </button>
            <div id="subBtn" class="sub-dashboard">
                <a href="" id="stats" class="sub-btn">
                    <img src="../IMG/icon-stats-1.png" alt="Dashboard">
                    <p>Quick Overview</p>
                    <p id="show-more"></p>
                </a>
                <a href="#card-holder" id="sales" class="sub-btn">
                    <img src="../IMG/icon-sales-1.png" alt="Dashboard" style="transform: scale(1.1);">
                    <p>Performance Activities</p>
                    <p id="show-more"></p>
                </a>
                <a href="#recent-activities" id="recent" class="sub-btn">
                    <img src="../IMG/icon-recent-1.png" alt="Dashboard" style="transform: scale(1.1);">
                    <p>Recent Activities</p>
                    <p id="show-more"></p>
                </a>
            </div>
            <button type="button" id="products" class="btnNav" data-page="admin-products">
                <img src="../IMG/icon-products-1.png" alt="Products" style="transform: scale(1.1);">
                <p>Products</p>
                <p class="show-more"></p>
            </button>
            <button type="button" id="order" class="btnNav" data-page="admin-order">
                <img id="order-img" src="../IMG/icon-orders-1.png" alt="Orders" style="transform: scale(1.02);">
                <p>Orders</p>
                <p id="show-more" class="more2"><img src="../IMG/icon-shownav.png" alt=""></p>
            </button>
            <div id="subBtn" class="sub-orders">
                <button class="sub-btn" data-status="Pending" data-page="admin-pending">
                    <img src="../IMG/icon-pending-1.png" alt="Dashboard" style="transform: scale(0.9);">
                    <p>Pending</p>
                    <p id="show-more"></p>
                </button>
                <button class="sub-btn" data-status="Delivered" data-page="admin-delivered">
                    <img src="../IMG/icon-delivered-1.png" alt="Dashboard" style="transform: scale(1.1);">
                    <p>Delivered</p>
                    <p id="show-more"></p>
                    </a>
                    <button class="sub-btn" data-status="Delivered" data-page="admin-cancelled">
                        <img src="../IMG/icon-cancelled-1.png" alt="Dashboard">
                        <p>Cancelled</p>
                        <p id="show-more"></p>
                    </button>
            </div>
            <button type="button" id="reviews" class="btnNav" data-page="admin-reviews">
                <img src="../IMG/icon-review-1.png" alt="Reviews" style="transform: scale(1.1);">
                <p>Reviews</p>
                <p id="show-more"></p>
            </button>
            <button type="button" id="queries" class="btnNav" data-page="admin-queries">
                <img src="../IMG/icon-queries-1.png" alt="Queries" style="transform: scale(0.95);">
                <p>Queries</p>
                <p id="show-more"></p>
            </button>
            <button type="button" id="perInfo" class="btnNav" data-page="admin-profile">
                <img src="../IMG/icon-info-1.png" alt="Profile">
                <p>Profile</p>
                <p id="show-more"></p>
            </button>
        </div>

        <div class="info2">
            <button id="logout">
                <img src="../IMG/icon-logout-1.png" alt="Logout">
                <a href="logout.php">Logout</a>
                <p id="show-more"></p>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownIcons = document.querySelectorAll('.info1 button'); // Get all dropdown icons
        const divDashboard = document.querySelector('.sub-dashboard'); // Get the dashboard div
        const divOrders = document.querySelector('.sub-orders'); // Get the orders div

        // Function to hide all content divs
        function hideAllDivs() {
            divDashboard.style.display = 'none'; // Hide the dashboard div
            divOrders.style.display = 'none'; // Hide the orders div
        }

        // Retrieve saved states from localStorage
        let isMessageVisible1 = localStorage.getItem('isMessageVisible1') === 'true';
        let isMessageVisible2 = localStorage.getItem('isMessageVisible2') === 'true';

        // Apply initial states based on saved data
        dropdownIcons.forEach((button) => {
            const id = button.id; // Get the ID of the button
            if (localStorage.getItem(`isMessageVisible${id}`) === 'true') {
                button.classList.add('rotated');
                // Display the corresponding content div based on saved state
                if (id === 'dashboard') {
                    divDashboard.style.display = 'flex';
                } else if (id === 'order') {
                    divOrders.style.display = 'flex';
                }
            } else {
                button.classList.remove('rotated');
            }
        });

        // Function to reset the rotation of all dropdowns
        function resetDropdownIcons() {
            dropdownIcons.forEach((button) => {
                button.classList.remove('rotated');
                localStorage.setItem(`isMessageVisible${button.id}`, 'false'); // Reset saved state
            });

            hideAllDivs(); // Hide all content divs
        }

        // Event listeners for dropdown buttons
        dropdownIcons.forEach((button) => {
            button.addEventListener('click', function() {
                const id = button.id; // Get the ID of the clicked button
                const isVisibleKey = `isMessageVisible${id}`;
                const isCurrentlyVisible = localStorage.getItem(isVisibleKey) === 'true';

                resetDropdownIcons(); // Reset all dropdowns before toggling the current one

                if (!isCurrentlyVisible) {
                    button.classList.add('rotated');
                    localStorage.setItem(isVisibleKey, 'true');

                    // Show the corresponding div based on which button was clicked
                    if (id === 'dashboard') {
                        divDashboard.style.display = 'flex'; // Show dashboard div
                    } else if (id === 'order') {
                        divOrders.style.display = 'flex'; // Show orders div
                    }
                } else {
                    button.classList.remove('rotated');
                    localStorage.setItem(isVisibleKey, 'false');
                }
            });
        });
    });
</script>

<script src="../JS/admin-dashboard.js"></script>