<?php
  session_start();
echo
'<html>
  <head>
  <link rel="icon" 
    type="image/png" 
    href="images/icon.png" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">'; 
     include 'head-elements.php';
    echo
    '</head>
  <body>
    <section class="container">
      <header role="banner" class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
          <div class="navbar-header">
            <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          </div>
          <div class="navbar-inverse side-collapse in">
            <nav role="navigation" class="navbar-collapse">
              <ul class="nav navbar-nav">';
              if(!isset($_SESSION["username"])){
                echo
               '<li><a href="index.php"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
                <li><a href="index.php#logIn"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
                <li><a href="index.php#register"><span class="glyphicon glyphicon-pencil"></span> Register</a></li>';
                }else if(isset($_SESSION["username"]) && $_SESSION["admin"]=="false" ){
                  echo
               '<li><a href="test.php">Home</a></li>
                <li><a href="changepassword.php">Change Password</a></li>
                <li><a href="functions/logOut.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>';
                }else if($_SESSION["admin"] =="true" && $_SESSION["department"] == "*"){
                  echo
                '<li><a href="test.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
               <ul class="nav navbar-nav">
            <li class="dropdown" id="dropdown">
              <a id="drop2" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-edit"></span> 
                Create Test
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="newQuiz.php">Multiple Choice</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="newQuiz2.php">Complete the sentence</a></li>
              </ul>
            </li>
          </ul>
                <li><a href="applicants.php"><span class="glyphicon glyphicon-search"></span> View Applicants</a></li> 
                <li><a href="changepassword.php">Change Password</a></li>
                <li><a href="functions/logOut.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>';
                }else if(isset($_SESSION["username"]) && $_SESSION["admin"]=="true" ){
                  echo
               ' <li><a href="applicants.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
                <li><a href="changepassword.php">Change Password</a></li>
                <li><a href="functions/logOut.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>';
                }
                echo
              '</ul>
            </nav>
          </div>
        </div>
      </header>';
?>