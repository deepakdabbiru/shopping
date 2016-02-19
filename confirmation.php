<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="flightsjquery.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="addflight.css">
</head>
<body>
<br>
<?php
function email($email,$token){
 require_once('class.phpmailer.php');
 include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$mail= new PHPMailer();
$body= "Hai,your verification code to book ticket. " . $token ;

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

$mail->Password   = "loveyoudad@3";            // GMAIL password 

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
$confirm="";
$confirmErr="";
$email=$mobile=$address= "";
$emailErr=$mobileErr=$addressErr="";
$servername = "localhost";
$username = "root";
$password = "";
$flag=0;


if ($_SERVER["REQUEST_METHOD"] == "POST") 	{
 // $date = test_input($_POST["date"]);
  if (empty($_POST["confirm"])) {
    $confirmErr = "Please Enter verfication code";
	echo $confirm;
							} 
  else	 {
    $confirm = test_input($_POST["confirm"]);
	echo $confirm;
		} 
		
 if (empty($_POST["email"])) {
    $emailErr = "Please Enter e-mail id";
	$flag=0;
							} 
  else	 {
    $email = test_input($_POST["email"]);
	 $flag++;
 if (strlen($email) > 30)
{
   $emailErr = "e-mail  must not greater than 30 Characters.";
   $flag=0;
}
	  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  $flag=0;
	 $emailErr = "Please enter your e-mail like this userid@example.com"; 
											}
		} 
   //$departure = test_input($_POST["departuretime"]);
   if(empty($_POST["mobile"]))
   {
   $mobileErr="Please Enter the mobile no";
   $flag=0;   
   }
   else
   {
   $mobile = test_input($_POST["mobile"]); 
	 $flag++;
    if (!preg_match("/^[0-9]*$/",$mobile)) 	{
	 $mobileErr = "Only numbers allowed"; 
	 $flag=0;
	 									}  
	if (strlen($mobile) > 10)
{
   $mobileErr = "Mobile no is too long, minimum is 6 digts to maximum 10digts.";
   $flag=0;
}
elseif (strlen($mobile) < 6)
{
  $mobileErr=  "Mobile no is too short, minimum is 6 digts to maximum 10digts.";
  $flag=0;
}
   }   
  // $arrival = test_input($_POST["arrivaltime"]);
  if(empty($_POST["address"]))
  {
  $addressErr="Please enter address";
  $flag=0;  
  }
  else
  {
  $address = test_input($_POST["address"]);
   $flag++;
  if (!preg_match("/^[a-zA-Z0-9,-]*$/",$address)) {
	$addressErr = "Only letters,numbers,-,whitespace and , allowed"; 
	$flag=0;
													}
		if (strlen($address) > 150)
{
   $addressErr = "Address should not exceed greater than 150 characters";
   $flag=0;
}
  }  
   try {
    $conn = new PDO("mysql:host=$servername;dbname=deepak", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $token=token();//calling token function
	if($flag==3){
	 $sql = "INSERT INTO book (email,mobile,address,token)
    VALUES ('$email','$mobile', '$address','$token')";
	$conn->exec($sql);
	email($email,$token);
	$email=$mobile=$address= "";
    echo "New record created successfully";	
	//header("Location: entercode.php?token=".$token.""); we can also send this value to next page using this.
	header("Location: entercode.php");
	
				}   
		}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }   
										}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
							}
							//creating token function using rand method
	function token(){
	return rand(100000,999999);
					}

?>
<div class="container" style="background-color:#FAEBD7;width:70%; ">
<div class="jumbotron" id="jumbo" style="background-color:#FAEBD7;" >
<button  onclick="home()" class="btn btn-danger btn pull-right">Home</button>
	<form class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
	<h6 class="error">Note: *Required Fields.</h6>
		<h2 class="text-center">Confirm your flight Details</h2><br>
		<div class="form-group row">
		<div class="col-md-offset-3 col-md-6"> <input type="text" class="form-control" name="email" value="<?php echo $email;?>"
		id="class" placeholder="e-mail" data-toggle="tooltip" data-placement="bottom" title="Please enter your e-mail id"><span class="error">*<?php echo $emailErr;?></span>
		</div>	
		</div>	
		<div class="form-group row">
		<div class="col-md-offset-3 col-md-6"><input type="text" class="form-control" name="mobile" value="<?php echo $mobile ?>"
						 placeholder="Mobile No" data-toggle="tooltip" data-placement="bottom" title="Please enter your Mobile No" id="depart"><span class="error">*<?php echo $mobileErr;?></span>
						 </div>
		</div>		
		<div class="form-group row">
				<div class="col-md-offset-3 col-md-6"><input type="text" class="form-control" name="address" value="<?php echo $address?>"
				id="arrival" placeholder="Address" data-toggle="tooltip" data-placement="bottom" title="Please enter your Address"><span class="error">*<?php echo $addressErr;?></span>
				</div>
		</div>
		<div class="form-group row">
	<div class="col-md-offset-3 col-md-3 ">	<button  type="submit" class="btn btn-success" id="bok" name="submit" > book</button></div>
		</div>
	</form>
</div>
</div>
<br>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
							});
						function home(){
	window.location.href="flights.php";}
</script>
<br>
</body>
</html>