<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// prepare and bind
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $pass, $user);


// insert one row
    $user = $_SESSION["username"];
    $pass = $_POST["new-password-1"];
    
    $stmt->execute();
header('Location: ../changepassword.php?success=true');
$conn->close();
?>