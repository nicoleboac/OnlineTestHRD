<?php include 'header.php';
	if(!isset($_SESSION["username"])){
  	header('Location: index.php?loggedout=true');} ?> 
<div id="newQuizBlock1" class="panel panel-default">
	<form  method="POST" action="functions/saveAnswers.php">
	<div id="newQuizblock2" class="panel panel-info col-md-12 col-xs-12">
		<div class="panel-heading col-md-12 col-xs-12">
		<h1 class="col-md-7 col-xs-12">
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

					$stmt = $conn->prepare("SELECT title, numOfQ, totalPoints FROM quiz WHERE quiz_id = ?");
					    $stmt->bind_param("i", $quiz_id);
					    // insert one row
					    $quiz_id = $_GET["id"];

					    $stmt->execute();
					    $stmt->store_result();
					    $stmt->bind_result($title, $numOfQ, $totalPoints);
					    $stmt ->fetch();
					     echo $title;

					     $stmt = $conn->prepare("SELECT username, last_name, first_name FROM users WHERE username = ?");
					    $stmt->bind_param("s", $user);
					    // insert one row
					    $user = $_GET["user"];
					    

					    $stmt->execute();
					    $stmt->store_result();
					    $stmt->bind_result($userN, $lastName, $firstName);
					    $stmt ->fetch();

					    $stmt = $conn->prepare("SELECT choice_ID, correct, points FROM quiz JOIN questions USING(quiz_id) JOIN choices USING(q_id) JOIN answers USING(choice_id) WHERE username = ? AND quiz_id = ? ");

					    $stmt->bind_param("si", $user, $quiz_id );

					    $stmt->execute();
					    $stmt->store_result();
					    $stmt->bind_result($choiceID, $correct, $points);
					    $x=0;
					    $totalCorrectPoints= 0;
					    while ($stmt->fetch()) {

					        $answers[$x] = $choiceID;
					        $x++;
					        if($correct == "true"){
					        	$totalCorrectPoints+= $points;
					        }
					   }

					    
		?>
		</h1>
			<div class="col-md-2  label label-info col-md-offset-1 col-xs-6"><p><span class="badge" ><?php echo $totalCorrectPoints?></span> / <span class="badge" ><?php echo $totalPoints ?></span>Points</p></div>
			<div class="col-md-2  label label-warning col-xs-6 "><p><span class="badge"><?php echo $numOfQ ?></span>question(s)</p></div>
		</div>
	</div>
	<div class="panel-body" id="tabs" >
		<h2><?php echo $firstName. " ". $lastName ?></h2>
		<div class="questions" >

			<?php
				$pageNumber = 1;
				$query = ('SELECT q_id, description, points FROM questions WHERE quiz_id = "'.mysqli_real_escape_string($conn, $quiz_id).'"');
					    $questionResults = mysqli_query($conn, $query) ;
					    $x = 0;
					    while($questionRow = mysqli_fetch_assoc($questionResults))
						{
						$x++;
						echo 
				  		'<div id="tabs-'.$x.'" class="panel panel-warning activeQuestion question row">
							<div class="panel-heading col-md-12 col-xs-12"><h2 class=" newQuizHeader3 col-xs-12" >' . $questionRow['description'] . '</h2> 
								<p class=" col-md-2 col-xs-12 text-center"><span class="badge">' . $questionRow['points'] . '</span>Point</p>
							</div>
							';
							$query = ('SELECT choice_id, choice_desc, correct FROM choices WHERE q_id = "'.mysqli_real_escape_string($conn, $questionRow['q_id']).'"');
							$choicesResults = mysqli_query($conn, $query) ;
							while($choicesRow = mysqli_fetch_assoc($choicesResults))
								{
									echo 
							'<div class="input-group col-md-6 col-xs-12 col-md-offset-1 vert-offset-top-1" name="">
						      		<label>
						        		<input type="radio" aria-label="..."'; 
						        		$notFound = true; 

						        		for($i = 0; $i < count($answers); $i++){ 
						        			if($choicesRow['choice_id'] == $answers[$i] ) {
						        				echo ' checked ';
						        				$notFound = false;
						        				break;
						        			}
						        			
						        		}
						        		if($notFound){
						        		echo "style = 'visibility:hidden'";
						        			}
						        		echo 'class="radioChoice target" name="choice'. $x . '" value="'. $choicesRow['choice_id'].'">
						      			' . $choicesRow['choice_desc'] ;

						      			if( $choicesRow['correct'] == "true"){
						      				echo '<span class="glyphicon glyphicon-ok-circle text-success" aria-hidden="true"></span>';
						      			}

						      			echo '
						    	</div><!-- /input-group -->';
							
								}
				  		echo '
				  		</div>';
				}

				?>
		</div>

  	</div>
  	</form>
</div>

<script src="js/viewQuiz.js"></script>
<?php include 'footer.php' ?>