<?php
// Career Form Handler - Direct Email Sending
// No third-party services required

// Set headers to prevent caching
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// Get form data
$fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$position = isset($_POST['position']) ? trim($_POST['position']) : '';
$experience = isset($_POST['experience']) ? trim($_POST['experience']) : '';
$location = isset($_POST['location']) ? trim($_POST['location']) : '';
$qualification = isset($_POST['qualification']) ? trim($_POST['qualification']) : '';
$psara = isset($_POST['psara']) ? trim($_POST['psara']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate required fields
if (empty($fullName) || empty($email) || empty($phone) || empty($position)) {
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

// Handle file upload
$resume_path = '';
$resume_name = '';
if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
    $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $max_size = 5 * 1024 * 1024; // 5MB
    
    $file_type = $_FILES['resume']['type'];
    $file_size = $_FILES['resume']['size'];
    $file_name = $_FILES['resume']['name'];
    
    // Validate file type
    if (!in_array($file_type, $allowed_types)) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid file type. Please upload PDF, DOC, or DOCX files only.'
        ]);
        exit;
    }
    
    // Validate file size
    if ($file_size > $max_size) {
        echo json_encode([
            'success' => false,
            'message' => 'File size exceeds 5MB. Please upload a smaller file.'
        ]);
        exit;
    }
    
    // Create uploads directory if it doesn't exist
    $upload_dir = 'uploads/resumes/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    // Generate unique filename
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $unique_filename = time() . '_' . uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $fullName) . '.' . $file_extension;
    $resume_path = $upload_dir . $unique_filename;
    $resume_name = $file_name;
    
    // Move uploaded file
    if (!move_uploaded_file($_FILES['resume']['tmp_name'], $resume_path)) {
        echo json_encode([
            'success' => false,
            'message' => 'Error uploading file. Please try again.'
        ]);
        exit;
    }
}

// Email configuration
$to = 'aadityakum123@gmail.com';
$subject = 'New Career Application - Expert Security Services';

// Create email body
$email_body = "New Career Application Received\n\n";
$email_body .= "Full Name: " . htmlspecialchars($fullName) . "\n";
$email_body .= "Email: " . htmlspecialchars($email) . "\n";
$email_body .= "Phone: " . htmlspecialchars($phone) . "\n";
$email_body .= "Position Applied For: " . htmlspecialchars($position) . "\n";
$email_body .= "Years of Experience: " . htmlspecialchars($experience) . "\n";
$email_body .= "Preferred Location: " . htmlspecialchars($location) . "\n";
$email_body .= "Educational Qualification: " . htmlspecialchars($qualification) . "\n";
$email_body .= "PSARA License: " . htmlspecialchars($psara) . "\n";
$email_body .= "Cover Letter:\n" . htmlspecialchars($message) . "\n";
if ($resume_name) {
    $email_body .= "Resume: " . htmlspecialchars($resume_name) . " (attached)\n";
    $email_body .= "Resume Path: " . $resume_path . "\n";
}
$email_body .= "\n---\n";
$email_body .= "Submitted on: " . date('Y-m-d H:i:s') . "\n";

// Email headers
$headers = "From: Expert Security Services <noreply@expertsecurity.com>\r\n";
$headers .= "Reply-To: " . htmlspecialchars($email) . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Attach resume if uploaded
$attachment_path = '';
if ($resume_path && file_exists($resume_path)) {
    $attachment_path = $resume_path;
}

// Send email (with attachment if available)
if ($attachment_path) {
    // For emails with attachments, we need to use multipart MIME
    $boundary = md5(time());
    $headers = "From: Expert Security Services <noreply@expertsecurity.com>\r\n";
    $headers .= "Reply-To: " . htmlspecialchars($email) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";
    
    $email_content = "--{$boundary}\r\n";
    $email_content .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $email_content .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $email_content .= $email_body . "\r\n\r\n";
    
    // Attach file
    $file_content = file_get_contents($attachment_path);
    $file_content = chunk_split(base64_encode($file_content));
    $file_type = mime_content_type($attachment_path);
    
    $email_content .= "--{$boundary}\r\n";
    $email_content .= "Content-Type: {$file_type}; name=\"{$resume_name}\"\r\n";
    $email_content .= "Content-Transfer-Encoding: base64\r\n";
    $email_content .= "Content-Disposition: attachment; filename=\"{$resume_name}\"\r\n\r\n";
    $email_content .= $file_content . "\r\n";
    $email_content .= "--{$boundary}--\r\n";
    
    $mail_sent = mail($to, $subject, $email_content, $headers);
} else {
    $mail_sent = mail($to, $subject, $email_body, $headers);
}

if ($mail_sent) {
    // Send auto-reply to user
    $auto_reply_subject = 'Thank you for your application - Expert Security Services';
    $auto_reply_body = "Dear " . htmlspecialchars($fullName) . ",\n\n";
    $auto_reply_body .= "Thank you for your interest in joining Expert Security Services!\n\n";
    $auto_reply_body .= "We have received your application for the position of " . htmlspecialchars($position) . " and will review it shortly.\n\n";
    $auto_reply_body .= "We will contact you soon if your profile matches our requirements.\n\n";
    $auto_reply_body .= "Best regards,\n";
    $auto_reply_body .= "Expert Security Services\n";
    $auto_reply_body .= "Phone: +91 9731731488 | 08029918480\n";
    $auto_reply_body .= "Email: info@expertsecurity.com\n";
    
    $auto_reply_headers = "From: Expert Security Services <noreply@expertsecurity.com>\r\n";
    $auto_reply_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    mail($email, $auto_reply_subject, $auto_reply_body, $auto_reply_headers);
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your application! We have received your resume and will review it shortly. We will contact you soon if your profile matches our requirements.'
    ]);
} else {
    // Clean up uploaded file if email failed
    if ($resume_path && file_exists($resume_path)) {
        unlink($resume_path);
    }
    
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error submitting your application. Please try again later or contact us directly.'
    ]);
}
?>
