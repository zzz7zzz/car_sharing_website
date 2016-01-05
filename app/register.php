<?php
/* Insert User Info */
if (!isset($_POST['email'])) {
	die();
}

$id = microtime(true); //Generate Id Using Unix Time
$email = $_POST['email'];
$password = $_POST['password'];
$hash = md5($password);
// $type = $_POST['type'];

// type is no used
$type = 1;
$familyname = $_POST['familyname'];
$givenname = $_POST['givenname'];


include "function.php";
$conn=connDB();

$accountExist = $conn->query("SELECT Email FROM info WHERE Email='$email'");

if ($accountExist)
{

	if (mysqli_num_rows($accountExist) > 0) {
		$accountExist->close();
		header('Location: ../index.php?err=3');
	}else{

		$sql = "Insert into info values ('$id', '$email','$hash','$type','$familyname','$givenname','')";
		if ($conn->query($sql) === TRUE)
		{
		// 		echo "New Account created successfully";
			$conn->close();
			header('Location: ../index.php?success=1');
		}
		else
		{
		// 	  echo "Error: " . $sql . "<br>" . $conn->error;
		    $conn->close();
		    header('Location: ../index.php?err=2');
		}
	}
} else {
 	header('Location: ../index.php?err=2');
}
$conn->close();
?>
