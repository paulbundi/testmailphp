<?php
// Security measures
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Form data
$name = sanitize_input($_POST['name']);
$email = sanitize_input($_POST['email']);
$message = sanitize_input($_POST['message']);

// Email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email address');
}

// Attachment handling (optional)
$attachment = $_FILES['attachment'];
if (!empty($attachment['tmp_name'])) {
    // Validate file type, size, etc.
    // Move file to a temporary directory
}

// Email content
$to = 'recipient@example.com';
$subject = 'Contact Form Submission';
$headers = 'From: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'Content-Type: text/html; charset=UTF-8';

$message_html = '<html><body>' .
    '<h2>Contact Form Submission</h2>' .
    '<p>Name: ' . $name . '</p>' .
    '<p>Email: ' . $email . '</p>' .
    '<p>Message: ' . $message . '</p>';

if (!empty($attachment)) {
    $message_html .= '<p>Attachment: <a href="attachment_path">Download</a></p>';
}

$message_html .= '</body></html>';

// Send email using a reliable library (recommended)
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'your_smtp_host';
$mail->SMTPAuth = true;
$mail->Username = 'your_username';
$mail->Password = 'your_password';
$mail->SMTPSecure = 'tls'; // or 'ssl'
$mail->Port = 587; // or 465

$mail->setFrom($email, $name);
$mail->addAddress($to);
$mail->Subject = $subject;
$mail->Body = $message_html;

if (!$mail->send()) {
    echo 'Error sending email: ' . $mail->ErrorInfo;
} else {
    echo 'Email sent successfully!';
}

?>
