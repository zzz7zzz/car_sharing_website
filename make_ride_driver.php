<?php
	if (!isset($_SESSION))
	{
    	session_start();
	}
?>

<!DOCTYPE html>
<html>
<head>
<?php require "static/module/_includes.php"; ?>
</head>
<body>

<?php
	include "static/module/_header.php"; ?>
<?php
	if(isset($_SESSION['email'])){
		include "app/createDriverRide.php";
	}
	else{
		include "static/module/_home_pre.php";
	}
	include "static/module/_footer.php";

?>
</body>
</html>