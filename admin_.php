<?php 
$pageTitle = "لوحة التحكم";
require_once("./inc/header.php"); 
if(!isset($_SESSION['roles']) && $_SESSION['roles'] != 1)
{
	header("location:index.php");
	exit();
}

?>

<?php require_once("./inc/footer.php"); ?>