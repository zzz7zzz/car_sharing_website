<?php
	if (!isset($_SESSION)) 
	{
		session_start();
	}	

	/* Get the variables passed from newIndex.php, and hash the password. */
	$email = $_POST['email'];
	$password = $_POST['password'];
	$hash = md5($password);

	/* Check if the user is in Database */
	include "function.php";
	$conn=connDB();

	$query = "SELECT * FROM info where Email= '$email' and Password='$hash'";
	$result = mysqli_query($conn,$query);
	if ($row = mysqli_fetch_assoc($result))
	{
		if($row['Email'] == $email)
		{
			/* If the creditials are correct, start session, and the session. */
			$_SESSION['email'] = $email;
// 			$_SESSION['type'] = $row['Type'];
			$_SESSION['id'] = $row['UserID'];
			$_SESSION['givenname'] = $row['GivenName'];
			$_SESSION['familyname'] = $row['FamilyName'];
			$duration = 30 * 60 * 60 * 24 ; 
			setcookie("email", $email, time() + $duration,'/');
			setcookie("password", $password, time() + $duration,'/');
			header('Location: ../index.php');
		}
		else
		{
			/* Redirect back to hearder.php */
			cleanCookie();
			header('Location: ../index.php?err=1');
			/* The die() function prints a message and exits the current script. */
		}
	}
	else
	{
		/* destroy cookie */
		cleanCookie();
		header('Location: ../index.php?err=1');
	}
?>


