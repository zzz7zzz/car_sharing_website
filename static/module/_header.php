<!-- Header -->
<?php
if(isset($_SESSION['email'])){
	include "_header_post.php";
}
else{
	include "_header_pre.php";
}
?>