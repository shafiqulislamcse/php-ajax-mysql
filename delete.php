<?php
 
  $servername ="localhost";
  $username ="root";
  $password="";
  $db ="practice";

  $conn = new mysqli($servername,$username,$password,$db);

  if ($conn -> connect_error) {
    die("connection failed". $conn -> connect_error);
  }



	if (isset($_GET['id'])) {
		$id =$_GET['id'];

		$delete ="delete from users where id ='$id'";

		$run_delete	= $conn -> query($delete);
		header('location:index.php');
	}
	else{
		header('location:index.php');
	}

?>