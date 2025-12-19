<?php
include "../Database/db.php";

$user_id = $_SESSION['user'];

// Use a prepared statement to prevent SQL injection
$query = "SELECT firstname, lastname, email FROM tbl_user WHERE user_id = ?";
$stmt = $connection->prepare($query);

if ($stmt) {
    // Bind the user_id parameter
    $stmt->bind_param('i', $user_id); // Assuming user_id is an integer
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $name = "{$row['firstname']} {$row['lastname']}";
        $email = $row['email'];
    } else {
        die("User not found.");
    }

    $stmt->close();
} else {
    die("Database query failed.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        .home4 {
            background-color: white;
            height: auto;
            display: flex;
            align-items: center;
        }

        .home4 .home42 {
            width: 45%;
        }

        .home4 .home41 {
            width: 55%;
            height: auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 0;
        }

        .home4 .home41 h4 {
            width: 50%;
            font-weight: bold;
            font-size: 20px;
            padding-bottom: 30px;
        }

        .home4 .home41 h1 {
            width: 60%;
            font-size: 45px;
            font-family: apricot;
            color: #B91EB3;
            margin: 0;
        }

        .home4 .home41 h4,
        .home4 .home41 p {
            color: #B91EB3;
            margin: 0;
        }

        .home4 .home41 p {
            width: 90%;
            font-size: 1.1rem;
            line-height: 30px;
            letter-spacing: 1px;
            font-family: 'Open Sans';
        }

        .home4 .home42 form {
            margin: 80px 80px 80px 50px;
            border-radius: 13px;
            padding: 30px;
            background-color: #fa8bce3d;
        }

        .home4 .home42 form input::placeholder {
            color: #7e047a;
            opacity: 0.8;
        }

        .home4 .home42 form input,
        .home4 .home42 form textarea {
            font-family: 'Open Sans';
            width: 100%;
            margin: 5px 0;
            color: #B91EB3;
            border-radius: 8px;
            padding: 20px 15px;
            border: 0.5px solid #fa8bceb3;
        }

        #concern {
            height: auto;
            padding: 15px 15px;
            box-sizing: border-box;
            resize: none;
        }

        #concern::placeholder {
            color: #7e047a;
            opacity: 0.8;
            font-family: 'Open Sans';
        }

        .home4 .home42 form input:focus,
        #concern:focus {
            outline: none;
        }

        .home4 .home42 form input:focus::placeholder,
        #concern:focus::placeholder {
            opacity: 0;
        }

        .home4 .home42 form button {
            margin-top: 7px;
            text-transform: uppercase;
            letter-spacing: 1px;
            background-color: #FA8BCE;
            color: white;
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px;
            cursor: pointer;
        }

        .home4 .home42 form button:hover {
            opacity: 0.8;
        }

        @media (max-width: 1100px) {
            .home4 {
                width: 100%;
                display: block;
                height: auto;
            }

            .home4 .home41,
            .home4 .home42 {
                width: 100%;
            }

            .home4 .home41 h1 {
                width: 100%;
                margin-top: 30px;
                font-size: 35px;
            }

            .home4 .home41 h4 {
                width: 100%;
                margin: 0;
            }

            .home4 .home41 p {
                font-size: 1rem;
            }

            .home4 .home42 form {
                margin: 40px 180px;
            }

            .home4 .home42 form input {
                font-family: 'Open Sans';
                font-size: 0.8rem;
                padding: 13px 10px;
            }

            #concern {
                height: auto;
                font-size: 0.8rem;
                padding: 13px 10px;
                box-sizing: border-box;
                resize: none;
            }
        }

        @media (max-width: 900px) {
            .home4 .home42 form {
                margin: 40px 120px;
            }
        }

        @media (max-width: 686px) {
            .home4 .home42 form {
                margin: 30px 70px;
                padding: 27.5px;
            }

            .home4 .home42 form input {
                font-family: 'Open Sans';
                font-size: 0.8rem;
                padding: 13px 10px;
            }

            #concern {
                height: auto;
                font-size: 0.8rem;
                padding: 13px 10px;
                box-sizing: border-box;
                resize: none;
            }
        }

        @media (max-width: 486px) {
            .home4 .home41 h1 {
                width: 100%;
                display: inline-block;
                margin-top: 30px;
                font-size: 1.8rem;
            }

            .home4 .home41 h4 {
                width: 100%;
                display: inline-block;
                margin: 0;
            }

            .home4 .home41 p {
                font-size: 0.9rem;
                margin: 0 20px;
            }

            .home4 .home42 form {
                margin: 50px 50px;
                padding: 25px;
            }

            .home4 .home42 form input {
                font-family: 'Open Sans';
                font-size: 0.8rem;
                padding: 10px 8px;
            }

            #concern {
                height: auto;
                font-size: 0.8rem;
                padding: 8px 8px;
                box-sizing: border-box;
                resize: none;
            }

            #concern::placeholder {
                color: #7e047a;
                opacity: 0.8;
                font-family: 'Open Sans';
            }

            .home4 .home42 form button {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        // Default subject if none provided
        $subject = isset($_POST['subject']) && !empty($_POST['subject']) ? mysqli_real_escape_string($connection, $_POST['subject']) : "No Subject";

        // Sanitize message input
        $message = nl2br(htmlspecialchars(mysqli_real_escape_string($connection, $_POST['message'])));

        // Insert query
        $query1 = "INSERT INTO tbl_queries (user_id, subject, query_text) VALUES ($user_id, '$subject', '$message')";

        // Execute query and handle feedback
        if (mysqli_query($connection, $query1)) {
            echo "<script>alert('Your message has been sent successfully.');</script>";
        } else {
            echo "<script>alert('There was an error sending your message. Please try again later.');</script>";
        }
    }
    ?>
    <div class="home4">
        <div class="home41">
            <h1>Contact Us</h1>
            <h4>___________</h4>
            <p>Thank you for your interest in our products and services. For any concerns and queries, please fill out the form below.</p>
        </div>

        <div class="home42">
            <form action="" method="post">
                <center>
                    <input type="text" id="name" placeholder="Full name" value="<?php echo htmlspecialchars($name); ?>" style="cursor: default;" readonly><br>
                    <input type="email" id="email" placeholder="Email address" value="<?php echo htmlspecialchars($email); ?>" style="cursor: default;" readonly><br>
                    <input type="text" name="subject" placeholder="Subject of inquiry"><br>
                    <textarea name="message" rows="4" cols="50" id="concern" placeholder="Your message" required></textarea><br>
                    <button type="submit" name="submit">Submit</button>
                </center>
            </form>
        </div>
    </div>
</body>

</html>