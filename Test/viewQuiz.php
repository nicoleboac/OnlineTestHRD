<?php include 'header.php';
	if(!isset($_SESSION["username"])){
  	header('Location: index.php?loggedout=true');} ?> 
<div id="newQuizBlock1" class="panel panel-default">
	<form  method="POST" id="form"

	<?php 
		if($_SESSION['admin']=="true" && $_SESSION['department'] == "*") {
			echo  ' onsubmit="alert('.'"This is for viewing purposes only'.'")"';
		}else{
			echo ' action="functions/saveAnswers.php"';
		}
	 ?>
	 >
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
					$stmt = $conn->prepare("SELECT result_id FROM results WHERE username = ? && quiz_id =?");
					    $stmt->bind_param("si", $user, $quiz_id);
					    // insert one row
					    $quiz_id = $_GET["id"];
					    $user = $_SESSION["username"];

					    $stmt->execute();
					    $stmt->store_result();
					    $stmt->bind_result($result_id);
					    $stmt ->fetch();

					    if($result_id != null){
					    	header('Location: test.php?done=true');
					    }

					$stmt = $conn->prepare("SELECT title, numOfQ, totalPoints, type FROM quiz WHERE quiz_id = ?");
					    $stmt->bind_param("i", $quiz_id);
					    // insert one row
					    

					    $stmt->execute();
					    $stmt->store_result();
					    $stmt->bind_result($title, $numOfQ, $totalPoints, $type);
					    $stmt ->fetch();
					     echo $title;

					    


					    
		?>
		</h1>
			<input type="hidden" name="type" value=<?php echo $type?>>
			<input type="hidden" name="quizID" value=<?php echo " '".$_GET['id']."'" ?> >
			<div class="col-md-2  label label-info col-md-offset-1 col-xs-6"><p><span class="badge" ><?php echo $totalPoints ?></span>Points</p></div>
			<div class="col-md-2  label label-warning col-xs-6 "><p><span class="badge"><?php echo $numOfQ ?></span>question(s)</p></div>
			<input type="hidden" name="numOfQ" value =" <?php echo $numOfQ ?> " >
		</div>
	</div>
	<div class="panel-body" id="tabs" >
		<?php
		if($type ==  "multiple"){
					    	echo '<p> Choose the correct answer <p>';

					    }else if ($type ==  "complete"){
							echo '<p> On the following items are fifty partial sentences. Complete each one. Answer quickly.';
						}
		?>
		<span>Question number:</span>
		<div class="btn-group" role="group" aria-label="...">
			<ul class="questionNumber">
			<?php

			for($x=1; $x <= $numOfQ; $x++){
				echo '<li><button type="button" class="btn btn-default';
				if($x == 1){
					echo ' active';
				};
				echo '">' . $x . '</button></li>';
			}
		  	?>
			</ul>
		</div>
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
				  		'<div id="tabs-'.$x.'" class="panel panel-warning '; if($x==1){echo 'activeQuestion';} echo ' question row">
							<div class="panel-heading col-md-12 col-xs-12"><h2 class=" newQuizHeader3 col-xs-12" >' . $questionRow['description'] . '</h2> 
								<p class=" col-md-2 col-xs-12 text-center"><span class="badge">' . $questionRow['points'] . '</span>Points</p>
							</div>
							';
							if($type ==  "multiple"){
							$query = ('SELECT choice_id, choice_desc, correct FROM choices WHERE q_id = "'.mysqli_real_escape_string($conn, $questionRow['q_id']).'"');
							$choicesResults = mysqli_query($conn, $query) ;
							while($choicesRow = mysqli_fetch_assoc($choicesResults))
								{
									
										echo 
										'<div class="input-group col-md-6 col-xs-12 col-md-offset-1 vert-offset-top-1" name="">
									      		<label>
									        		<input type="radio" aria-label="..." class="radioChoice target" name="choice'. $x . '" value="'. $choicesRow['choice_id'].'">
									      			' . $choicesRow['choice_desc'] . '
									    	</div><!-- /input-group -->';
									
									
													
								}
						}else if($type == "complete"){
							echo
										'<div class="input-group col-md-6 col-xs-12 col-md-offset-1 vert-offset-top-1" name="">

									        		<input type="text" aria-label="..." class="target" size ="100% "placeholder = "Answer" name="choice'. $x . '">

									    	</div><!-- /input-group -->';

						 }

				  		if($x < $numOfQ) {
							echo '<button type="button" class="btn btn-default  col-xs-12" onclick="viewNextQuestion()">Next Question</button>';
				  		}else if($x == $numOfQ){
				  			echo '<input type="submit" value="Submit Answers" onclick="needToConfirm = false">';
				  		}
				  		echo '
				  		</div>';

				  		
				  	
				}

				?>
		</div>
		<div>
			<h4>
			Time left:
			<span id="timer-min">15</span>
			<span>:</span>
			<span id="timer-sec">00</span>
			</h1>
		</div>
  	</div>
  	</form>
</div>

<script src="js/viewQuiz.js"></script>
<script>
var needToConfirm  = true;
	window.onbeforeunload = confirmExit;
  function confirmExit()
  {
  	
    return "You have attempted to leave this page. Once you leave, your answers will be sent. ";



  }
  window.onunload = saveAnswers;
  window.Location = 'index.php';
  function saveAnswers(){
  	document.getElementById("form").submit();
  }
setTimeout(function () {needToConfirm = false; document.getElementById("form").submit(); }, 900000);
setInterval(function(){
	if(parseInt(document.getElementById("timer-sec").innerHTML)!=0){
		var x = parseInt(document.getElementById("timer-sec").innerHTML) - 01;
		document.getElementById("timer-sec").innerHTML = x;
	}else{
		var y = parseInt(document.getElementById("timer-min").innerHTML ) - 01;
		document.getElementById("timer-min").innerHTML=y;
		document.getElementById("timer-sec").innerHTML = 59;
	}
},1000);
</script>
<?php include 'footer.php' ?>