<?php
namespace shopping;
use \PDO;
$flag="";
 class Database
 {     
     function connectdb()
     {
					try 
					{
						$servername = "localhost";
						$username = "root";	     						
						$conn = new PDO("mysql:host=$servername;dbname=deepak;charset=utf8",$username);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
						return $conn;						
					}				
					catch(PDOException $e)
					{
						echo "Connection failed: " . $e->getMessage();
					}
     }
	 function selectQuery($connvariable,$username,$password)
	 {					

					$stmt = $connvariable->prepare("SELECT Id,Username,Password FROM signup where Username='$username' and Password='$password'"); 
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
						$result = $stmt->fetchall();
						foreach($result as $value)
								{
							 $name=$value['Username'];
								
									
								}				
						//var_dump($result);						
						$count = $stmt->rowCount();
						if($count==1)
						{			
								 $_SESSION["username"]=$value['Username'];
								header('Location: home.php'); 			
						}
						
							 
	 }
	 function insertQuery($connvariable,$firstname,$lastname,$username,$email,$password,$usernameErr)
	 {
	 
	 
	 $stmt = $connvariable->prepare("SELECT Id,Username,Password FROM signup where Username='$username'"); 
						$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
						$result = $stmt->fetchall();				
						//var_dump($result);						
						$count = $stmt->rowCount();
						if($count==1)
						{			
						return $usernameErr="Username already exists";
					
											
						}
					else
					{	 
					$stmt=$connvariable->prepare("INSERT INTO signup (Firstname,Lastname,Email,Password,Username)
					VALUES ('$firstname','$lastname','$email','$password','$username')");
					$stmt->execute();
					//$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
					//$result=$stmt->fetchColumn();
					//$count=$stmt-rowCount();
					
					 header("Location:login.php");
					 }
					 
	 }
	
	function selectMobile($connvariable,$name) 
	{	
	$stmt = $connvariable->prepare("SELECT Id,Name,Specification,Price,Image FROM Mobile where Name='$name'"); 
					$stmtobj=	$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
						$result = $stmt->fetchAll();
						foreach($result as $value)
								{
								echo "<h3>The item selected by you is :</h3>";
								$mobilename=$value['Name'];
								echo "Brand:".$mobilename;
								echo "<br>";
								$specification=$value['Specification'];
								echo  "Specifications:". $specification;
								echo "<br>";
								$price=$value['Price'];
								echo "Rs".$price."/-";
								echo "<br>";
								$image ='<a id="selectitem" href="buy.php?Name='.$value['Name'].'"><img src="data:image/jpeg;base64,'.base64_encode( $value['Image'] ).'"/></a>';
								echo $image;
								echo ' <a  href="buy.php ?Name='.$value['Name'].'" id="updateclick" class="btn btn-success btn-primary btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span> Buy</a>'; 	
								}
						
						//var_dump($result);						
						//$count = $stmt->rowCount();
						//return $stmtobj;	
						
	}
	
	function selectAll($connvariable) 
	{	
	$stmt = $connvariable->prepare("SELECT Id,Name,Specification,Price,Image FROM Mobile"); 
					$stmtobj=	$stmt->execute();
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
						$result = $stmt->fetchAll();
						foreach($result as $value)
								{
								echo "<tr><td>"; 
								echo "<hr>";
								$mobilename=$value['Name'];
								echo "Brand:".$mobilename;
								echo "<br>";
								echo "</td><td>"; 
								$specification=$value['Specification'];
								echo  "Specifications:". $specification;
								echo "<br>";
							echo "</td><td>"; 
								$price=$value['Price'];
								echo "Rs".$price."/-";
								echo "<br>";
								echo "</td><td>"; 
								$image ='<a id="selectitem" href="selectitem.php?Name='.$value['Name'].'"><img src="data:image/jpeg;base64,'.base64_encode( $value['Image'] ).'"/></a>';
								echo $image;
								echo "<br>";
								echo "</td><td>"; 
								echo ' <a  href="selectitem.php?Name='.$value['Name'].'" id="updateclick" class="btn btn-success btn-primary btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span> Select to Buy</a>'; 	
								echo "<hr>";
								echo "</td></tr>";
							
								}
						
						//var_dump($result);						
						//$count = $stmt->rowCount();
						//return $stmtobj;	
						
	}
	
	 function BookQuery($connvariable,$email,$mobile,$token,$address)
	 {
			
					$stmt=$connvariable->prepare("INSERT INTO shoppingbook (email,mobile,token,address)
					VALUES ('$email','$mobile','$token','$address')");
					$stmt->execute();
					//$result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
					//$result=$stmt->fetchColumn();
					//$count=$stmt-rowCount();
						$_SESSION["tokencode"] = "$token";
					//	$_SESSION["emailid"]='$email';
					header("Location:buycode.php");
				
					
					 
	 }
 }
 ?>

