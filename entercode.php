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
<script>//code to erase the previous data
  function preventBack(){window.history.forward();}
  setTimeout("preventBack()", 0);
  window.onunload=function(){null};
</script>
</head>
<body>
<?php
$confirm="";
$confirmcodeErr="";
$flag=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") 	{
 // $date = test_input($_POST["date"]);
  if (empty($_POST["confirm"])) {
    $confirmcodeErr = "Please Enter verfication code";
	$flag=0;
								} 
  else	 {
    $confirm = test_input($_POST["confirm"]);
	$flag++;
	  if (!preg_match("/^[0-9 ]*$/",$confirm)) {
	 $confirmcodeErr = "Only numbers are allowed"; 
	 $flag=0;
												}	
		}
require 'database.php';
//echo $idno;
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if($flag==1){
$sql = "SELECT * FROM book where token='".$confirm."'";
$q = $pdo->prepare($sql);
$q->execute(array($confirm));
if( $q->rowCount()==1)
{
echo "<h1>Your Ticket has been Booked.</h1>";
$confirm="";
}
else
{
echo "<h1>Please Check the Verification Code and ReEnter.</h1>";
}

}
Database::disconnect();	
}			
	function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
							}
?>
<br>
<div id="confirmbo">
	<div class="container" style="background-color:#FAEBD7;width:70%; ">
<div class="jumbotron" id="jumbo" style="background-color:#FAEBD7;" >
<button   class="btn btn-danger btn pull-right">Logout</button>
<button  onclick="home()" class="btn btn-primary btn pull-right" style="margin-right:8px;">Home</button>
	<form class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
	<h6 class="error">Note: *Required Fields.</h6>
		<h2 class="text-center">Enter Your Code Details</h2><br>
		<div class="form-group row">
		<div class="col-md-offset-3 col-md-6"> <input type="text" class="form-control" name="confirm" value="<?php echo $confirm;?>"
		id="class" placeholder="Enter Code" data-toggle="tooltip" data-placement="bottom" title="Please enter your code"><span class="error">*<?php echo $confirmcodeErr;?></span>
		</div>	
		</div>			
		
		<div class="form-group row">
	<div class="col-md-offset-3 col-md-3 ">	<button  type="submit" class="btn btn-success" id="bok" name="submit" > book</button></div>

		</div>
	</form>
</div>
</div>
</div>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
							});
						function home(){
	window.location.href="flights.php";}
	
</script>

</body>
</html>