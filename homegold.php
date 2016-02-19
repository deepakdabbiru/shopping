<?php
namespace shopping;
require_once("vendor/autoload.php");
use shopping\Database;
session_start();
if($_SESSION["username"] == null)
{
	session_unset();
	session_destroy();
	header('Location:login.php');	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="home.css" type="text/css"></link>
</head>
<body>
	<header class="navbar navbar-inverse head">
		<h1>Welcome to Orange Shopping</h1>
  <ul class="nav nav-tabs">
    <li><a href="home.php">Home</a></li>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Electronics<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="#">Gadgets</a>
		 <ul class="sub-menu">
        <li><a href="homeredmi.php" id="redmi">Sony</a></li>
        <li><a href="homelenovo.php">Lenovo</a></li>                      
      </ul>
	  </li>                 
      </ul>
    </li>
	 <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Men<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="#">Shirts</a>
		 <ul class="sub-menu">
        <li><a href="hometwills.php">Twills</a></li>                        
      </ul>
		</li>
        <li><a href="#">Watches</a>
		 <ul class="sub-menu">
        <li><a href="homefastrack.php">fasttrack</a></li>                  
      </ul>
		</li>                      
      </ul>
    </li>
	 <li class="dropdown active">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Women<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="#">Sarees</a>
		 <ul class="sub-menu">
        <li><a href="#">KanchiPattu</a></li>                       
      </ul>
		</li>
        <li><a href="#">jewelries</a></li>                        
      </ul>
    </li>
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Sports<span class="caret"></span></a>
		<ul class="dropdown-menu">
		<li><a href="#">Shoes</a>
		 <ul class="sub-menu">
        <li><a href="homenike.php">Nike</a></li>                    
      </ul></li>
	</li>
		</ul>
	</li>
      <button   class="btn btn-primary btn pull-right" onclick="login()">Logout</button>
  </ul>  
  	</header>
	
	<script>
	function login(){
	window.location.href="login.php";}
	</script>
	<?php
	$name='gold';
	$dbobj=new Database();
	$connvariable=$dbobj->connectdb();
	$mobilevariable=$dbobj->selectMobile($connvariable,$name);
	
	?>
</body>
</html>
