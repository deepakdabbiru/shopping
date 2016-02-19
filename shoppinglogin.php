<?php
namespace shopping;
require_once("vendor/autoload.php");
use shopping\Database;
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="login.css" type="text/css"></link>
</head>
<body>
<?php
$username = $password = "";
$usernameErr = $passwordErr = "";
$flag=$count="";
$uname=$pass="";
if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	if($count==0)
						{
						$usernameErr = "Inavlid Username";
						$passwordErr = "Inavlid Password";
						}
	
		if(empty($_POST["username"]))
		{
			$usernameErr = "Please enter you Username";
		//$flag = 0;
		}
		else
		{
		$username = test_input($_POST["username"]);
			//$flag++;
			if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
			$usernameErr = "Only letters and white space allowed";
			//$flag = 0;
			}
		}
		
		if(empty($_POST["password"]))
		{
			$passwordErr = "Please enter your password";
		//	$flag = 0;
		}
		else
		{
			$password = test_input($_POST["password"]);
			$flag++;
			 
			/*if (CRYPT_STD_DES == 1)
				{
					$password = crypt($password,'st'); 
				}*/
		}
		
		
											}
					
					
						
						
						
		function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
		
?>
	<header class="navbar navbar-inverse head">
		<h1>Welcome to Orange Shopping</h1>
	</header>
	<br>
	<br>
	<div class="container-fluid col-md-offset-5	 col-md-6" >
			<h1>Login</h1>
			<hr>
			<form class="form-horizontal" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="form-group row">
					<label class="col-md-2 col-md-offset-1 control-label">Username:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="username" value="<?php echo $username;?>" >
							<span class="error">*<?php echo $usernameErr; ?></span>
						</div>	
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-md-offset-1 control-label">Password:</label>
						<div class="col-md-8">
							<input type="password" class="form-control" name="password">
							<span class="error">*<?php echo $passwordErr; ?></span>
						</div>	
				</div>
				<div class="form-group row">
					<div class="col-md-offset-3 col-md-9">
						<button  type="submit" class="btn btn-primary">Login</button> <button  type="submit" class="btn btn-primary">facebook</button> <button  type="submit" class="btn btn-danger">gmail</button>
					</div>
				</div>		
			</form>
		<br/>
		<div class="row">
			<label class="col-md-offset-3 col-md-9">Don't have an account? 
				<a href="signup.php" >Click here to signup!</a>
			</label>
		</div>	
	</div>
	<?php
			$servername = "localhost";
			$username = "root";			
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{					
					try 
					{
						$uname=$pass="";
						$uname=$_POST["username"];						
						$pass=$_POST["password"];						
						$conn = new PDO("mysql:host=$servername;dbname=deepak;charset=utf8",$username);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);						
						$stmt = $conn->prepare("SELECT Username,Password FROM signup where Username='$uname' and Password='$pass'"); 
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
						$result = $stmt->fetchColumn();
						//var_dump($result);
						$count = $stmt->rowCount();
						if($count==1)
						{
							
								header('Location: home.php'); 									
							
						}
					
						
						
											
					}				
					catch(PDOException $e)
					{
						echo "Connection failed: " . $e->getMessage();
					}
					
				
			}

		?>
</body>
</html>