<?php include 'header.php';
	if(!isset($_SESSION["username"])){
  	header('Location: index.php?loggedout=true');} ?> 

	<div id="changePassArea" class=" side-collapse-container col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
	<h1>Change User Password</h1>
	<div class="form-group">
	    <p class="help-block">Please fill in your current password and your new password.</p>
	  </div>
	<form  role="form" action="functions/changepass.php" method="Post">
	<?php 
		if(isset($_GET["success"]) && $_GET["success"]==true){
		echo '<div class="alert alert-success" role="alert"><strong>Success!</strong> Your password has been changed.</div>';
		}
	  ?>
	  <div class="form-group">
	    <label for="oldPass">Old Password</label>
	    <input type="password" class="form-control" id="exampleInputEmail1" placeholder="ex.: 1234" name="old-password" required>
	  </div>
	  <div class="form-group">
	    <label for="newPassword1">New Password</label>
	    <input type="password" class="form-control" id="InputPassword1" placeholder="ex.: 12345" name="new-password-1" required>
	  </div>
	  <div class="form-group">
	    <label for="newPassword2">Confirm NewPassword</label>
	    <input type="password" class="form-control" id="InputPassword2" placeholder="ex.: 12345" name="new-password-2" required>
	  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>
<?php include 'footer.php'?>