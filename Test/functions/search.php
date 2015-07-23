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

					if(isset($_POST['search'])){
					$searchword = $_POST['search'];
					$sql = "SELECT last_name, first_name, department from users where admin='false' AND last_name like '%$searchword%' OR first_name like '%$searchword%' OR department like '%$searchword'"; 
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    	
					    echo '<tr>
				            	<td>' . $row["last_name"] . '</td>
				            	<td>' . $row["first_name"] . '</td>
				            	<td>' . $row["department"] . '</td>
				            	<td style="width:10%"> <button type="button" class="btn btn-default">View Results</button>  </td>
					        </tr>';
					    }

					}
				} else {
					$sql = "SELECT last_name, first_name, department from users where admin='false' order by last_name DESC"; 
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    	echo '<tr>
				            	<td>' . $row["last_name"] . '</td>
				            	<td>' . $row["first_name"] . '</td>
				            	<td>' . $row["department"] . '</td>
				            	<td style="width:10%"> <button type="button" class="btn btn-default">View Results</button>  </td>
					        </tr>';
				}
					}
				}

					?>