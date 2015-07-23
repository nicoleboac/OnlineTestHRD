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

if($_POST["type"] == 'multiple'){
for($i = 1, $totalQ = $_POST["numOfQ"]; $i <= $totalQ; $i++ ){
    if(isset($_POST["choice".$i])){
        $stmt = $conn->prepare("INSERT INTO answers (username, choice_id, quizid) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $choice, $quizID);
        $user = $_SESSION["username"];
        $choice =  $_POST["choice".$i];
        $quizID =  $_POST["quizID"];

        echo $user." ".$choice;
        $stmt->execute();
    }
}

        $stmt = $conn->prepare("SELECT  totalPoints FROM choices JOIN answers USING(choice_id) JOIN questions USING(q_id) JOIN quiz USING(quiz_id) WHERE quiz_id = ? and username = ? LIMIT 1");
        $stmt->bind_param("ss", $quizID, $user);
        
        

        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $totalPoints);
        $stmt->fetch();

        $stmt = $conn->prepare("SELECT correct, points  FROM choices JOIN answers USING(choice_id)  JOIN questions USING(q_id)WHERE quiz_id = ? and username = ?");
        $stmt->bind_param("ss", $quizID, $user);
        
         $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($correct, $points);
        $x=0;
        $totalCorrectPoints= 0;
        while ($stmt->fetch()) {
            if($correct == "true"){
                $totalCorrectPoints+= $points;
            }
        }

        $stmt = $conn->prepare("INSERT INTO results (quiz_id, username,  score, total) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $quizID, $user, $totalCorrectPoints, $totalPoints);
        
         $stmt->execute();
}else {
    var_dump($_POST);
    $stmt = $conn->prepare("SELECT  q_id FROM questions WHERE quiz_id = ?");
        $stmt->bind_param("s", $quizID);
        
        $quizID = $_POST["quizID"];
        echo $quizID;
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $questionID);
        var_dump($stmt);
        $i = 1;
        while ($stmt->fetch()) {
                echo 'question '.$questionID;
                if(isset($_POST["choice".$i])){
                    $statement = $conn->prepare("INSERT INTO answers2 (usern, answer, questionid) VALUES (?, ?, ?)");
                    $statement->bind_param("sss", $user, $choice, $qID);
                    $user = $_SESSION["username"];
                    $choice =  $_POST["choice".$i];
                    $qID =  $questionID;

                    echo $user." ".$choice;
                    $statement->execute();
                }
                $i++;
        }

         $stmt = $conn->prepare("SELECT  totalPoints FROM  quiz  WHERE quiz_id = ?");
        $stmt->bind_param("s", $quizID);
        
        

        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $totalPoints);
        $stmt->fetch();

        var_dump($totalPoints);
        $stmt = $conn->prepare("INSERT INTO results (quiz_id, username,  score, total) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $quizID, $user, $totalCorrectPoints, $totalPoints);
        
        $totalCorrectPoints = -1;
         $stmt->execute();

}


    $conn->close();
    header("Location: ../success.php")

   ?>