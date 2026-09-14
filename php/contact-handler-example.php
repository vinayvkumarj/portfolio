<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    exit;
}

// 1. Verify PHPMailer files exist
$phpmailerDir = __DIR__ . '/PHPMailer/src/';
if (!file_exists($phpmailerDir . 'PHPMailer.php')) {
    echo json_encode([
        'success' => false,
        'error' => 'PHPMailer files are missing inside php/PHPMailer/src/ directory.'
    ]);
    exit;
}

require $phpmailerDir . 'Exception.php';
require $phpmailerDir . 'PHPMailer.php';
require $phpmailerDir . 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 2. Extract & Sanitize Input
$name    = isset($_POST['name'])    ? trim($_POST['name'])    : '';
$email   = isset($_POST['email'])   ? trim($_POST['email'])   : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Please fill out all fields with valid information.']);
    exit;
}

// 3. Configure Gmail SMTP
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your-actual-email@gmail.com'; // YOUR GMAIL ADDRESS
    $mail->Password   = 'xxxx xxxx xxxx xxxx';          // YOUR 16-CHAR GMAIL APP PASSWORD
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Sender & Recipient (Both your Gmail)
    $mail->setFrom('your-actual-email@gmail.com', 'Portfolio Contact');
    $mail->addAddress('your-actual-email@gmail.com');

    // Clicking "Reply" in Gmail will reply directly to the visitor's email address
    $mail->addReplyTo($email, $name);

    // Email Content
    $mail->isHTML(false);
    $mail->Subject = '[Portfolio Contact] New message from ' . $name;
    $mail->Body    = "You received a new message from your portfolio contact form:\n\n"
        . "Name: $name\n"
        . "Email: $email\n\n"
        . "Message:\n$message";

    $mail->send();

    echo json_encode([
        'success' => true,
        'message' => 'Message sent — thanks, I\'ll get back to you soon.'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Mailer Error: ' . $mail->ErrorInfo
    ]);
}
