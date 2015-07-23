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
		  ?>
		<h1>Applicants</h1>
		<div class="row">
  <div class="col-lg-6">

		 <div class="input-group">
		 	<form action="" method='POST' >
      <input type="text" class="form-control" name="searchkey" placeholder="Search">
        <button class="btn btn-default" name="searchbtn" type="submit">Go!</button>
  
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  </form>
</div><!-- /.row -->
		<table class="table table-striped table-bordered" id="">
			<thead>
				<tr>
					<td><a href="?orderBy=last_name">Last Name</a>
								<a href="?orderBy=last_name" role="button">
								</a>
								</td>
					<td><a href="?orderBy=last_name">First Name</a>
								<a href="?orderBy=last_name" role="button">
								</a></td>
					<td>Results</td>

					

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

					if(isset($_POST['searchbtn'])){

					$searchword = $_POST['searchkey'];
					$sql = "SELECT username, last_name, first_name from users where admin='false' AND department='". $_SESSION['department']."' AND (last_name like '%$searchword%' OR first_name like '%$searchword%') "; 
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    	
					    echo '<tr>
					    		<td style="display:none" name ="username">' . $row["username"] . '</td>
				            	<td>' . $row["last_name"] . '</td>
				            	<td>' . $row["first_name"] . '</td>
				            	<td style="width:10%"> <a href="viewresult.php?id='. $row['username'] .'"><button type="button" class="btn btn-default">View Results</button> </a> </td>
					        </tr>';
					    }

					}
				} else {
					$sql = "SELECT username, last_name, first_name from users where admin='false' AND department='". $_SESSION['department']."'"; 
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    	echo '<tr>
					    		<td style="display:none" name ="username">' . $row["username"] . '</td>
				            	<td>' . $row["last_name"] . '</td>
				            	<td>' . $row["first_name"] . '</td>
				            	<td style="width:10%"> <a href="viewresult.php?id='. $row['username'] .'"><button type="button" class="btn btn-default">View Results</button> </a> </td>
					        </tr>';
				}
					}
				}

											?>
									</tbody>
								</table>
						
							</div>
						<?php include 'footer.php'?>