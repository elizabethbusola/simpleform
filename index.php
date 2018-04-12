<?php
$title = 'Form and data submission';
include('config.php');
include('header.php');

if(array_key_exists('submit', $_POST)){
	$avi = [];

if(empty($_POST['fname'])){
	$avi['fname'] = "please enter your first name";
}
if (empty($_POST['lname'])) {
	$avi['lname'] = "please enter your last name";
}
if(empty($_POST['email'])){
	$avi['email'] = "please enter your email address";
}
if (empty($_POST['pass'])) {
	$avi['pass'] = "please enter your password";
}

if(empty($avi)){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
	$stmt = $conn->prepare("INSERT INTO mine(first_name, last_name, email, password) VALUES(:a, :b, :c, :d)");
	$data = [
		':a' => $fname,  
		':b' => $lname,  
		':c' => $email,  
		':d' => $pass  

	];
	if ($stmt->execute($data)){
		$message='Submitted successfully';
		header("Location:form.php?message=$message");
	}/*else{
		$show = "form cannot be submitted";
	}*/

}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<section class="row">
 <div class="col-md-6 col-md-offset-3">
<?php
	if (isset($_GET['message'])) {
		echo '<div class="alert alert-success">'. $_GET['message']. '</div>';
	}
?>

 	<?php
 	if (!empty($avi)) {
 		 echo "<div class='alert alert-danger'>";
 		 if (isset($avi['fname'])) {
 		 	echo $avi['fname']. "<br>";
 		 	
 		 }
 		 if (isset($avi['lname'])) {
 		 	echo $avi['lname']. "<br>";
 		 }
 		  if (isset($avi['email'])) {
 		 	echo $avi['email']. "<br>";
 		 }
 		  if (isset($avi['pass'])) {
 		 	echo $avi['pass'];
 		 }
 		 echo "</div>";
 	}



 	?>
 
 <form action="" method="post" >
 	<div class="form-group">
 		<label for="name">First Name</label>
 		<input class="form-control" type="text" name="fname" value="">
 	</div>
 	<div class="form-group">
 		<label for="name">Last Name</label>
 		<input class="form-control" type="text" name="lname" value="">
 	</div>
 	<div class="form-group">
 		<label for="name">Email</label>
 		<input class="form-control" type="email" name="email" value="">
 	</div>
 	<div class="form-group">
 		<label for="name">Password</label>
 		<input class="form-control" type="password" name="pass" value="">
 	</div>
 	
 	<div class="form-group">
 	<button type="submit" class="btn btn-primary" name="submit">Submit</button>
  	</div>
 </form>
 </div>
 </section>
</body>
</html>