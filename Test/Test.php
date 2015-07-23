<?php include 'header.php';
	if(!isset($_SESSION["username"])){
  	header('Location: index.php?loggedout=true');} ?> 

	<div class="container">
		<?php 
			if(isset($_GET["create"]) && $_GET["create"]=="success"){
			echo '<div class="alert alert-success" role="alert"><strong>Success!</strong> You can now administer the quiz.</div>';
			}
			if(isset($_GET["failed"]) && $_GET["failed"]==true){
			echo '<div class="alert alert-danger" role="alert">Incorrect username/password</div>';
			}
			if(isset($_GET["answer"]) && $_GET["answer"]=="success"){
			echo '<div class="alert alert-success" role="alert">Answers have been recorded.</div>';
			}
			if(isset($_GET["done"]) && $_GET["done"]=="true"){
			echo '<div class="alert alert-danger" role="alert">You have already answered that Test.</div>';
			}
		  ?>
		<h1>Personnel Tests</h1>
		<p> Choose the test that has been instructed for you to take. You only have <b>fifteen minutes (15:00) </b> to finish the said test. The timer will begin as soon as you choose the test.</p>
		<table class="table table-striped table-bordered" id="">
			<thead>
				<tr>
					<td style="display:none" >#</td>
					<td>Title</td>
					<td>Number of questions</td>
					

				</tr>
			</thead>
			<tbody>
				<?php
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

					if($_SESSION["admin"] == "true" && $_SESSION["department"] == "*"){
						$sql = "SELECT quiz_id, title, totalPoints, numOfQ FROM quiz";
					}else {
						$sql = "SELECT quiz_id, title, totalPoints, numOfQ FROM quiz ";
					
					}

					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    	
					    echo '<tr>
				            	<td  style="display:none" >' . $row["quiz_id"] . '</td>
				            	<td><a href="viewQuiz.php?id=' . $row["quiz_id"] .' ">'. $row["title"] . '
					        <td>' . $row["numOfQ"] . '</td>
					        </tr>';
					    }

					}
				?>
			</tbody>
		</table>

	</div>
<?php include 'footer.php'?>