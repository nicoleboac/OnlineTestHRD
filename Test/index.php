<!doctype html>
	<?php 
	include 'header.php'; 
	if(isset($_SESSION["username"])){
  	header('Location: test.php');} ?>
				<div id="logInArea" class=" side-collapse-container col-xs-12 col-sm-8 col-md-4 col-md-offset-4 .vert-offset-bottom-3 active">
					<form  role="form" action="functions/login.php" method="Post">

					<?php 
						if(isset($_GET["loggedout"]) && $_GET["loggedout"]==true){
						echo '<div class="alert alert-warning" role="alert">You need to log in first.</div>';
						}
						if(isset($_GET["failed"]) && $_GET["failed"]==true){
						echo '<div class="alert alert-danger" role="alert">Incorrect username/password</div>';
						}
						
					  ?>
					  <img src="images/Manor New Logo.png" alt="Manor Logo" id="logo"/>
					  <div class="form-group">
					    <label for="username">Username</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter username" name="username" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
					  </div>
					  <div class="form-group">
					    <p class="help-block">No account yet? Click <a href="#register" id="clickToRegister">here</a> to register</p>
					  </div>
					  <button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>

				<div id="registerArea" class=" side-collapse-container col-xs-12 col-sm-8 col-md-4 col-md-offset-4 .vert-offset-bottom-3 hidden2">
					<form role="form" action="functions/register.php" method="Post" autocomplete>

					<?php 
						if((isset($_GET["user"]) && $_GET["user"]=="1") || (isset($_GET["email"]) && $_GET["email"]=="1")){
						echo '<div class="alert alert-danger" role="alert">';
						if(isset($_GET["user"])){
							echo 'Username already exists<br>';
						}
						if(isset($_GET["email"])){
							echo 'Email address already exists<br>';
						}
						
						echo '</div>';
						}
					  ?>
					  <img src="images/Manor New Logo.png" alt="Manor Logo" id="logo"/>
					  <div class="form-group">
					    <label for="username">First Name</label>
					    <input type="text" class="form-control" id="InputEmail" placeholder="Ex.: John" name="reg-firstname" required>
					  </div>
					  <div class="form-group">
					    <label for="username">Last Name</label>
					    <input type="text" class="form-control" id="InputEmail" placeholder="Ex.: Doe" name="reg-lastname" required>
					  </div>
					  
					  <div class="form-group">
					    <label for="username">Contact Number</label>
					    <input type="text" class="form-control" id="InputEmail" placeholder="Ex.: (+63) 912-3456789" name="reg-contact" required>
					  </div>
					  <div class="form-group">
					    <label for="username">Email address</label>
					    <input type="text" class="form-control" id="InputEmail" placeholder="Ex.: johnDoe@email.com" name="reg-emailAddress" required>
					  </div>
					  <div class="form-group">
					    <label for="username">Username</label>
					    <input type="text" class="form-control" id="InputUsername" placeholder="Ex. johnDoe" name="reg-username" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="InputPassword1" placeholder="Ex.: test123" name="reg-password1" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword2">Confirm Password</label>
					    <input type="password" class="form-control" id="InputPassword2" placeholder="Ex.: test123" name="reg-password2" required>
					  </div>
					  <div class="form-group">
					    <label for="username">Department</label>
					   <select name ="reg-dept">
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
					  <button type="submit" class="btn btn-default">Submit</button>
					</form>

				</div>

		</section>
	<?php include 'footer.php'?>

