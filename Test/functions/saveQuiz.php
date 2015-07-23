<?php
session_start();
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


    var_dump($_POST);
    $stmt = $conn->prepare("INSERT INTO quiz (title, numOfQ,  admin_username, totalPoints, dept_id, status, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $title, $numOfQ, $admin, $totalPoints, $department, $status, $type);

    $title = $_POST["quiz-title"];
    $numOfQ = $_POST["numOfQ"];
    $admin =$_SESSION["username"];
    $totalPoints = $_POST["totalPoints"];
    $department = $_POST["department"];
    $status = "active";
    $type = $_POST["type"];

    $stmt->execute();
    $quiz_id;

    $sql = "SELECT quiz_id FROM quiz ORDER BY 1 DESC LIMIT 1";
    $result = $conn->query($sql);
     while($row = $result->fetch_assoc()) {
        $quiz_id = $row["quiz_id"];
     }
echo $quiz_id;

for($i =1; $i<= $numOfQ; $i++){
    
    $statement = $conn->prepare("INSERT INTO questions(description, points,  quiz_id) VALUES (?, ?, ?)");
    $statement->bind_param("sss", $q_desc, $q_points, $quiz_id);

    $q_desc = $_POST["q".$i."-desc"];
    $q_points =$_POST["q-points-".$i];

    echo 'question desc' . $q_desc;
    echo 'question points' . $q_points;
 $statement->execute();

 $q_id;

    $sql = "SELECT q_id FROM questions ORDER BY 1 DESC LIMIT 1";
    $result = $conn->query($sql);
     while($row = $result->fetch_assoc()) {
     	$q_id = $row["q_id"];
     }

 for($j = 1; $j <= $_POST["totalChoice".$i] ;$j++ ){
 	$statement = $conn->prepare("INSERT INTO choices(choice_desc, correct,  q_id) VALUES (?, ?, ?)");
    	$statement->bind_param("sss", $choice_desc, $correct, $q_id);

    	$choice_desc = $_POST['cvalue'.$i.'-'.$j];

    	$correct ='false';
 	$statement->execute();
 }

}

    $conn->close();
    //header('Location: ../Test.php?create=success');

   ?>

  