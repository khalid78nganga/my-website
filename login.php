<?php
session_start();

// Include database connection file
include_once "database.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query the database to fetch user information
    $query = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Authentication successful
        // Store user information in session
        $_SESSION["user"] = $user;

        // Redirect to index.html
        header("Location: index.html");
        exit;
    } else {
        // Authentication failed
        // Redirect back to login.html with error message
        header("Location: login.html?error=invalid_credentials");
        exit;
    }
}
?>
