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
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="signup.css" type="text/css"></link>
</head>
<body>
	<header class="navbar navbar-inverse head">
		<h1>Welcome to Orange Shopping</h1>
		
		<button onclick='home()'class="btn btn-primary pull-right " >Home</button>
	</header>
	<div class="container-fluid col-md-offset-5 col-md-6">
		<div class="row">
			<h1 style="color:red;"> opps!!! Access Denied.</h1>
		</div>
				
			</form>
	</div>
	
</body>
<script>
	function home(){
	window.location.href="home.php";}
</script>
</html>
