<!DOCTYPE html>
<html lang="en">
<head>
  <title>Test Environment Manager</title>
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
$Server_ID_Err = $Server_Name_Err = $Server_IP_Address_Err = $Server_Location_Err = $Server_Type_Err = $Server_Util_Type_Err = $Server_CPU_Err = $Server_RAM_Err = $Server_Storage_Allocation_Err = $Server_OS_Err = "";
$Server_ID = $Server_Name = $Server_IP_Address = $Server_Location = $Server_Type = $Server_Util_Type = $Server_CPU = $Server_RAM = $Server_Storage_Allocation = $Server_OS = "";
$insertSqlDBStatus = "";
$ValidationStatus = "Success";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $insertSqlDBStatus = "Inside POST";
    if ($_POST['btn_submit']=="AddServer"){
        $insertSqlDBStatus ="Inside AddServer";
        if (empty($_POST["Server_ID"])) {
            $Server_ID_Err = "Server ID is required";
            $ValidationStatus = "Error";
        } else {
            $Server_ID = test_input($_POST["Server_ID"]);
        }

        if (empty($_POST["Server_Name"])) {
            $Server_Name_Err = "Server Name is required";
            $ValidationStatus = "Error";
        } else {
            $Server_Name = test_input($_POST["Server_Name"]);
        }
  
        if (empty($_POST["Server_IP_Address"])) {
            $Server_IP_Address_Err = "Server IP Address is required";
            $ValidationStatus = "Error";
        } else {
            $Server_IP_Address = test_input($_POST["Server_IP_Address"]);
        }

        if (empty($_POST["Server_Type"])) {
            $Server_Type_Err = "Server Type is Required";
            $ValidationStatus = "Error";
        } else {
            $Server_Type = test_input($_POST["Server_Type"]);
        }

        if (empty($_POST["Server_Util_Type"])) {
            $Server_Util_Type_Err = "Server Utilization Type is required";
            $ValidationStatus = "Error";
        } else {
            $Server_Util_Type = test_input($_POST["Server_Util_Type"]);
        }
        
        if (empty($_POST["Server_OS"])) {
            $Server_OS_Err = "Server Operation System is required";
            $ValidationStatus = "Error";
        } else {
            $Server_OS = test_input($_POST["Server_OS"]);
        }
          
        if (empty($_POST["Server_Location"])) {
            $Server_Location_Err = "Server Location is required";
            $ValidationStatus = "Error";
        } else {
            $Server_Location = test_input($_POST["Server_Location"]);
        }
          
        if (empty($_POST["Server_CPU"])) {
            $Server_CPU_Err = "Server CPU Details are required";
            $ValidationStatus = "Error";
        } else {
            $Server_CPU = test_input($_POST["Server_CPU"]);
        }
          
        if (empty($_POST["Server_RAM"])) {
            $Server_RAM_Err = "Server RAM details are required";
            $ValidationStatus = "Error";
        } else {
            $Server_RAM = test_input($_POST["Server_RAM"]);
        }
          
        if (empty($_POST["Server_Storage_Allocation"])) {
            $Server_Storage_Allocation_Err = "Server Storage Allocation details are required";
            $ValidationStatus = "Error";
        } else {
            $Server_Storage_Allocation = test_input($_POST["Server_Storage_Allocation"]);
        }
        
        if ($ValidationStatus == "Success"){
            $insertSqlDBStatus = insert_db($Server_ID,$Server_Name,$Server_IP_Address,$Server_Location,$Server_Type,$Server_Util_Type,$Server_CPU,$Server_RAM,$Server_Storage_Allocation,$Server_OS);
        }
    }
    if ($_POST['btn_submit']=="UpdateSearch"){
        if (empty($_POST["Server_ID"])) {
            $Server_ID_Err = "Server ID is required";
            $ValidationStatus = "Error";
        } else {
            $Server_ID = test_input($_POST["Server_ID"]);
        }
        
        if ($ValidationStatus == "Success"){
            $Update_Search_Result = Retrieve_Server_Details($Server_ID,$Server_Name,$Server_IP_Address,$Server_Location,$Server_Type,$Server_Util_Type,$Server_CPU,$Server_RAM,$Server_Storage_Allocation,$Server_OS);;
        }
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function insert_db($Server_ID,$Server_Name,$Server_IP_Address,$Server_Location,$Server_Type,$Server_Util_Type,$Server_CPU,$Server_RAM,$Server_Storage_Allocation,$Server_OS) 
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
    	$sql = "INSERT INTO server (Server_ID,Server_Name,Server_IP_Address,Server_Location,Server_Type,Server_Util_Type,Server_CPU,Server_RAM,Server_Storage_Allocation,Server_OS)
    	VALUES ('$Server_ID','$Server_Name','$Server_IP_Address','$Server_Location','$Server_Type','$Server_Util_Type','$Server_CPU','$Server_RAM','$Server_Storage_Allocation','$Server_OS')";
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

function Retrieve_Server_Details($Server_ID,$Server_Name,$Server_IP_Address,$Server_Location,$Server_Type,$Server_Util_Type,$Server_CPU,$Server_RAM,$Server_Storage_Allocation,$Server_OS)
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
        $sql = "SELECT Server_ID, Server_Name, Server_IP_Address, Server_Location, Server_Type, Server_Util_Type, Server_CPU, Server_RAM, Server_Storage_Allocation, Server_OS FROM server Where Server_ID = $Server_ID";
        //,'$Server_Name','$Server_IP_Address','$Server_Location','$Server_Type', '$Server_Util_Type','$Server_CPU','$Server_RAM','$Server_Storage_Allocation','$Server_OS')";
        // use exec() because no results are returned
        $result=$conn->exec($sql);
        if ($result->num_rows > 0){
            $rowcount = $result->num_rows;
            $row = $result->fetch_assoc();
            $Server_ID = $row["Server_ID"];
            $Server_Name = $row["Server_Name"];
            $Server_IP_Address = $row["Server_IP_Address"];
            $Server_Location = $row["Server_Location"];
            $Server_Type = $row["Server_Type"];
            $Server_Util_Type = $row["Server_Util_Type"];
            $Server_CPU = $row["Server_CPU"];
            $Server_RAM = $row["Server_RAM"];
            $Server_Storage_Allocation = $row["Server_Storage_Allocation"];
            $Server_OS = $row["Server_OS"];
        }
        $retrieveresult = "Success " . "<br>" . $sql . "<br>" . $rowcount;
    }
    catch(PDOException $e)
    {
        $result= $sql . "<br>" . $e->getMessage();
    }
    
    $conn = null;
    return $retrieveresult;
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
						<a class="nav-link active" href="ManageServers.php">Manage Servers</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Servers Report</a>
					</li>					
				</ul>
				<hr class="d-sm-none">
			</div>
			<div class="col-sm-10">
			<div class="container mt-3">
  				<h2>Manage Servers</h2>
  				<br>
                <!-- Nav tabs -->
  				<ul class="nav nav-tabs">
    				<li class="nav-item">
      					<a class="nav-link" data-toggle="tab" href="#Add">Add</a>
    				</li>
    				<li class="nav-item">
      					<a class="nav-link active" data-toggle="tab" href="#Update">Update</a>
    				</li>
    				<li class="nav-item">
      					<a class="nav-link" data-toggle="tab" href="#Remove">Remove</a>
    				</li>
  				</ul>
			
				<div class="tab-content">
					<div class="tab-pane fade container" id="Add">
						<h1> Please enter details below and press submit</h1>
						<p><span class="error">* required field</span></p>
			             <!-- <form method="post" action="/action_page.php">  -->
				 		<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
	    					<div class="form-group">
	      						<label for="Server ID">Server ID:</label>
	      						<input type="text" class="form-control" id="Server_ID" placeholder="Enter Server ID" name="Server_ID">
	      						<p><span class="error">* <?php echo $Server_ID_Err;?></span></p>
	    					</div>
        	    			<div class="form-group">
        	      				<label for="Server Name">Server Name:</label>
        	      				<input type="text" class="form-control" id="Server_Name" placeholder="Enter Server Name" name="Server_Name">
        	      				<p><span class="error">* <?php echo $Server_Name_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server IP Address">Server IP Address:</label>
        	      				<input type="text" class="form-control" id="Server_IP_Address" placeholder="Enter Server IP Address" name="Server_IP_Address">
        	      				<p><span class="error">* <?php echo $Server_IP_Address_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Type">Server Type:</label>
        	      				<input type="text" class="form-control" id="Server_Type" placeholder="Enter Server Type" name="Server_Type">
        	      				<p><span class="error">* <?php echo $Server_Type_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Utilization Type">Server Utilization Type:</label>
        	      				<input type="text" class="form-control" id="Server_Util_Type" placeholder="Enter Server Utilization Type" name="Server_Util_Type">
        	      				<p><span class="error">* <?php echo $Server_Util_Type_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Operating System">Server Operating System:</label>
        	      				<input type="text" class="form-control" id="Server_OS" placeholder="Enter Server Operating System" name="Server_OS">
        	      				<p><span class="error">* <?php echo $Server_OS_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Location">Server Location:</label>
        	      				<input type="text" class="form-control" id="Server_Location" placeholder="Enter Server Location" name="Server_Location">
        	      				<p><span class="error">* <?php echo $Server_Location_Err;?></span></p>
        	    			</div>
			    			<div class="form-group">
	    		  				<label for="Server CPU">Server CPUs:</label>
	      						<input type="text" class="form-control" id="Server_CPU" placeholder="Enter Server CPUs" name="Server_CPU">
	      						<p><span class="error">* <?php echo $Server_CPU_Err;?></span></p>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server RAM">Server RAM Allocation:</label>
	      						<input type="text" class="form-control" id="Server_RAM" placeholder="Enter Server RAM Allocation" name="Server_RAM">
	      						<p><span class="error">* <?php echo $Server_RAM_Err;?></span></p>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server Storage Allocation">Server Storage Allocation:</label>
	      						<input type="text" class="form-control" id="Server_Storage_Allocation" placeholder="Enter Server Storage Allocation" name="Server_Storage_Allocation">
	      						<p><span class="error">* <?php echo $Server_Storage_Allocation_Err;?></span></p>
	    					</div>
	    					<button type="submit" class="btn btn-primary" name="btn_submit" value="AddServer">Add Server</button>
	    					<?php
					           echo "<h4>Result</h4>";
					           echo $insertSqlDBStatus;
				            ?>
	    				</form>
	    			</div>
	    			<div class="tab-pane container active" id="Update">
	    				<h1> Enter Server ID or Name and Press Search</h1>
						<p><span class="error">* required field</span></p>
			             <!-- <form method="post" action="/action_page.php">  -->
				 		<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				 			<?php 
                                if ($Update_Search_Result == "Success"){
                                    $disabled = "";
                                } else{
                                    $disabled = 'disabled';
                                }
                            ?>
	    					<div class="form-group">
	      						<label for="Server ID">Server ID:</label>
	      						<input type="text" class="form-control" id="Server_ID" name="Server_ID">
	      						<p><span class="error">* <?php echo $Server_ID_Err;?></span></p>
	    					</div>
        	    			<div class="form-group">
        	      				<label for="Server Name">Server Name:</label>
        	      				<input type="text" class="form-control" id="Server_Name" name="Server_Name" value="<?php echo $Server_Name ?>" <?php echo $disabled; ?>>
        	      				<p><span class="error"><?php echo $Server_Name_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server IP Address">Server IP Address:</label>
        	      				<input type="text" class="form-control" id="Server_IP_Address" name="Server_IP_Address" value="<?php echo $Server_IP_Address ?>" <?php echo $disabled; ?>>
        	      				<p><span class="error"><?php echo $Server_IP_Address_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Type">Server Type:</label>
        	      				<input type="text" class="form-control" id="Server_Type" name="Server_Type" value="<?php echo $Server_Type ?>" <?php echo $disabled; ?>>
        	      				<p><span class="error"><?php echo $Server_Type_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Utilization Type">Server Utilization Type:</label>
        	      				<input type="text" class="form-control" id="Server_Util_Type" name="Server_Util_Type" value="<?php echo $Server_Util_Type ?>" <?php echo $disabled; ?>>
        	      				<p><span class="error"><?php echo $Server_Util_Type_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Operating System">Server Operating System:</label>
        	      				<input type="text" class="form-control" id="Server_OS" name="Server_OS" value="<?php echo $Server_OS ?>" <?php echo $disabled; ?>>
        	      				<p><span class="error"><?php echo $Server_OS_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Location">Server Location:</label>
        	      				<input type="text" class="form-control" id="Server_Location" name="Server_Location" value="<?php echo $Server_Location ?>" <?php echo $disabled; ?>>
        	      				<p><span class="error"><?php echo $Server_Location_Err;?></span></p>
        	    			</div>
			    			<div class="form-group">
	    		  				<label for="Server CPU">Server CPUs:</label>
	      						<input type="text" class="form-control" id="Server_CPU" name="Server_CPU" value="<?php echo $Server_CPU ?>" <?php echo $disabled; ?>>
	      						<p><span class="error"><?php echo $Server_CPU_Err;?></span></p>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server RAM">Server RAM Allocation:</label>
	      						<input type="text" class="form-control" id="Server_RAM" name="Server_RAM"  value="<?php echo $Server_RAM ?>" <?php echo $disabled; ?>>
	      						<p><span class="error"><?php echo $Server_RAM_Err;?></span></p>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server Storage Allocation">Server Storage Allocation:</label>
	      						<input type="text" class="form-control" id="Server_Storage_Allocation" name="Server_Storage_Allocation" value="<?php $Server_Storage_Allocation ?>" <?php echo $disabled; ?>>
	      						<p><span class="error"><?php echo $Server_Storage_Allocation_Err;?></span></p>
	    					</div>
	    					<button type="submit" name="btn_submit" id="UpdateSearch" class="btn btn-primary" value="UpdateSearch">Search</button>
	    					<button type="submit" name="btn_submit" id="UpdateServer" class="btn btn-primary" value="UpdateServer" disabled>Update</button>
	    					<?php
					           echo "<h4>Result</h4>";
					           echo $disabled;
					           echo $Update_Search_Result;
					           echo $Server_ID;
					           echo $Server_Name;
					           echo $Server_IP_Address;
					           echo $Server_Location;
					           echo $Server_Type;
					           echo $Server_Util_Type;
					           echo $Server_CPU;
					           echo $Server_RAM;
					           echo $Server_Storage_Allocation;
					           echo $Server_OS;
				            ?>
				          </form>
					</div>
	    			<div class="tab-pane container fade" id="Remove">
	    				<h5> Enter ID or Name of the Server to be removed and Press Search</h5>
						<p><span class="error">* required field</span></p>
			             <!-- <form method="post" action="/action_page.php">  -->
				 		<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
	    					<div class="form-group">
	      						<label for="Server ID">Server ID:</label>
	      						<input type="text" class="form-control" id="Server_ID" placeholder="Enter Server ID" name="Server_ID">
	      						<p><span class="error">* <?php echo $Server_ID_Err;?></span></p>
	    					</div>
        	    			<div class="form-group">
        	      				<label for="Server Name">Server Name:</label>
        	      				<input type="text" class="form-control" id="Server_Name" placeholder="Enter Server Name" name="Server_Name">
        	      				<p><span class="error">* <?php echo $Server_Name_Err;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server IP Address">Server IP Address:</label>
        	      				<input type="text" class="form-control" id="Server_IP_Address" placeholder="Enter Server IP Address" name="Server_IP_Address" disabled>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Type">Server Type:</label>
        	      				<input type="text" class="form-control" id="Server_Type" placeholder="Enter Server Type" name="Server_Type" disabled>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Utilization Type">Server Utilization Type:</label>
        	      				<input type="text" class="form-control" id="Server_Util_Type" placeholder="Enter Server Utilization Type" name="Server_Util_Type" disabled>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Operating System">Server Operating System:</label>
        	      				<input type="text" class="form-control" id="Server_OS" placeholder="Enter Server Operating System" name="Server_OS" disabled>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Location">Server Location:</label>
        	      				<input type="text" class="form-control" id="Server_Location" placeholder="Enter Server Location" name="Server_Location" disabled>
        	    			</div>
			    			<div class="form-group">
	    		  				<label for="Server CPU">Server CPUs:</label>
	      						<input type="text" class="form-control" id="Server_CPU" placeholder="Enter Server CPUs" name="Server_CPU" disabled>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server RAM">Server RAM Allocation:</label>
	      						<input type="text" class="form-control" id="Server_RAM" placeholder="Enter Server RAM Allocation" name="Server_RAM" disabled>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server Storage Allocation">Server Storage Allocation:</label>
	      						<input type="text" class="form-control" id="Server_Storage_Allocation" placeholder="Enter Server Storage Allocation" name="Server_Storage_Allocation" disabled>
	    					</div>
	    					<button type="button" name="btn_submit" id="RemoveSearch" class="btn btn-primary" value="RemoveSearch">Search</button>
	    					<button type="button" name="btn_submit" id="RemoveServer" class="btn btn-primary" value="RemoveServer" disabled>Remove</button>
				           </form>
	    			</div>
	    		</div>
			</div>
		</div>
		</div>
	</div>
</body>
</html>