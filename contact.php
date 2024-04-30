<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Email information
    $to = "khalidnganga5@gmail.com";
    $subject = "Contact Form Submission";
    $body = "Name: $name\nEmail: $email\n\n$message";

    // Send email
    if (mail($to, $subject, $body)) {
        header("Location: thank you.html"); // Redirect to thank you page
        exit();
    } else {
        echo "Error sending email.";
    }
}
?>
