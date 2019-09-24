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
//$Server_ID_Err = $Server_Name_Err = $Server_IP_Address_Err = $Server_Location_Err = $Server_Type_Err = $Server_Util_Type_Err = $Server_CPU_Err = $Server_RAM_Err = $Server_Storage_Allocation_Err = $Server_OS_Err = "";
//$Server_ID = $Server_Name = $Server_IP_Address = $Server_Location = $Server_Type = $Server_Util_Type = $Server_CPU = $Server_RAM = $Server_Storage_Allocation = $Server_OS = "";

//Variable definitions to hold Server Details
$addServerID = $addServerName = $addServerIPAddress = $addServerLocation = $addServerType = $addServerUtilType = $addServerCPU = $addServerRAM = $addServerStorageAllocation = $addServerOS = "";
$updateServerID = $updateServerName = $updateServerIPAddress = $updateServerLocation = $updateServerType = $updateServerUtilType = $updateServerCPU = $updateServerRAM = $updateServerStorageAllocation = $updateServerOS = "";
$removeServerID = $removeServerName = $removeServerIPAddress = $removeServerLocation = $removeServerType = $removeServerUtilType = $removeServerCPU = $removeServerRAM = $removeServerStorageAllocation = $removeServerOS = "";
$retrieveServerID = $retrieveServerName = $retrieveServerIPAddress = $retrieveServerLocation = $retrieveServerType = $retrieveServerUtilType = $retrieveServerCPU = $retrieveServerRAM = $retrieveServerStorageAllocation = $retrieveServerOS = "";$insertSqlDBStatus = "";

//Variables definitions to hold error messages
$addServerIDErr = $addServerNameErr = $addServerIPAddressErr = $addServerLocationErr = $addServerTypeErr = $addServerUtilTypeErr = $addServerCPUErr = $addServerRAMErr = $addServerStorageAllocationErr = $addServerOSErr = "";
$updateServerIDErr = $updateServerNameErr = $updateServerIPAddressErr = $updateServerLocationErr = $updateServerTypeErr = $updateServerUtilTypeErr = $updateServerCPUErr = $updateServerRAMErr = $updateServerStorageAllocationErr = $updateServerOSErr = "";
$removeServerIDErr = $removeServerNameErr = $removeServerIPAddressErr = $removeServerLocationErr = $removeServerTypeErr = $removeServerUtilTypeErr = $removeServerCPUErr = $removeServerRAMErr = $removeServerStorageAllocationErr = $removeServerOSErr = "";


$ValidationStatus = "Success";
$addPaneActive = "active";
$updatePaneActive = "";
$RemovePaneActive = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['btn_submit']=="AddServer"){
        $addPaneActive = "active";
        $RemovePaneActive = "";
        $updatePaneActive = "";
        if (empty($_POST["addServerID"])) {
            $addServerIDErr = "Server ID is required";
            $ValidationStatus = "Error";
        } else {
            $addServerID = test_input($_POST["addServerID"]);
        }

        if (empty($_POST["addServerName"])) {
            $addServerNameErr = "Server Name is required";
            $ValidationStatus = "Error";
        } else {
            $addServerName = test_input($_POST["addServerName"]);
        }
  
        if (empty($_POST["addServerIPAddress"])) {
            $addServerIPAddressErr = "Server IP Address is required";
            $ValidationStatus = "Error";
        } else {
            $addServerIPAddress = test_input($_POST["addServerIPAddress"]);
        }

        if (empty($_POST["addServerType"])) {
            $addServerTypeErr = "Server Type is Required";
            $ValidationStatus = "Error";
        } else {
            $addServerType = test_input($_POST["addServerType"]);
        }

        if (empty($_POST["addServerUtilType"])) {
            $addServerUtilTypeErr = "Server Utilization Type is required";
            $ValidationStatus = "Error";
        } else {
            $addServerUtilType = test_input($_POST["addServerUtilType"]);
        }
        
        if (empty($_POST["addServerOS"])) {
            $addServerOSErr = "Server Operation System is required";
            $ValidationStatus = "Error";
        } else {
            $addServerOS = test_input($_POST["addServerOS"]);
        }
          
        if (empty($_POST["addServerLocation"])) {
            $addServerLocationErr = "Server Location is required";
            $ValidationStatus = "Error";
        } else {
            $addServerLocation = test_input($_POST["addServerLocation"]);
        }
          
        if (empty($_POST["addServerCPU"])) {
            $addServerCPUErr = "Server CPU Details are required";
            $ValidationStatus = "Error";
        } else {
            $addServerCPU = test_input($_POST["addServerCPU"]);
        }
          
        if (empty($_POST["addServerRAM"])) {
            $addServerRAMErr = "Server RAM details are required";
            $ValidationStatus = "Error";
        } else {
            $addServerRAM = test_input($_POST["addServerRAM"]);
        }
          
        if (empty($_POST["addServerStorageAllocation"])) {
            $addServerStorageAllocationErr = "Server Storage Allocation details are required";
            $ValidationStatus = "Error";
        } else {
            $addServerStorageAllocation = test_input($_POST["addServerStorageAllocation"]);
        }
        
        if ($ValidationStatus == "Success"){
            $insertSqlDBStatus = insert_db($addServerID,$addServerName,$addServerIPAddress,$addServerLocation,$addServerType,$addServerUtilType,$addServerCPU,$addServerRAM,$addServerStorageAllocation,$addServerOS);
        } else{
            $insertSqlDBStatus = "ValidationFailed";
        }
    }
    if ($_POST['btn_submit']=="UpdateSearch"){
        $updatePaneActive = "active";
        $RemovePaneActive = "";
        $addPaneActive = "";
        if (empty($_POST["updateServerID"])) {
            $updateServerIDErr = "Server ID is required";
            $ValidationStatus = "Error";
        } else {
            $updateServerID = test_input($_POST["updateServerID"]);
        }
        
        if ($ValidationStatus == "Success"){
            $retrieveServerID = $updateServerID;
            $Update_Search_Result = Retrieve_Server_Details($retrieveServerID);
            if ($Update_Search_Result == "Success"){
                $updateServerID = $retrieveServerID;
                $updateServerName = $retrieveServerName;
                $updateServerIPAddress = $retrieveServerIPAddress;
                $updateServerLocation = $retrieveServerLocation;
                $updateServerType = $retrieveServerType;
                $updateServerUtilType = $retrieveServerUtilType;
                $updateServerCPU = $retrieveServerCPU;
                $updateServerRAM = $retrieveServerRAM;
                $updateServerStorageAllocation = $retrieveServerStorageAllocation;
                $updateServerOS = $retrieveServerOS;
            }
        }
    }
    if ($_POST['btn_submit']=="UpdateServer"){
        $updatePaneActive = "active";
        $RemovePaneActive = "";
        $addPaneActive = "";
        $UpdateSqlDBStatus = "Inside Update Server";
        if (empty($_POST["updateServerID"])) {
            $updateServerIDErr = "Server ID is required";
            $ValidationStatus = "Error";
        } else {
            $updateServerID = test_input($_POST["updateServerID"]);
        }
        
        if (empty($_POST["updateServerName"])) {
            $updateServerNameErr = "Server Name is required";
            $ValidationStatus = "Error";
        } else {
            $updateServerName = test_input($_POST["updateServerName"]);
        }
        
        if (empty($_POST["updateServerIPAddress"])) {
            $updateServerIPAddressErr = "Server IP Address is required";
            $ValidationStatus = "Error";
        } else {
            $updateServerIPAddress = test_input($_POST["updateServerIPAddress"]);
        }
        
        if (empty($_POST["updateServerType"])) {
            $updateServerTypeErr = "Server Type is Required";
            $ValidationStatus = "Error";
        } else {
            $updateServerType = test_input($_POST["updateServerType"]);
        }
        
        if (empty($_POST["updateServerUtilType"])) {
            $updateServerUtilTypeErr = "Server Utilization Type is required";
            $ValidationStatus = "Error";
        } else {
            $updateServerUtilType = test_input($_POST["updateServerUtilType"]);
        }
        
        if (empty($_POST["updateServerOS"])) {
            $updateServerOSErr = "Server Operation System is required";
            $ValidationStatus = "Error";
        } else {
            $updateServerOS = test_input($_POST["updateServerOS"]);
        }
        
        if (empty($_POST["updateServerLocation"])) {
            $updateServerLocationErr = "Server Location is required";
            $ValidationStatus = "Error";
        } else {
            $updateServerLocation = test_input($_POST["updateServerLocation"]);
        }
        
        if (empty($_POST["updateServerCPU"])) {
            $updateServerCPUErr = "Server CPU Details are required";
            $ValidationStatus = "Error";
        } else {
            $updateServerCPU = test_input($_POST["updateServerCPU"]);
        }
        
        if (empty($_POST["updateServerRAM"])) {
            $updateServerRAMErr = "Server RAM details are required";
            $ValidationStatus = "Error";
        } else {
            $updateServerRAM = test_input($_POST["updateServerRAM"]);
        }
        
        if (empty($_POST["updateServerStorageAllocation"])) {
            $updateServerStorageAllocationErr = "Server Storage Allocation details are required";
            $ValidationStatus = "Error";
        } else {
            $updateServerStorageAllocation = test_input($_POST["updateServerStorageAllocation"]);
        }
        
        if ($ValidationStatus == "Success"){
            $UpdateSqlDBStatus = "Validation Successfull";
            $UpdateSqlDBStatus = Update_Server_Details($updateServerID,$updateServerName,$updateServerIPAddress,$updateServerLocation,$updateServerType,$updateServerUtilType,$updateServerCPU,$updateServerRAM,$updateServerStorageAllocation,$updateServerOS);
        } else {
            $UpdateSqlDBStatus = "Validation Failed";
        }
    }
    
    if ($_POST['btn_submit']=="RemoveSearch"){
        $RemovePaneActive = "active";
        $updatePaneActive = "";
        $addPaneActive = "";
        if (empty($_POST["removeServerID"])) {
            $removeServerIDErr = "Server ID is required";
            $ValidationStatus = "Error";
        } else {
            $removeServerID = test_input($_POST["removeServerID"]);
        }
        
        if ($ValidationStatus == "Success"){
            $retrieveServerID = $removeServerID;
            $Remove_Search_Result = Retrieve_Server_Details($retrieveServerID);
            if ($Remove_Search_Result == "Success"){
                $removeServerID = $retrieveServerID;
                $removeServerName = $retrieveServerName;
                $removeServerIPAddress = $retrieveServerIPAddress;
                $removeServerLocation = $retrieveServerLocation;
                $removeServerType = $retrieveServerType;
                $removeServerUtilType = $retrieveServerUtilType;
                $removeServerCPU = $retrieveServerCPU;
                $removeServerRAM = $retrieveServerRAM;
                $removeServerStorageAllocation = $retrieveServerStorageAllocation;
                $removeServerOS = $retrieveServerOS;
            }
            //$DataRetrieved = $Server_Name . " " . $Server_IP_Address . " " . $Server_Location . " " . $Server_Type . " " . $Server_Util_Type . " " . $Server_CPU . " " . $Server_RAM . " " . $Server_Storage_Allocation . " " . $Server_OS;
        }
    }
    if ($_POST['btn_submit']=="RemoveServer"){
        $RemovePaneActive = "active";
        $updatePaneActive = "";
        $addPaneActive = "";
        if (empty($_POST["removeServerID"])) {
            $removeServerIDErr = "Server ID is required";
            $ValidationStatus = "Error";
        } else {
            $removeServerID = test_input($_POST["removeServerID"]);
        }
        $RemoveSqlDBStatus = Remove_Server_Details($removeServerID);
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function insert_db($addServerID,$addServerName,$addServerIPAddress,$addServerLocation,$addServerType,$addServerUtilType,$addServerCPU,$addServerRAM,$addServerStorageAllocation,$addServerOS) 
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
    	VALUES ('$addServerID','$addServerName','$addServerIPAddress','$addServerLocation','$addServerType','$addServerUtilType','$addServerCPU','$addServerRAM','$addServerStorageAllocation','$addServerOS')";
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

function Remove_Server_Details($removeServerID)
{
    $servername = "dtemdm01.mysql.database.azure.com";
    $username = "temdbmadm@dtemdm01";
    $password = "waheguru@1112";
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::MYSQL_ATTR_SSL_CA => '/SSL/BaltimoreCyberTrustRoot.crt',
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    );
    
    /*$servername = "localhost";
     $username = "root";
     $password = "temjul19";
     $dbname = "dbtemd01";*/
    $result = "";
    try {
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=dtemdb01", $username, $password, $options);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM server where Server_ID = '$removeServerID'";
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

function Retrieve_Server_Details($retrieveServerID)
{
    global $retrieveServerID,$retrieveServerName,$retrieveServerIPAddress,$retrieveServerLocation,$retrieveServerType,$retrieveServerUtilType,$retrieveServerCPU,$retrieveServerRAM,$retrieveServerStorageAllocation,$retrieveServerOS;
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
    //$result = "";
    try {
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=dtemdb01", $username, $password, $options);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM server Where Server_ID = '$retrieveServerID'";
        // use exec() because no results are returned
        $rowcount = 1;
        $retrieveresult = "<br> SQL IS: " . $sql . "<br> Row Count: " . $rowcount . "<br> Data:";
        foreach($conn->query($sql) as $row){
            $retrieveServerID = $row["Server_ID"];
            $retrieveServerName = $row["Server_Name"];
            $retrieveServerIPAddress = $row["Server_IP_Address"];
            $retrieveServerLocation = $row["Server_Location"];
            $retrieveServerType = $row["Server_Type"];
            $retrieveServerUtilType = $row["Server_Util_Type"];
            $retrieveServerCPU = $row["Server_CPU"];
            $retrieveServerRAM = $row["Server_RAM"];
            $retrieveServerStorageAllocation = $row["Server_Storage_Allocation"];
            $retrieveServerOS = $row["Server_OS"];
            $retrieveresult = "Success";
        }
    }
    catch(PDOException $e)
    {
        $retrieveresult= $sql . "<br>" . $e->getMessage();
    }
    
    $conn = null;
    return $retrieveresult;
}

function Update_Server_Details($updateServerID,$updateServerName,$updateServerIPAddress,$updateServerLocation,$updateServerType,$updateServerUtilType,$updateServerCPU,$updateServerRAM,$updateServerStorageAllocation,$updateServerOS)
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
    $UpdateResult = "";
    try {
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=dtemdb01", $username, $password, $options);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE server 
                SET 
                    Server_Name = '$updateServerName',
                    Server_IP_Address = '$updateServerIPAddress',
                    Server_Location = '$updateServerLocation',
                    Server_Type = '$updateServerType',
                    Server_Util_Type = '$updateServerUtilType',
                    Server_CPU = '$updateServerCPU',
                    Server_RAM = '$updateServerRAM',
                    Server_Storage_Allocation = '$updateServerStorageAllocation',
                    Server_OS = '$updateServerOS'
                WHERE Server_ID = '$updateServerID'"; 
        // use exec() because no results are returned
        $conn->exec($sql);
        $UpdateResult="Success";
    }
    catch(PDOException $e)
    {
        $UpdateResult = $sql . "<br>" . $e->getMessage();
    }
    
    $conn = null;
    return $UpdateResult;
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
      					<a class="nav-link <?php echo $addPaneActive?>" data-toggle="tab" href="#Add">Add</a>
    				</li>
    				<li class="nav-item">
      					<a class="nav-link <?php echo $updatePaneActive?>" data-toggle="tab" href="#Update">Update</a>
    				</li>
    				<li class="nav-item">
      					<a class="nav-link <?php echo $RemovePaneActive?>" data-toggle="tab" href="#Remove">Remove</a>
    				</li>
  				</ul>
			
				<div class="tab-content">
				<div class="tab-pane <?php echo $addPaneActive?> container" id="Add">
					    <?php
					      if ($insertSqlDBStatus == "Success"){
                                   $addFieldDisabled = "readonly";
                                   $addServerIDdisabled = "readonly";
                                   $UserMsg = "Add Server Result: " . $insertSqlDBStatus;
                                   $insertSqlDBStatus;
					       } else{
					           if($insertSqlDBStatus == "ValidationFailed"){
					               $addFieldDisabled = "";
					               $addServerIDdisabled = "";
					               $UserMsg = "Correct the Errors and Press Submit again";
					               $insertSqlDBStatus = "";
					           }else{
                                    $addFieldDisabled = "";
                                    $addServerIDdisabled = "";
                                    $UserMsg = "Enter the Server Details and Press Submit";
                                    $addServerID = "";
                                    $addServerID = $addServerName = $addServerIPAddress = $addServerLocation = $addServerType = $addServerUtilType = $addServerCPU = $addServerRAM = $addServerStorageAllocation = $addServerOS = "";
					           }
					      }
                        ?>
			             <!-- <form method="post" action="/action_page.php">  -->
				 		<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
							<h5> <?php echo $UserMsg?></h5>
							<p><span class="error">* required field</span></p>
	    					<div class="form-group">
	      						<label for="Server ID">Server ID:</label>
	      						<input type="text" class="form-control" id="addServerID" name="addServerID" value="<?php echo $addServerID ?>" <?php echo $addServerIDdisabled?>>
	      						<p><span class="error">* <?php echo $addServerIDErr;?></span></p>
	    					</div>
        	    			<div class="form-group">
        	      				<label for="Server Name">Server Name:</label>
        	      				<input type="text" class="form-control" id="addServerName" name="addServerName" value="<?php echo $addServerName ?>" <?php echo $addFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $addServerNameErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server IP Address">Server IP Address:</label>
        	      				<input type="text" class="form-control" id="addServer_IP_Address" name="addServerIPAddress" value="<?php echo $addServerIPAddress ?>" <?php echo $addFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $addServerIPAddressErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Type">Server Type:</label>
        	      				<input type="text" class="form-control" id="addServerType" name="addServerType" value="<?php echo $addServerType ?>" <?php echo $addFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $addServerTypeErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Utilization Type">Server Utilization Type:</label>
        	      				<input type="text" class="form-control" id="addServerUtilType" name="addServerUtilType" value="<?php echo $addServerUtilType ?>" <?php echo $addFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $addServerUtilTypeErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Operating System">Server Operating System:</label>
        	      				<input type="text" class="form-control" id="addServerOS" name="addServerOS" value="<?php echo $addServerOS ?>" <?php echo $addFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $addServerOSErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Location">Server Location:</label>
        	      				<input type="text" class="form-control" id="addServerLocation" name="addServerLocation" value="<?php echo $addServerLocation ?>" <?php echo $addFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $addServerLocationErr;?></span></p>
        	    			</div>
			    			<div class="form-group">
	    		  				<label for="Server CPU">Server CPUs:</label>
	      						<input type="text" class="form-control" id="addServerCPU" name="addServerCPU" value="<?php echo $addServerCPU ?>" <?php echo $addFieldDisabled; ?>>
	      						<p><span class="error"><?php echo $addServerCPUErr;?></span></p>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server RAM">Server RAM Allocation:</label>
	      						<input type="text" class="form-control" id="addServerRAM" name="addServerRAM"  value="<?php echo $addServerRAM ?>" <?php echo $addFieldDisabled; ?>>
	      						<p><span class="error"><?php echo $addServerRAMErr;?></span></p>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server Storage Allocation">Server Storage Allocation:</label>
	      						<input type="text" class="form-control" id="addServerStorageAllocation" name="addServerStorageAllocation" value="<?php echo $addServerStorageAllocation ?>" <?php echo $addFieldDisabled; ?>>
	      						<p><span class="error"><?php echo $addServerStorageAllocationErr;?></span></p>
	    					</div>
	    					<button type="submit" class="btn btn-primary" name="btn_submit" value="AddServer">Add Server</button>
	    					<button type="submit" name="btn_submit" id="AddClearData" class="btn btn-primary" value="AddClearData">Clear</button>
	    					<?php
					           echo "<h4>Result</h4>";
					           echo $insertSqlDBStatus;
				            ?>
	    				</form>
	    			</div>
	    			<div class="tab-pane container <?php echo $updatePaneActive?>" id="Update">
			             <!-- <form method="post" action="/action_page.php">  -->
				 		<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				 			<?php 
                                    if ($Update_Search_Result == "Success"){
                                        $updateFieldDisabled = "";
                                        $updateServerIDDisabled = "readonly";
                                        $Search_btn_disabled = "disabled";
                                        $Update_btn_disabled = "";
                                        $UserMsg = "Make changes to the attributes as needed and Press Update";
                                        $Update_Search_Result = "";
                                    } else {
                                        if ($UpdateSqlDBStatus == "Success")
                                        {
                                            $updateFieldDisabled = 'disabled';
                                            $updateServerIDDisabled = "";
                                            $Search_btn_disabled = "";
                                            $Update_btn_disabled = "disabled";
                                            $UserMsg = "Update Result: " . $UpdateSqlDBStatus;
                                            $UpdateSqlDBStatus = "";
                                        } else{
                                            $updateFieldDisabled = 'disabled';
                                            $updateServerIDDisabled = "";
                                            $Search_btn_disabled = "";
                                            $Update_btn_disabled = "disabled";
                                            $UserMsg = "Enter Server ID and Press Search";
                                            $updateServerID = $updateServerName = $updateServerIPAddress = $updateServerLocation = $updateServerType = $updateServerUtilType = $updateServerCPU = $updateServerRAM = $updateServerStorageAllocation = $updateServerOS = "";
                                    }
                            ?>
                            <h5><?php echo $UserMsg?></h5>
							<p><span class="error">* required field</span></p>
	    					<div class="form-group">
	      						<label for="Server ID">Server ID:</label>
	      						<input type="text" class="form-control" id="updateServerID" name="updateServerID" value="<?php echo $updateServerID ?>" <?php echo $updateServerIDDisabled?>>
	      						<p><span class="error">* <?php echo $updateServerIDErr;?></span></p>
	    					</div>
        	    			<div class="form-group">
        	      				<label for="Server Name">Server Name:</label>
        	      				<input type="text" class="form-control" id="updateServerName" name="updateServerName" value="<?php echo $updateServerName ?>" <?php echo $updateFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $updateServerNameErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server IP Address">Server IP Address:</label>
        	      				<input type="text" class="form-control" id="updateServer_IP_Address" name="updateServerIPAddress" value="<?php echo $updateServerIPAddress ?>" <?php echo $updateFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $updateServerIPAddressErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Type">Server Type:</label>
        	      				<input type="text" class="form-control" id="updateServerType" name="updateServerType" value="<?php echo $updateServerType ?>" <?php echo $updateFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $updateServerTypeErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Utilization Type">Server Utilization Type:</label>
        	      				<input type="text" class="form-control" id="updateServerUtilType" name="updateServerUtilType" value="<?php echo $updateServerUtilType ?>" <?php echo $updateFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $updateServerUtilTypeErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Operating System">Server Operating System:</label>
        	      				<input type="text" class="form-control" id="updateServerOS" name="updateServerOS" value="<?php echo $updateServerOS ?>" <?php echo $updateFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $updateServerOSErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Location">Server Location:</label>
        	      				<input type="text" class="form-control" id="updateServerLocation" name="updateServerLocation" value="<?php echo $updateServerLocation ?>" <?php echo $updateFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $updateServerLocationErr;?></span></p>
        	    			</div>
			    			<div class="form-group">
	    		  				<label for="Server CPU">Server CPUs:</label>
	      						<input type="text" class="form-control" id="updateServerCPU" name="updateServerCPU" value="<?php echo $updateServerCPU ?>" <?php echo $updateFieldDisabled; ?>>
	      						<p><span class="error"><?php echo $updateServerCPUErr;?></span></p>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server RAM">Server RAM Allocation:</label>
	      						<input type="text" class="form-control" id="updateServerRAM" name="updateServerRAM"  value="<?php echo $updateServerRAM ?>" <?php echo $updateFieldDisabled; ?>>
	      						<p><span class="error"><?php echo $updateServerRAMErr;?></span></p>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server Storage Allocation">Server Storage Allocation:</label>
	      						<input type="text" class="form-control" id="updateServerStorageAllocation" name="updateServerStorageAllocation" value="<?php echo $updateServerStorageAllocation ?>" <?php echo $updateFieldDisabled; ?>>
	      						<p><span class="error"><?php echo $updateServerStorageAllocationErr;?></span></p>
	    					</div>
	    					<button type="submit" name="btn_submit" id="UpdateSearch" class="btn btn-primary" value="UpdateSearch" <?php echo $Search_btn_disabled?>>Search</button>
	    					<button type="submit" name="btn_submit" id="UpdateServer" class="btn btn-primary" value="UpdateServer" <?php  echo $Update_btn_disabled?>>Update</button>
	    					<button type="submit" name="btn_submit" id="ClearData" class="btn btn-primary" value="ClearData">Clear</button>
				          </form>
					</div>
	    			<div class="tab-pane container <?php echo $RemovePaneActive?>" id="Remove">
			             <!-- <form method="post" action="/action_page.php">  -->
				 		<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				 			<?php 
                                    if ($Remove_Search_Result == "Success"){
                                        $removeFieldDisabled = "disabled";
                                        $removeServerIDDisabled = "readonly";
                                        $Search_btn_disabled = "disabled";
                                        $Remove_btn_disabled = "";
                                        $Remove_Search_Result = "";
                                        $UserMsg = "Press on Remove button to remove Server from Inventory";
                                        $removeCounter = $removeCounter + 1;
                                    } else {
                                        if ($RemoveSqlDBStatus == "Success")
                                        {
                                            $removeFieldDisabled = 'disabled';
                                            $removeServerIDDisabled = "";
                                            $Search_btn_disabled = "";
                                            $Remove_btn_disabled = "disabled";
                                            $UserMsg = "Remove Result: " . $RemoveSqlDBStatus;
                                            $RemoveSqlDBStatus = "";    
                                            $removeCounter = $removeCounter + 1;
                                        } else{
                                            $removeFieldDisabled = 'disabled';
                                            $removeServerIDDisabled = "";
                                            $Search_btn_disabled = "";
                                            $Remove_btn_disabled = "disabled";
                                            $removeServerID = "";
                                            $UserMsg = "Enter Server ID and Press Search";
                                            $removeServerID = $removeServerName = $removeServerIPAddress = $removeServerLocation = $removeServerType = $removeServerUtilType = $removeServerCPU = $removeServerRAM = $removeServerStorageAllocation = $removeServerOS = "";}
                                            $removeCounter = $removeCounter + 1;}
                                    }
                            ?>
                            <h5><?php echo $UserMsg?></h5>
                            <h5><?php echo $removeCounter?></h5>
							<p><span class="error">* required field</span></p>
	    					<div class="form-group">
	      						<label for="Server ID">Server ID:</label>
	      						<input type="text" class="form-control" id="removeServerID" name="removeServerID" value="<?php echo $removeServerID ?>" <?php echo $removeServerIDDisabled?>>
	      						<p><span class="error">* <?php echo $removeServerIDErr;?></span></p>
	    					</div>
        	    			<div class="form-group">
        	      				<label for="Server Name">Server Name:</label>
        	      				<input type="text" class="form-control" id="removeServerName" name="removeServerName" value="<?php echo $removeServerName ?>" <?php echo $removeFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $removeServerNameErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server IP Address">Server IP Address:</label>
        	      				<input type="text" class="form-control" id="removeServer_IP_Address" name="removeServerIPAddress" value="<?php echo $removeServerIPAddress ?>" <?php echo $removeFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $removeServerIPAddressErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Type">Server Type:</label>
        	      				<input type="text" class="form-control" id="removeServerType" name="removeServerType" value="<?php echo $removeServerType ?>" <?php echo $removeFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $removeServerTypeErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Utilization Type">Server Utilization Type:</label>
        	      				<input type="text" class="form-control" id="removeServerUtilType" name="removeServerUtilType" value="<?php echo $removeServerUtilType ?>" <?php echo $removeFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $removeServerUtilTypeErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Operating System">Server Operating System:</label>
        	      				<input type="text" class="form-control" id="removeServerOS" name="removeServerOS" value="<?php echo $removeServerOS ?>" <?php echo $removeFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $removeServerOSErr;?></span></p>
        	    			</div>
        	    			<div class="form-group">
        	      				<label for="Server Location">Server Location:</label>
        	      				<input type="text" class="form-control" id="removeServerLocation" name="removeServerLocation" value="<?php echo $removeServerLocation ?>" <?php echo $removeFieldDisabled; ?>>
        	      				<p><span class="error"><?php echo $removeServerLocationErr;?></span></p>
        	    			</div>
			    			<div class="form-group">
	    		  				<label for="Server CPU">Server CPUs:</label>
	      						<input type="text" class="form-control" id="removeServerCPU" name="removeServerCPU" value="<?php echo $removeServerCPU ?>" <?php echo $removeFieldDisabled; ?>>
	      						<p><span class="error"><?php echo $removeServerCPUErr;?></span></p>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server RAM">Server RAM Allocation:</label>
	      						<input type="text" class="form-control" id="removeServerRAM" name="removeServerRAM"  value="<?php echo $removeServerRAM ?>" <?php echo $removeFieldDisabled; ?>>
	      						<p><span class="error"><?php echo $removeServerRAMErr;?></span></p>
	    					</div>
	    					<div class="form-group">
	      						<label for="Server Storage Allocation">Server Storage Allocation:</label>
	      						<input type="text" class="form-control" id="removeServerStorageAllocation" name="removeServerStorageAllocation" value="<?php echo $removeServerStorageAllocation ?>" <?php echo $removeFieldDisabled; ?>>
	      						<p><span class="error"><?php echo $removeServerStorageAllocationErr;?></span></p>
	    					</div>
	    					<button type="submit" name="btn_submit" id="RemoveSearch" class="btn btn-primary" value="RemoveSearch" <?php echo $Search_btn_disabled?>>Search</button>
	    					<button type="submit" name="btn_submit" id="RemoveServer" class="btn btn-primary" value="RemoveServer" <?php echo $Remove_btn_disabled?>>Remove</button>
				           </form>
	    			</div>
	    		</div>
			</div>
		</div>
		</div>
	</div>
</body>
</html>