<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
	.error {color: #FF0000;}
  </style>
</head>
<body>
<?php
// define variables and set to empty values
$AppIDErr = $AppNameErr = $AppTypeErr = $AppCatErr = $AppProgLangErr = "";
$Application_ID = $Application_Name = $Application_Type = $Application_Category = $Application_Prog_Language = "";
$insertSqlDBStatus = "";
$ValidationStatus = "Success";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Application_ID"])) {
    $AppIDErr = "Application ID is required";
    $ValidationStatus = "Error";
  } else {
      $Application_ID = test_input($_POST["Application_ID"]);
  }

  if (empty($_POST["Application_Name"])) {
    $AppNameErr = "Application Name is required";
    $ValidationStatus = "Error";
  } else {
    $Application_Name = test_input($_POST["Application_Name"]);
  }

  if (empty($_POST["Application_Type"])) {
      $AppTypeErr = "Application Type is Required";
    $ValidationStatus = "Error";
  } else {
      $Application_Type = test_input($_POST["Application_Type"]);
  }

  if (empty($_POST["Application_Category"])) {
    $AppCatErr = "Application Category is required";
    $ValidationStatus = "Error";
  } else {
    $Application_Category = test_input($_POST["Application_Category"]);
  }

  if (empty($_POST["Application_Prog_Language"])) {
    $AppProgLangErr = "Application Programming Language is required";
    $ValidationStatus = "Error";
  } else {
    $Application_Prog_Language = test_input($_POST["Application_Prog_Language"]);
  }

  if ($ValidationStatus == "Success"){
	$insertSqlDBStatus = insert_db($Application_ID,$Application_Name,$Application_Type,$Application_Category,$Application_Prog_Language);
	}

}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function insert_db($Application_ID,$Application_Name,$Application_Type,$Application_Category,$Application_Prog_Language) 
{
	$servername = "dtemdm01.mysql.database.azure.com";
	$username = "temdbmadm@dtemdm01";
	$password = "waheguru@1112";
	$options = array(
    	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    	PDO::MYSQL_ATTR_SSL_CA => '/SSL/BaltimoreCyberTrustRoot.crt',
    	PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
	);

/*	$servername = "localhost";
	$username = "root";
	$password = "temjul19";
	$dbname = "dbtemd01";*/
    $result = "";
	try {
	    $conn = new PDO("mysql:host=$servername;port=3306;dbname=dtemdb01", $username, $password, $options);
    	// set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$sql = "INSERT INTO application (Application_ID,Application_Name,Application_Type,Application_Category,Application_Prog_Language)
    	VALUES ('$Application_ID','$Application_Name','$Application_Type','$Application_Category','$Application_Prog_Language')";
    	// use exec() because no results are returned
    	$conn->exec($sql);
    	$result="Success";
    	}
	catch(PDOException $e)
    	{
    	$result= $sql . "<br>" . $e->getMessage();
    	}

	$conn = null;
	return $result;
}
?>
 <!--<div class="jumbotron text-center bg-primary">
		<h1>DIGITRAIN360</h1>
		<h2>IT Services Providers</h2>
	</div>
  -->
  	<div class="container">
  		<div class="row">
  			<div class="col-sm-2">
  				<img src="images\Logo1.png" class="img-fluid" alt="logo1">
  			</div>
			<div class="col-sm-10">
				<nav class="navbar navbar-expand-sm justify-content-right navbar-light top-fixed">
				  <ul class="navbar-nav">
				    <li class="nav-item">
				      <a class="nav-link" href="HomePage.html"><span class="badge badge-pill badge-secondary">Home</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="EnvHome.php"><span class="badge badge-pill badge-secondary">Environments</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="AppHome.php"><span class="badge badge-pill badge-secondary">Applications</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="ServerHome.php"><span class="badge badge-pill badge-secondary">Servers</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="#"><span class="badge badge-pill badge-secondary">Health Check</span></a>
				    </li>
				  </ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<ul class="nav nav-pills flex-column">
					<li class="nav-item">
						<a class="nav-link active" href="ManageServers.php">ManageServers</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Servers Report</a>
					</li>					
				</ul>
				<hr class="d-sm-none">
			</div>
			<div class="col-sm-10">
				<h1> Please enter details below and press submit</h1>
				<p><span class="error">* required field</span></p>
			<!-- <form method="post" action="/action_page.php">  -->
				 <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
	    			<div class="form-group">
	      				<label for="Server ID">Server ID:</label>
	      				<input type="text" class="form-control" id="Server_ID" placeholder="Enter Server ID" name="Server_ID">
	      				<p><span class="error">* <?php echo $ServerIDErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Server Name">Server Name:</label>
	      				<input type="text" class="form-control" id="Server_Name" placeholder="Enter Server Name" name="Server_Name">
	      				<p><span class="error">* <?php echo $AppNameErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Server IP Addres">Server Name:</label>
	      				<input type="text" class="form-control" id="Server_IP_Address" placeholder="Enter Server IP Address" name="Server_IP_Address">
	      				<p><span class="error">* <?php echo $AppNameErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Server Type">Server Type:</label>
	      				<input type="text" class="form-control" id="Server_Type" placeholder="Enter Server Type" name="Server_Type">
	      				<p><span class="error">* <?php echo $AppTypeErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Server Utilization Type">Server Utilization Type:</label>
	      				<input type="text" class="form-control" id="Server_Util_Type" placeholder="Enter Server Utilization Type" name="Server_Util_Type">
	      				<p><span class="error">* <?php echo $AppCatErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Server Operating System">Server Operating System:</label>
	      				<input type="text" class="form-control" id="Server_OS" placeholder="Enter Server Operating System" name="Server_OS">
	      				<p><span class="error">* <?php echo $AppProgLangErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Server Location">Server Location:</label>
	      				<input type="text" class="form-control" id="Server_Location" placeholder="Enter Server Location" name="Server_Location">
	      				<p><span class="error">* <?php echo $AppProgLangErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Server CPU">Server CPUs:</label>
	      				<input type="text" class="form-control" id="Server_OS" placeholder="Enter Server CPUs" name="Server_CPU">
	      				<p><span class="error">* <?php echo $AppProgLangErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Server RAM">Server RAM Allocation System:</label>
	      				<input type="text" class="form-control" id="Server_OS" placeholder="Enter Server RAM Allocation" name="Server_RAM">
	      				<p><span class="error">* <?php echo $AppProgLangErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Server Storage Allocation">Server Storage Allocation:</label>
	      				<input type="text" class="form-control" id="Server_OS" placeholder="Enter Server Storage Allocation" name="Server_Storage_Allocation">
	      				<p><span class="error">* <?php echo $AppProgLangErr;?></span></p>
	    			</div>
	    			<button type="submit" class="btn btn-primary">Submit</button>
	    		</form>
	    		<?php
					echo "<h2>Your Input:</h2>";
					echo $Application_ID;
					echo "<br>";
					echo $Application_Name;
					echo "<br>";
					echo $Application_Category;
					echo "<br>";
					echo $Application_Type;
					echo "<br>";
					echo $Application_Prog_Language;
					echo "<br>";
					echo $insertSqlDBStatus;
				?>
			</div>
		</div>
	</div>
</body>
</html>