<?php 
$pageTitle = "المستخدمين";
require_once("./inc/header.php"); 
if(!isset($_SESSION['roles']) && $_SESSION['roles'] != 1)
{
	header("location:index.php");
	exit();
}

if(isset($_GET['action']) && $_GET['action'] === "delete" && isset($_GET['userID']) && is_numeric($_GET['userID']))
{
	if(deleteUserById($_GET['userID']))
	{
		$success = "تم حذف الحساب بنجاح";

	}else{
		$error = 'حدث خطء اثناء حذف الحساب';
	}
}

if(isset($_GET['action']) && $_GET['action'] === "active" && isset($_GET['userID']) && is_numeric($_GET['userID']))
{
	if(activeUser($_GET['userID']))
	{
		$success = "تم تفعيل الحساب بنجاح";

	}else{
		$error = 'حدث خطء اثناء تفعيل الحساب';
	}
}
?>
	<section id="cart_items">
		<div class="container">
			<?php 
				if(isset($error))
				{
					echo "<div class='msg error'>$error</div>";
				}elseif (isset($success)) {
					header("refresh:3;url=users.php");

					echo "<div class='msg success'>$success</div>";
				}
			?>
			<div class="table-responsive cart_info text-center">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td >#</td>
							<td class="image">اسم المستخدم</td>
							<td class="description">البريد الالكتروني</td>
							<td class="price">تفعيل</td>
							<td>حذف</td>
						</tr>
					</thead>
					<tbody>
						<?php getUsers(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

<?php require_once("./inc/footer.php"); ?>