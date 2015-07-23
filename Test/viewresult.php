<html>
<?php
$param = $_GET['id'];


?>
		<div class='col-md-3'></div>
		<div class='col-md-6'>

		
		<table class="table table-striped table-bordered" id="results">
			<thead>
				<tr>
					<form action ="" method='POST'>
						
					<td> Raw Score
						
					</td>
					<td> Percentile
					
						
					</td>
					<td>Category</td>
					
					</form>
					


				</tr>
			</thead>
			<tbody>

<?php
include 'header.php';

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
	
	
	

	 $sql = "SELECT raw_score, percentile, (case when percentile >= '97' AND percentile <= '99' Then 'Very Superior'
	 									  				when percentile >= '90' AND percentile <= '96' Then 'Superior'
                                         				when percentile >= '76' AND percentile <= '89' Then 'Above Average'
                                          				when percentile >= '60' AND percentile <= '75' Then 'High Average'
                                          				when percentile >= '40' AND percentile <= '59' Then 'Average'
                                          				when percentile >= '25' AND percentile <= '39' Then 'Low Average'
                                          				when percentile >= '10' AND percentile <= '24' Then 'Below Average'
                                          				when percentile >= '4' AND percentile <= '9' Then 'Low'
                                          				when percentile >= '1' AND percentile <= '3' Then 'Below Low' 
                                          				end ) as category from percentile where user= '$param'";
      $result = $conn->query($sql);
					if ($result->num_rows == 1) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    	echo '<tr>
				            	<td>' . $row["raw_score"] . '</td>
				            	<td>' . $row["percentile"] . '</td>
				            	<td>' . $row["category"] . '</td>
					        </tr>';
				}
					}
				

					?>
</div>
<div class='col-md-3'></div>
</html>