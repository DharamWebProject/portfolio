<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate data
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Check if any field is empty or email is invalid
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please fill all fields correctly.";
        exit;
    }

    // Your email where you want to receive messages
    $to = "dharmendra.karma@gmail.com";

    // Email subject and body
    $email_subject = "Contact Form: $subject";
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    $headers = "From: $email";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Sorry, there was a problem sending your message.";
    }
} else {
    echo "Invalid request.";
}
?>
