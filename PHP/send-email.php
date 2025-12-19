<?php session_start();
$queries = isset($_GET['query']) ? intval($_GET['query']) : 0;
include "../Database/db.php";
if (isset($_POST['reply'])) {
    $reply = $_POST['message'];
    $adminQuery = "UPDATE tbl_queries SET query_reply = ? WHERE query_id = ?";
    $stmt = $connection->prepare($adminQuery);
    $stmt->bind_param(
        'si',
        $reply,
        $queries
    );
    if ($stmt->execute()){
        echo "Success";
    } else {
        echo "There's a problem updating the reply";
    }
}
?>

<?php
// Include the PHPMailer files
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Use PHPMailer classes outside the function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$userEmail = $_POST['user_email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Set mailer to use SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'monimixdelights@gmail.com'; // Your Gmail address
    $mail->Password = 'ewyg ladk mtyw kkyd'; // Your Gmail app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Set sender and recipient details
    $mail->setFrom('monimixdelights@gmail.com', 'MoniMix Delights');
    $mail->addAddress($userEmail); // Recipient's email

    // Set email format to HTML
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = nl2br($message);

    // Send email
    $mail->send();
    echo '<script>alert("Message has been sent");</script>';
} catch (Exception $e) {
    echo "<script>alert('Message could not be sent. The email address is invalid or does not exist in our records. Please check the user's details and try again.')</script>";
}

if (isset($_SERVER['HTTP_REFERER'])) {
    echo '<script>history.back(); setTimeout(() => location.reload(), 500);</script>';
    // Use JavaScript to redirect after showing the alert
    exit;
} else {
    echo '<script>history.back(); setTimeout(() => location.reload(), 500);</script>';
    // If there's no referer, you can redirect to a default page
    exit;
}

?>