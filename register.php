<?php
ob_start(); // Starting output buffering

include('dbconnection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Checking if all fields are filled
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['full_name']) || empty($_POST['username'])) {
        echo "Please fill in all fields.";
        exit;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    // Checking if the email or username already exists
    $stmt = $conn->prepare("SELECT * FROM Users_Recipe WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email or username already exists. Please try again with a different email or username.";
        $stmt->close();
        $conn->close();
        exit;
    }

    // Preparing the SQL statement
    $stmt = $conn->prepare("INSERT INTO Users_Recipe (email, password, full_name, username) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $hashed_password, $full_name, $username);

    if ($stmt->execute()) {
        // Clearing the output buffer
        ob_end_clean();
        echo "Registration successful.";
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


