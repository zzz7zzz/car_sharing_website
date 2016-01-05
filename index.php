<?php
if (!isset($_SESSION)) 
{
	session_start();
}	

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php require "static/module/_includes.php"; ?>
</head>
<body>

<?php
	if(isset($_SESSION['email']))
	{
		include "make_ride_driver.php";
	}else{
		include "static/module/_header.php";
		include "static/module/_home_pre.php";
	}
	include "static/module/_footer.php";
?>
</body>
</html>
