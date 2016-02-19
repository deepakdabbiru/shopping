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
elseif($_SESSION["postcode"] == null)
{
	header('Location:acess.php');
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
		<div class="row" style="border:5px solid green;">
			<h2>Congratulations!!!<br> Your Product: <?php echo $_SESSION["brandname"]."<br> Reference Order no :".$_SESSION["tokencode"]?>  Sucessfully booked.<br>We deliver it an week days.</h2>
			<h2 style="color:red">*Note:<u> Order details had sent to your e-mail address.</u></h2>
			<h1 style="text-align:center;color:blue">Thank you for shopping!!!</h1>
		</div>
				
			</form>
	</div>
	
</body>
<script>
	function home(){
	window.location.href="home.php";}
</script>
</html>
