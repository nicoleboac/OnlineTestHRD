<?php include 'header.php';
	if(!isset($_SESSION["username"])){
  	header('Location: index.php?loggedout=true');} ?> 
<div id="newQuizBlock1" class="panel panel-default">
	<form action="functions/saveQuiz.php" method="POST" onsubmit="return checkRadioButtonsBeforeSubmit()">
	<div class="panel-heading"><h1 id="newQuizHeader1">Create New Test</h1></div>
	<div id="newQuizblock2" class="panel panel-info col-md-12 col-xs-12">
		<div class="panel-heading col-md-12 col-xs-12"><input id="newQuizHeader2"  placeholder="Enter Test title here" class="col-md-7 col-xs-12" name="quiz-title" required>
			<div class="col-md-2  label label-info col-md-offset-1 col-xs-6"><p><span class="badge" id="totalPoints">120</span>Points</p></div>
			<div class="col-md-2  label label-warning col-xs-6 "><p><span class="badge" id="totalQuestions">12</span>questions</p></div>
		</div>
	</div>
	<input type="hidden" name="numOfQ" id="totalQ">
	<input type="hidden" name="totalPoints" id="totalP">
	<input type="hidden" name="type" value="multiple">
	<div class="panel-body" id="tabs" >
		
		<span>Question number:</span>
		<div class="btn-group" role="group" aria-label="...">
			<ul class="questionNumber">
		  	<li><button type="button" class="btn btn-default active" onclick="changeActiveClass(0)">1</button></li>
			</ul>
		</div>
		<script>

		</script>
		<div class="questions" >
	  		<div id="tabs-1" class="panel panel-warning activeQuestion question row">
				<div class="panel-heading col-md-12 col-xs-12"><input placeholder="Enter Question here" class="col-md-10 newQuizHeader3 col-xs-12" name="q1-desc" required>
					<p class=" col-md-2 col-xs-12 text-center"><span class="badge"><input editable = "false" type="number" class="points col-md-10" value="1" name="q-points-1" onkeyup="updateTotalPoints()"></span>Point</p>
				</div>
				<input type="hidden" class="choiceCount" name="totalChoice1" value="2">
				<div class="input-group col-md-6 col-xs-12 " name="">
			      		<span class="input-group-addon">
			        		<input type="radio" aria-label="..." class="radioChoice target" name="choice1" value="1">
			      		</span>
			      		<input type="text" class="form-control choice" aria-label="" placeholder="1.)"name = "cvalue1-1">
			    	</div><!-- /input-group -->
				
			    	<div class="input-group col-md-6 col-xs-12" name="choice2">
			      		<span class="input-group-addon">
			        		<input type="radio" aria-label="..." class="radioChoice" name="choice1" value="2">
			      		</span>
			      		<input type="text" class="form-control choice" aria-label="... " placeholder="2.)" name = "cvalue1-2">
			    	</div><!-- /input-group -->
			    	
	  		</div>

		</div>


  	<div class="panel-footer col-xs-12 col-md-12">
  		<div class="btn-group btn-group-md col-md-5" role="group" aria-label="...">
  		<button type="button" class="btn btn-default col-xs-12" onclick="addQuestion()">Add new question</button>
		<button type="button" class="btn btn-default col-xs-12" onclick="addChoice()">Add new choice</button>
		<button type="button" class="btn btn-default col-xs-12" onclick="removeQuestion()" id="removeQuestionButton">Remove this question</button>
  		</div>
		
		<div class="col-md-3 col-xs-12 ">
		<label class="questionTypeLabel">Department:</label>
			<select name ="department">
				<?php 

					$username = "root";
					$password = "";
					$dbname = "quiz_db";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Connection failed: " . $conn->connect_error);
					} 

					$query = ('SELECT dept_id, dept_name FROM department;');
					$departmentResults = mysqli_query($conn, $query) ;

					while($deptRow = mysqli_fetch_assoc($departmentResults)){
						echo '<option value='.$deptRow['dept_id'].'>'. $deptRow['dept_name'].'</option>';
					}
				?>
			</select>
		</div>
  		

  		<input type="submit" class="btn btn-default  col-xs-12 col-md-2" value="End and Save">
  	</div>
  	</form>
</div>

<div id="dialog-1" class="col-xs-12">You have to indicate the correct answer by clicking on the radio button beside the answer before adding/moving to another question. This should also be done before saving the quiz.</div>
<script src="js/createQuiz.js"></script>
<?php include 'footer.php'?>