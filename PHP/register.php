<?php
include "../Database/db.php";
$message = "";
$contact = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $fname = $_POST['firstname'];
        $mname = $_POST['middlename'];
        $lname = $_POST['lastname'];
        $age = $_POST['age'];
        $username = $_POST['username'];
        $password = $_POST['password']; // Get password from form input
        $email = $_POST['email'];
        $contact = $_POST['contact'];

        // Strong password check
        if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            $message = "Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a digit, and a special character.";
        } else {
            // Hash the password if it's strong
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Begin transaction
            mysqli_begin_transaction($connection);

            try {
                // Insert into tbl_profile
                $query = "INSERT INTO tbl_user (email, password, firstname, middlename, lastname, age, username, contact_no) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "sssssiss", $email, $hashedPassword, $fname, $mname, $lname, $age, $username, $contact);
                mysqli_stmt_execute($stmt);

                // Commit transaction
                mysqli_commit($connection);

                $message = "New Record Created Successfully";

                $query1 = "SELECT user_id FROM tbl_user ORDER BY user_id DESC LIMIT 1";
                $result1 = mysqli_query($connection, $query1);
                $row1 = mysqli_fetch_assoc($result1);

                $user = $row1['user_id'];
                $query2 = "INSERT INTO tbl_wallet (balance,user_id) VALUES (0,$user)";
                $result2 = mysqli_query($connection, $query2);
            } catch (Exception $e) {
                // Rollback transaction on error
                mysqli_rollback($connection);
                $message = "Failed to create record: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/userAuth.css" type="text/css">
    <link rel="stylesheet" href="../CSS/font.css" type="text/css">
    <title>Register</title>
    <script>
        // JavaScript for strong password validation
        function validatePassword() {
            var password = document.getElementById("password").value;
            var message = document.getElementById("passwordMessage");
            var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (!regex.test(password)) {
                message.style.color = "red";
                message.innerHTML = "Min. 8 characters, 1 uppercase, 1 number, 1 special char.";
            } else {
                message.style.color = "green";
                message.innerHTML = "Strong password!";
            }
        }
    </script>
</head>

<body class="register">
    <div class="desktop-logo" style="margin: 10px 0;">
        <img src="../IMG/logo-monimix.png" width="60" height="60" style="margin-top: 10px;">
        <img src="../IMG/brand-name-monimix-nobg.png" width="100" height="50" style="padding-bottom: 10px;">
    </div>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#" class="form-register" method="post">
                <div class="mobile-logo" style="margin: 10px 0; text-align: center;">
                    <img src="../IMG/logo-monimix.png" width="60" height="60" style="margin-top: 10px;">
                    <img src="../IMG/brand-name-monimix-nobg.png" width="100" height="50" style="padding-bottom: 10px;">
                </div>
                <h2>Sign Up</h2>
                <center style="color: black;"><?php echo $message; ?></center>
                <div class="register-container">
                    <div class="register-left">
                        <label>First Name</label>
                        <input type="text" name="firstname" placeholder="Enter firstname" required />
                        <label>Middle Name (Optional)</label>
                        <input type="text" name="middlename" placeholder="Enter middlename" />
                        <label>Last Name</label>
                        <input type="text" name="lastname" placeholder="Enter lastname" required />
                        <label>Age</label>
                        <input type="number" name="age" placeholder="Enter age" required />
                    </div>
                    <div class="register-right">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Enter username" required />
                        <label>Email</label>
                        <input type="email" name="email" placeholder="monimix@gmail.com" required />
                        <label>Password</label>
                        <span id="passwordMessage"></span>
                        <input type="password" id="password" name="password" placeholder="Enter password" required
                            onkeyup="validatePassword()" />
                        <label>Contact No.</label>
                        <input type="tel" id="contact" name="contact"
                            placeholder="09XX-XXX-XXXX"
                            pattern="^(09\d{2}-?\d{3}-?\d{4}|(\+639)\d{2}-?\d{3}-?\d{4})$"
                            title="Please enter a valid mobile number (e.g., 0912-345-6789 or +63912-345-6789)" required>
                    </div>
                </div>
                <button type="submit" name="submit">Register</button>
                <center>
                    <p>Already have an account? <a href="login.php" style="color: #B91EB3">Login Here</a></p>
                </center>
            </form>
        </div>
    </div>
</body>

</html>