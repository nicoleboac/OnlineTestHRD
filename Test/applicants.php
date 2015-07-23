<?php include 'header.php';
	if(!isset($_SESSION["username"])){
  	header('Location: index.php?loggedout=true');} ?> 

	<div class="col-md-12">
		
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
					?>
						<div class="row" id="search">
						  <div class="col-lg-6">
						    <div class="input-group">
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="button" onclick="search()">Go!</button>
						      </span>
						      <input type="text" class="form-control search" placeholder="Search for...">
						    </div><!-- /input-group -->
						  </div><!-- /.col-lg-6 -->

						</div><!-- /.row -->
					   <table class="table table-striped table-bordered">
							<thead>
								<tr>
									<td>Last Name</td>
									<td>First Name</td>
									<td>Department</td>
									<td>Results</td>
								</tr>
							</thead>
							<tbody
					
					 <?php 
					 		if($_SESSION["department"] == "*" && isset($_GET["search"])){
					 			$sql = "SELECT * FROM quiz_db.users JOIN department USING(dept_id) where admin = false AND ( CONCAT(CONCAT(first_name, ' '), last_name ) LIKE '%". $_GET["search"] ."%')";
					 		}else if($_SESSION["department"] != "*" && isset($_GET["search"])){
					 			$sql = "SELECT * FROM quiz_db.users JOIN department USING(dept_id) where admin = false AND dept_id = '". $_SESSION["department"] ."' AND  ( CONCAT(CONCAT(first_name, ' '), last_name ) LIKE '%". $_GET["search"] ."%')";
					 		}
					 		else if($_SESSION["department"] == "*"){	
					    			$sql = "SELECT * FROM users JOIN department USING(dept_id) where admin = 'false' ORDER BY last_name";
							}else{
								$sql = "SELECT * FROM users JOIN department USING(dept_id) where admin = 'false' and dept_id = ".$_SESSION["department"] .' ORDER BY last_name';
							}

							$rs = $conn->query($sql);
							while($resultRow = $rs->fetch_assoc()) {
							echo '<tr>
									<td>'. $resultRow['last_name'] .'</td>
									<td>'. $resultRow['first_name'] .'</td>
									<td>'. $resultRow['dept_name'] .'</td>'."
									<td><a href='record.php?user=".$resultRow['username']."'>View Results</a></td>
								</tr>";
							}
						echo 
						'
						</tbody>
						</table>';
		?>
	</div>
<?php include 'footer.php'?>