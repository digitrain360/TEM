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
</head>
<body>
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
				      <a class="nav-link" href="HomePage.Html"><span class="badge badge-pill badge-secondary">Home</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="EnvHome.php"><span class="badge badge-pill badge-primary">Environments</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="AppHome.php"><span class="badge badge-pill badge-secondary">Applications</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="ServerHome.php"><span class="badge badge-pill badge-secondary">Servers</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="HlcHome.php"><span class="badge badge-pill badge-secondary">Health Check</span></a>
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
						<a class="nav-link active" href="#">Current Allocations</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">New Allocation Request</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Environment Knowledge</a>
					</li>
					
				</ul>
				<hr class="d-sm-none">
			</div>
			<div class="col-sm-10">
				<div class="row">
					<div class="col-sm-10">
        				<h5> Here is a list of Environments</h5>
        				<table class="table table-bordered">
        					<thead>
        						<tr>
        							<th>Environment Name</th>
        							<th>Guidewire</th>
        							<th>ESB</th>
        							<th>TCM</th>
        							<th>DRS</th>
        							<th>Mainframe</th>
        						</tr>
        					</thead>
        					<tbody>
        						<tr>
        							<td>Dev</td>
        							<td>Dev1</td>
        							<td>DLI1</td>
        							<td>Dev</td>
        							<td>dev</td>
        							<td>DEVCICS</td>
        						</tr>
        					</tbody>
        				</table>

					</div>
				</div>
				<div class="row mt-5">
					<div class="col-sm-10">
						<h2> Here is a list of Environments</h2>
						<table class="table table-bordered">
    						<thead>
    							<tr>
             						<th>Environment Name</th>            
             						<th>Guidewire</th>
           							<th>ESB</th>
           							<th>TCM</th>
           							<th>DRS</th>
           							<th>Mainframe</th>
           						</tr>
           					</thead>
           					<tbody>
           						<tr>
           							<td>Dev</td>
           							<td>Dev1</td>
           							<td>DLI1</td>
           							<td>Dev</td>
            						<td>dev</td>
            						<td>DEVCICS</td>
            					</tr>
            				</tbody>
            			</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>