<?php
namespace shopping;
require_once("vendor/autoload.php");
use shopping\Database;
use Facebook;
$bran="";
session_start();
$_SESSION["postcode"]="";
$_SESSION["tokencode"] ="";
$_SESSION["brandname"]="";
?>
<?php
if($_SESSION["username"] == null)  
{
try {
$fb = new Facebook\Facebook(['app_id' => '1693579834209058',
  'app_secret' => 'd1f251cdf0353f388422250aee145e00',
  'default_graph_version' => 'v2.2',]);
$helper = $fb->getRedirectLoginHelper();
// @TODO This is going away soon
$facebookClient = $fb->getClient();

    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
if (isset($accessToken)) {
    // Logged in
    // Store the $accessToken in a PHP session
    // You can also set the user as "logged in" at this point
} elseif ($helper->getError()) {
    // There was an error (user probably rejected the request)
    echo '<p>Error: ' . $helper->getError();
    echo '<p>Code: ' . $helper->getErrorCode();
    echo '<p>Reason: ' . $helper->getErrorReason();
    echo '<p>Description: ' . $helper->getErrorDescription();
    exit;
}
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
// Returns a `Facebook\GraphNodes\GraphUser` collection
$user = $response->getGraphUser();

//echo 'Email: ' . $user['email'];
$_SESSION["username"]=$user['name'];
// OR
// echo 'Name: ' . $user->getName();
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
	
	<?php	echo $username ='<p style="color:black;margin-left:84em;">Welcome,' . $_SESSION["username"].'</p>'?>
	
  <ul class="nav nav-tabs">
    <li class="active"><a href="home.php">Home</a></li>
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
	 <li class="dropdown ">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Women<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="#">Sarees</a>
		 <ul class="sub-menu">
        <li><a href="homesarees.php">KanchiPattu</a></li>                       
      </ul>
		</li>
        <li><a href="homegold.php">jewelries</a></li>                        
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
	window.location.href="login.php";
					}
	</script>
	<?php
	echo "<h3>These are the items we provide :</h3>";
	$dbobj=new Database();
	$connvariable=$dbobj->connectdb();
	$mobilevariable=$dbobj->selectAll($connvariable);
	?>
</body>
</html>
