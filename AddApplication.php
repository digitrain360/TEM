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
				      <a class="nav-link" href="HomePage.html"><span class="badge badge-pill badge-primary">Home</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="#"><span class="badge badge-pill badge-secondary">Environments</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="#"><span class="badge badge-pill badge-secondary">Applications</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="#"><span class="badge badge-pill badge-secondary">Servers</span></a>
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
						<a class="nav-link" href="#">Allocations</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">App Instances</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="#">Add Application</a>
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
	      				<label for="Application ID">Application ID:</label>
	      				<input type="text" class="form-control" id="Application_ID" placeholder="Enter Application ID" name="Application_ID">
	      				<p><span class="error">* <?php echo $AppIDErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Application Name">Application Name:</label>
	      				<input type="text" class="form-control" id="Application_Name" placeholder="Enter Application Name" name="Application_Name">
	      				<p><span class="error">* <?php echo $AppNameErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Application Type">Application Type:</label>
	      				<input type="text" class="form-control" id="Application_Type" placeholder="Enter Application Type" name="Application_Type">
	      				<p><span class="error">* <?php echo $AppTypeErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Application Category">Application Category:</label>
	      				<input type="text" class="form-control" id="Application_Category" placeholder="Enter Application Category" name="Application_Category">
	      				<p><span class="error">* <?php echo $AppCatErr;?></span></p>
	    			</div>
	    			<div class="form-group">
	      				<label for="Prog Language">Programming Language:</label>
	      				<input type="text" class="form-control" id="Application_Prog_Language" placeholder="Enter Programming Language" name="Application_Prog_Language">
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