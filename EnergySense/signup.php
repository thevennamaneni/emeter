<!DOCTYPE HTML>

<!-- EnergySense BleedingEdge Copyright 2017 Vennamaneni Sai Narasimha, Abdullah Tamim, Obaidullah Lodin. All Rights 
Reserved. 
-->
<html lang="en">

<head>
<meta charset="UTF-8">

<title>EnergySense: Sign Up!</title>
<!-- Adding Bootstrap -->
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/bootstrap-theme.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
     <a class="navbar-brand text-center center-block" href="./index.php">EnergySense</a>
</nav>

<style>
.navbar-brand {
  float: none;
}
</style>
<div class="alert alert-warning col-md-4 col-md-offset-4" role="alert"><p><strong>Warning!</strong> SSL is NOT implemented. Proceed at your own risk</p></div>
</br>
<div class="panel panel-default panel-modest span12 pagination-centered col-md-4 col-md-offset-4">
<div class="panel-body">
<p>Sign Up for EnergySense:</p>
<form action="./adduser.php" method="post">
<div class="input-group">

<span class="input-group-addon" id="basic-addon1">Username:</span>
<input type="text" value="" name="username" class="form-control" placeholder="" aria-describedby="basic-addon1">
</div>
</br>
<div class="input-group">

<span class="input-group-addon" id="basic-addon1">Password:</span>
<input type="password" value="" name="password" class="form-control" placeholder="" aria-describedby="basic-addon1">
</div>
</br>
<div class="input-group">

<span class="input-group-addon" id="basic-addon1">Address:</span>
<input type="text" value="" name="address" class="form-control" placeholder="" aria-describedby="basic-addon1">
</div>
</br>
<div class="input-group">

<span class="input-group-addon" id="basic-addon1">Email:</span>
<input type="text" value="" name="email" class="form-control" placeholder="" aria-describedby="basic-addon1">
</div>

</br>

<div class="input-group">

<span class="input-group-addon" id="basic-addon1">Type of Account:</span>
<input type="text" value="" name="type" class="form-control" placeholder="" aria-describedby="basic-addon1">
</div>

</br>
<div class="input-group">

<span class="input-group-addon" id="basic-addon1">UID:</span>
<input type="text" value="" name="uid" class="form-control" placeholder="" aria-describedby="basic-addon1">
</div>

</br>

<button type="submit" value="Submit" class="btn btn-primary btn-block">Sign Up!</button>
</form>
</br>

</div>
</div>
</div>
</br>
<div class="col-md-4 col-md-offset-4">
<p>EnergySense 2017</p>
</div>
<script src="./jquery-2.1.4.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
</body>