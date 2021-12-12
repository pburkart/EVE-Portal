<?php
  session_start();
  if(basename($_SERVER['PHP_SELF']) != "login.php"){
  	if(!isset($_SESSION['id'])){
  		header("Location: login.php");
  		die();
  	}
  }
?>

<!DOCTYPE html>

<html>
	<head>
		<title>
			EVE Portal
		</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel='stylesheet' type='text/css' href='css/main.css'/>
	</head>
	<body>
		<nav class="orange">
    			<div class="nav-wrapper">
      				<a href="#" class="brand-logo black-text">EVE Portal</a>
      				<ul id="nav-mobile" class="right hide-on-med-and-down">
        				<li><a class="black-text" href="index.php"><b>Home</b></a></li>
        				<li><a class="black-text" href="character.php"><b>Character</b></a></li>
        				<li><a class="black-text" href="corporation.php"><b>Corporation</b></a></li>
                <?php if(isset($_SESSION['id'])){echo "<li><a class='black-text' href='logout.php'><b>Logout</b></a></li>";}?>
      				</ul>
    			</div>
  		</nav>
