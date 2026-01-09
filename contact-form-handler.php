<?php
// Contact Form Handler - Direct Email Sending
// No third-party services required

// Set headers to prevent caching
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// Get form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$service = isset($_POST['service']) ? trim($_POST['service']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate required fields
if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all required fields.'
    ]);
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please enter a valid email address.'
    ]);
    exit;
}

// Email configuration
$to = 'aadityakum123@gmail.com';
$subject = 'New Contact Form Submission - Expert Security Services';

// Create email body
$email_body = "New Contact Form Submission\n\n";
$email_body .= "Name: " . htmlspecialchars($name) . "\n";
$email_body .= "Email: " . htmlspecialchars($email) . "\n";
$email_body .= "Phone: " . htmlspecialchars($phone) . "\n";
$email_body .= "Service Required: " . htmlspecialchars($service) . "\n";
$email_body .= "Message:\n" . htmlspecialchars($message) . "\n";
$email_body .= "\n---\n";
$email_body .= "Submitted on: " . date('Y-m-d H:i:s') . "\n";

// Email headers
$headers = "From: Expert Security Services <noreply@expertsecurity.com>\r\n";
$headers .= "Reply-To: " . htmlspecialchars($email) . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
$mail_sent = mail($to, $subject, $email_body, $headers);

if ($mail_sent) {
    // Send auto-reply to user
    $auto_reply_subject = 'Thank you for contacting Expert Security Services';
    $auto_reply_body = "Dear " . htmlspecialchars($name) . ",\n\n";
    $auto_reply_body .= "Thank you for contacting Expert Security Services!\n\n";
    $auto_reply_body .= "We have received your message and will get back to you soon.\n\n";
    $auto_reply_body .= "Best regards,\n";
    $auto_reply_body .= "Expert Security Services\n";
    $auto_reply_body .= "Phone: +91 9731731488 | 08029918480\n";
    $auto_reply_body .= "Email: info@expertsecurity.com\n";
    
    $auto_reply_headers = "From: Expert Security Services <noreply@expertsecurity.com>\r\n";
    $auto_reply_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    mail($email, $auto_reply_subject, $auto_reply_body, $auto_reply_headers);
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for contacting us! We have received your message and will get back to you soon.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error sending your message. Please try again later or contact us directly.'
    ]);
}
?>
