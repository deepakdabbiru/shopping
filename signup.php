<?php
namespace shopping;
require_once("vendor/autoload.php");
use shopping\Database;

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="signup.css" type="text/css"></link>
</head>
<body>
<?php
$firstname = $lastname = $username = $email = $password = $confirmpassword = "";
$firstnameErr = $lastnameErr = $usernameErr = $emailErr = $passwordErr = $confirmpasswordErr = "";
$flag="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(empty($_POST["firstname"]))
		{
			$firstnameErr = "Please fill the Firstname !";
			$flag = 0;
		}
		else
		{
			$firstname = test_input($_POST["firstname"]);
			$flag++;
			if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
			$firstnameErr = "Only letters and white space allowed"; 
			$flag = 0;
			}
		}
		if(empty($_POST["lastname"]))
		{
			$lastnameErr = "Please fill the Lastname !";
			$flag = 0;
		}
		else
		{
			$lastname = test_input($_POST["lastname"]);
			$flag++;
			if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
			$lastnameErr = "Only letters and white space allowed"; 
			$flag = 0;
			}
		
		}
		if(empty($_POST["username"]))
		{
			$usernameErr = "Please fill the Username !";
			$flag = 0;
		}
		else
		{
			$username = test_input($_POST["username"]);
			$flag++;
			if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
			$usernameErr = "Only letters and white space allowed"; 
			$flag = 0;
			}
		}
		if(empty($_POST["email"]))
		{
			$emailErr = "Please fill the e-mail !";
			$flag = 0;
		}
		else
		{
			$email = test_input($_POST["email"]);
			$flag++;
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format"; 
			$flag = 0;
			}
		}
		if(empty($_POST["password"]))
		{
			$passwordErr = "Please fill the Password !";
			$flag = 0;
		}
		else
		{
		$password = test_input($_POST["password"]);
		$flag++;
		}
		if(empty($_POST["confirmpassword"]))
		{
			$confirmpasswordErr = "Please fill the ConfirmPassword !";
			$flag = 0;
		}
		else if ($_POST["password"] != $_POST["confirmpassword"])
		{
			$confirmpasswordErr = "Check the password";
			$flag = 0;
		}
		else
		{
			$confirmpassword =  test_input($_POST["confirmpassword"]);
			$flag++;
			if (CRYPT_STD_DES == 1)
			{
				$password = crypt($password,'st'); 
			}
		}
											}
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>
<?php
	
	if($flag==6){
	$dbobj=new Database();
	$connvariable=$dbobj->connectdb();
	$conReturningvariable=$dbobj->insertQuery($connvariable,$firstname,$lastname,$username,$email,$password,$usernameErr);
	$usernameErr=$conReturningvariable	;
				}				
	?>
	<header class="navbar navbar-inverse head">
		<h1>Welcome to Orange Shopping</h1>
	</header>
	<div class="container-fluid col-md-offset-5 col-md-6">
		<div class="row">
			<h2 class="col-md-offset-4 col-sm-offset-2 col-sm-8">CREATE YOUR ACCOUNT</h2>
		</div>
			<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
				<div class="form-group row">
					<label class="col-md-2 col-md-offset-1 control-label">Name:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Firstname" name="firstname" value="<?php echo $firstname;?>">
							<span class="error">*<?php echo $firstnameErr;?></span>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Lastname" name="lastname"  value="<?php echo $lastname;?>">
							<span class="error">*<?php echo $lastnameErr;?></span>
						</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-md-offset-1 col-md-2">Username:</label>
						<div class="col-md-8"> 
							<input type="text" class="form-control" name="username" value="<?php echo $username;?>" >
							<span class="error">*<?php echo $usernameErr;?></span>
							</div>
						</div>
				
				<div class="form-group row">
					<label class="control-label col-md-offset-1 col-md-2">E-mail:</label>
						<div class="col-md-8">
							<input type="email" class="form-control" name="email" value="<?php echo $email;?>">
							<span class="error">*<?php echo $emailErr;?></span>
						</div>	
				</div>
				<div class="form-group row">
					<label class="control-label col-md-offset-1 col-md-2">Password:</label>
						<div class="col-md-8">
							<input type="password" class="form-control" name="password" value="<?php echo $password;?>">
							<span class="error">*<?php echo $passwordErr;?></span>
						</div>					
				</div>
				<div class="form-group row">
					<label class="control-label col-md-offset-1 col-md-2">Confirm Password:</label>
						<div class="col-md-8">
							<input type="password" class="form-control" name="confirmpassword" value="<?php echo $confirmpassword;?>">
							<span class="error">*<?php echo $confirmpasswordErr;?></span>
						</div>
				</div>
				<div class="form-group row">
					<div class="col-md-offset-3 col-md-10"><button id="btnsignup" type="submit" class="btn btn-primary" >Sign up</button></div>
				</div>
			</form>
	</div>
	
</body>
</html>
