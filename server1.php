<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'register');

	// initialize variables
	$name = "";
	$address= "";
	$phone_number = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'],$_GET['username'])) {
		$username = $_GET['username'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$phone_number = $_POST['phone_number'];

		mysqli_query($db, "INSERT INTO contact (username, name, address, phone_number) VALUES ('$username','$name', '$address', '$phone_number')"); 
		$_SESSION['message']; 
		header('location: welcome.php?username='.$username);
	}


	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$phone_number = $_POST['phone_number'];
		$query = "SELECT username FROM contact WHERE id = $id";
		$results = mysqli_query($db,$query);
		if(mysqli_num_rows($results)){
			while ($row=mysqli_fetch_array($results)) {
				mysqli_query($db, "UPDATE contact SET name='$name', address='$address' ,phone_number='$phone_number' WHERE id=$id" );
				$_SESSION['message']; 
				header('location: welcome.php?username='.$row['username']);
			}
		}

	}

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM contact WHERE id=$id");
	$_SESSION['message']; 
	header('location: welcome.php');
}


	$results = mysqli_query($db, "SELECT * FROM contact");


	//Add button
	if(isset($_POST['back'])){
		header("location: welcome.php");
		
	}
	
	// ...	
		if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM contact WHERE id=$id");

		if (mysqli_num_rows($record) == 1) {
			while ($n = mysqli_fetch_array($record)){
				$username = $n['username'];
				$name = $n['name'];
				$address = $n['address'];
				$phone_number = $n['phone_number'];
			}
		}

	}
?>
