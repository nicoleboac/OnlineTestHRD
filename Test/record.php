<?php include 'header.php';
	if(!isset($_SESSION["username"])){
  	header('Location: index.php?loggedout=true');} ?> 

	<div class="col-md-12">
		<h1>
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
					$sql = "SELECT last_name, first_name FROM users WHERE username = '". $_GET["user"]."'";

					$rs = $conn->query($sql);
					$resultRow = $rs->fetch_assoc();
					echo $resultRow["first_name"] . " " . $resultRow["last_name"];
					?>
					</h1>
					   <table class="table table-striped table-bordered">
							<thead>
								<tr>
									<td>Title</td>
									<td>Score</td>
									<td>Percentile</td>
									<td> Classification </td>
									<td>Result</td>
								</tr>
							</thead>
							<tbody>
					
					 <?php 
					 		$sql = "SELECT username, title, score, percentile, classification, type, quiz_id from classification JOIN quiz USING (quiz_id) WHERE username = '" .$_GET["user"] ."'";

							$rs = $conn->query($sql);
							while($resultRow = $rs->fetch_assoc()) {
							echo '<tr>
									<td>'. $resultRow['title'] .'</td>
									<td>'. $resultRow['score'] .'</td>
									<td>'. $resultRow['percentile'] .'</td>
									<td>'. $resultRow['classification'] .'</td>';  
									if($resultRow["type"] == "multiple"){ echo $resultRow['score']; }
									else if($resultRow["type"] == 'complete'){ echo "N/A";}
									echo '</td>';
									if($resultRow['type'] == 'multiple'){
									echo
									'<td> <a href=viewAnswers.php?id='. $resultRow['quiz_id'] .'&user='. $_GET["user"] .'>View Result</a></td>';
									}else if($resultRow['type'] == 'complete'){
										echo '<td> <a href=viewAnswers2.php?id='. $resultRow['quiz_id'] .'&user='. $_GET["user"] .'>View Result</a></td>';
									}


								echo "</tr>";
							}
						echo 
						'
						</tbody>
						</table>';
		?>
	</div>
<?php include 'footer.php'?>