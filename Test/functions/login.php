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

$sql = "SELECT username, password, admin, dept_id FROM users";
$result = $conn->query($sql);
$flag = false;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	
        if($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]){
        	// Set session variables
		$_SESSION["username"] = $row["username"];
		$_SESSION["password"] =  $row["password"];
		$_SESSION["admin"] = $row["admin"];

                                if($row["admin"] == "true" && $row["dept_id"] == null){
                                    $_SESSION["department"] = "*";
                                }else{
                                    $_SESSION["department"] = $row["dept_id"];
                                }
        if($_SESSION["admin"] == 'false'){
        header('Location:  ../test.php');
        
        }else if($_SESSION["admin"] == 'dept'){

        header('Location:  ../ApplicantDept.php');
        
        } else 
            header('Location:  ../applicants.php');

		$flag = true;
		break;
        }else{
        	$flag = false;
        }
        
    }
    if($flag == false){
    		header('Location: ../index.php?failed=true');
        }

} else {
    //header('Location: index.php');
}
$conn->close();
?>