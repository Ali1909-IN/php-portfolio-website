<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

require_once '../config/database.php';
require_once '../includes/functions.php';

// Validate input
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Basic spam protection
if (strlen($message) > 5000) {
    echo json_encode(['success' => false, 'message' => 'Message too long']);
    exit;
}

// Rate limiting (simple implementation)
session_start();
$now = time();
$lastSubmission = $_SESSION['last_contact_submission'] ?? 0;

if ($now - $lastSubmission < 60) { // 1 minute cooldown
    echo json_encode(['success' => false, 'message' => 'Please wait before sending another message']);
    exit;
}

$data = [
    'name' => $name,
    'email' => $email,
    'subject' => $subject,
    'message' => $message
];

// Try to send email
if (sendContactEmail($data)) {
    $_SESSION['last_contact_submission'] = $now;
    echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to send message. Please try again later.']);
}
?>