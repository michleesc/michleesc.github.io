<?php
// Pastikan form menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Alamat email tujuan
    $to = "michlee.septian.c@gmail.com";

    // Mengambil data dari form
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validasi sederhana
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Header email
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // Isi email
    $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Contact Email</title></head><body>";
    $body .= "<h2>New Message from Website</h2>";
    $body .= "<p><strong>Name:</strong> {$name}</p>";
    $body .= "<p><strong>Email:</strong> {$email}</p>";
    $body .= "<p><strong>Subject:</strong> {$subject}</p>";
    $body .= "<p><strong>Message:</strong></p>";
    $body .= "<p>{$message}</p>";
    $body .= "</body></html>";

    // Mengirim email
    if (mail($to, $subject, $body, $headers)) {
        echo "Email sent successfully. Thank you for contacting us!";
    } else {
        echo "Failed to send email. Please try again later.";
    }
} else {
    echo "Access denied.";
}