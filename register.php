
<?php
// Include database connection
require_once "database.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email and password from form submission
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL statement to insert the user into the database
    // Assuming you have a table named 'Users' with columns 'UserName' and 'Password'
    // and you're using MySQLi for database interaction
    $query = "INSERT INTO Users (UserName, Password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);

    // Check if the prepare() call was successful
    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $hashedPassword);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "User registered successfully.";
    } else {
        echo "Error registering user.";
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect user to the registration form if accessed directly
    header("Location: registration_form.html");
    exit;
}

// Close the database connection
$conn->close();
?>
