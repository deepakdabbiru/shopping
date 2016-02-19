<?php
namespace shopping;
require_once("vendor/autoload.php");
use shopping\Database;
session_start();
if ( !empty($_GET['Name'])) {//getting at top
	$brandname = $_REQUEST['Name'];
//echo $idno;
$_SESSION["brandname"] = "$brandname";
							}
if($_SESSION["username"] == null)
{	
	session_unset();
	session_destroy();
	header('Location:login.php');

}
elseif($_SESSION["brandname"] == null)
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

<?php
$email = $mobile = $address =$brandname= "";
$emailErr = $mobileErr = $addressErr = "";
$flag="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
		if(empty($_POST["mobile"]))
		{
			$mobileErr = "Please fill the Mobile !";
			$flag = 0;
		}
		else
		{
		$mobile = test_input($_POST["mobile"]);
		$flag++;
		}
		if(empty($_POST["address"]))
		{
			$addressErr = "Please fill the Address !";
			$flag = 0;
		}
		else
		{
			$address =  test_input($_POST["address"]);
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
<?php
	
	

function email($email,$token){
 require_once('class.phpmailer.php');
 include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
 
$mail= new PHPMailer();

$body= "Hai,your verification code is. " . $token." for this ".$_SESSION["brandname"] ." product";

$mail->IsSMTP(); // telling the class to use SMTP

$mail->Host = "ssl://smtp.gmail.com"; // SMTP server

$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)

// 1 = errors and messages

// 2 = messages only

$mail->SMTPAuth   = true;                  // enable SMTP authentication

$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier

//$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

$mail->Username   = "deepak.dabbiru@gmail.com";  // GMAIL username

$mail->Password   = "dad@143@me";            // GMAIL password 

$mail->SetFrom('deepak.dabbiru@gmail.com', 'Deepak Dabbiru');

 

//$mail->AddReplyTo("deepak.dabbiru@gmail.com","First Last");

 

$mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

 

//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

 

$mail->MsgHTML($body);

 

$address = $email;//email name of my textbox

$mail->AddAddress($address, "Deepak Dabbiru");

 

//$mail->AddAttachment("images/phpmailer.gif");      // attachment

//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

 

if(!$mail->Send()) {

echo "Mailer Error: " . $mail->ErrorInfo;

} else {

echo "Message sent!";

}
									}
						?>
						
<?php
	
	if($flag==3){
	function token(){
	return rand(100000,999999);
					}
	$token=token();
	email($email,$token);
	$dbobj=new Database();
	$connvariable=$dbobj->connectdb();
	
	$dbobj->BookQuery($connvariable,$email,$mobile,$token,$address);
	echo	$_SESSION["emailid"] =$email;
	//$email=$mobile=$address="";
				}
	?>
	<header class="navbar navbar-inverse head">
		<h1>Welcome to Orange Shopping</h1>
		<button onclick='home()'class="btn btn-primary pull-right " >Home</button>
	</header>
	<div class="container-fluid col-md-offset-5 col-md-6">
		<div class="row">
			<h2 class="col-md-offset-4 col-sm-offset-2 col-sm-8">Confirm your Item</h2>
		</div>
			<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >				
				<div class="form-group row">
					<label class="control-label col-md-offset-1 col-md-2">E-mail:</label>
						<div class="col-md-8">
							<input type="email" class="form-control" name="email" value="<?php echo $email;?>">
							<span class="error">*<?php echo $emailErr;?></span>
						</div>	
				</div>
				<div class="form-group row">
					<label class="control-label col-md-offset-1 col-md-2">Mobile:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="mobile" value="<?php echo $mobile;?>">
							<span class="error">*<?php echo $mobileErr;?></span>
						</div>					
				</div>
				<div class="form-group row">
					<label class="control-label col-md-offset-1 col-md-2">Address:</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="address" value="<?php echo $address;?>">
							<span class="error">*<?php echo $addressErr;?></span>
						</div>					
				</div>
				
				<div class="form-group row">
					<div class="col-md-offset-3 col-md-10"><button id="btnsignup" type="submit" class="btn btn-primary" >Confirm</button></div>
				</div>
			</form>
	</div>
	
</body>
<script>
	function home(){
	window.location.href="home.php";}
</script>
</html>
