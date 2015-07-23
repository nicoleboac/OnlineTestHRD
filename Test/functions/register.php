<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";
$locationIfFail = "Location: ../index.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT username, password, email FROM users";
$result = $conn->query($sql);
$userExists = false;
$emailExists = false;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        if($row["username"] == $_POST["reg-username"]){
            $userExists = true;
        }
        if($row["email"] == $_POST["reg-emailAddress"]){
            $emailExists = true;
        }
    }

} else {
    header('Location: ../index.php');
}


if($emailExists && $userExists){
    $locationIfFail .= "?user=1&email=1";
}
else if($userExists){
    $locationIfFail .= "?user=1";
}else if($emailExists){
    $locationIfFail .= "?email=1";
}
if($userExists||$emailExists){
    header($locationIfFail."#register");
}else{
    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, dept_id, contact_no, email, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $department, $contact_no, $email, $user, $pass);
    // insert one row
    $first_name = $_POST["reg-firstname"];
    $last_name = $_POST["reg-lastname"];
    $department = $_POST["reg-dept"];
    $contact_no = $_POST["reg-contact"];
    $email = $_POST["reg-emailAddress"];
    $user = $_POST["reg-username"];
    $pass = $_POST["reg-password1"];

    echo $first_name;
    echo $last_name;
    echo $department;
    echo $contact_no;
    echo $email;
    echo $user;
    echo $pass;
    $stmt->execute();
    $conn->close();
    header("Location: ../test.php");
}
?>

