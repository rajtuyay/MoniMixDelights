<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <?php session_start();
    include "../Database/db.php";
    $user_id = $_SESSION['user'];

    $query1 = "SELECT user_id 
              FROM tbl_user
              WHERE user_id = '$user_id'";
    $result1 = mysqli_query($connection, $query1);
    $row1 = mysqli_fetch_assoc($result1);
    $user_id = $row1['user_id'];
    $statusMsg = '';

    // File upload path
    $targetDir = "../IMG/Profile-Image/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $query = "UPDATE tbl_user SET display_photo = ? WHERE user_id = ?";

                // Prepare the statement
                $stmt = $connection->prepare($query);

                // Bind parameters to the query (s = string, i = integer)
                $stmt->bind_param('si', $fileName, $user_id); // 'si' means the first parameter is a string and the second is an integer

                // Execute the query
                if ($stmt->execute()) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                    header('location: profile.php?page=personal-information');
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    ?>
</body>

</html>