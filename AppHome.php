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
				      <a class="nav-link" href="EnvHome.php"><span class="badge badge-pill badge-secondary">Environments</span></a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="AppHome.php"><span class="badge badge-pill badge-primary">Applications</span></a>
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
						<a class="nav-link" href="AddApplication.php">Manage Applications</a>
					</li>					
					<li class="nav-item">
						<a class="nav-link active" href="#">Applications Report</a>
					</li>
				</ul>
				<hr class="d-sm-none">
			</div>
			<div class="col-sm-10">
				<div class="row">
					<div class="col-sm-10">
        				<h5> Here is a list of Applications</h5>
        				<table class="table table-bordered">
        					<thead>
        						<tr>
        							<th>Application Name</th>
        							<th>Application Type</th>
        							<th>Application Category</th>
        							<th>Application Programming Language</th>
        						</tr>
        					</thead>
        					<tbody>
        						<tr>
        							<td>Guidewire</td>
        							<td>Internal</td>
        							<td>User Based</td>
        							<td>Java</td>
        						</tr>
        					</tbody>
        				</table>

					</div>
				</div>
				<div class="row mt-5">
					<div class="col-sm-10">
        				<h5> Here is a list of Applications</h5>
        				<table class="table table-bordered">
        					<thead>
        						<tr>
        							<th>Application Name</th>
        							<th>Application Type</th>
        							<th>Application Category</th>
        							<th>Application Programming Language</th>
        						</tr>
        					</thead>
        					<tbody>
        						<tr>
        							<td>Guidewire</td>
        							<td>Internal</td>
        							<td>User Based</td>
        							<td>Java</td>
        						</tr>
        						<tr>
        							<td>eServices</td>
        							<td>External</td>
        							<td>Client Facing</td>
        							<td>Php</td>
        						</tr>
        						<tr>
        							<td>Pension</td>
        							<td>Internal</td>
        							<td>User Facing</td>
        							<td>.Net</td>
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