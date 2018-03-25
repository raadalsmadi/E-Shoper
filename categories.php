<?php 
$pageTitle = "الاقسام";
require_once("./inc/header.php"); 
if(!isset($_SESSION['roles']) && $_SESSION['roles'] != 1)
{
	header("location:index.php");
	exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$cat_name        = $_POST['cat_name'];
	$cat_description = $_POST['cat_description'];

	if(!empty($cat_name) && !empty($cat_description))
	{
		// Check If Request Add Category 
		if(isset($_POST['addCategory']))
		{
			if(addCategory($cat_name,$cat_description))
			{
				$success = 'تم اضافة القسم بنجاح';
				header("refresh:3;url=categories.php");
			}else
			{
				$error = "حدث خطء الرجاء المحاولة في وقت اخر";
			}
		}

		// Check If Request Edit Category 
		if(isset($_POST['editCategory']))
		{
			if(editCategory($_POST['cat_id'],$cat_name,$cat_description))
			{
				header("refresh:3;url=categories.php");
				$success = 'تم تعديل القسم بنجاح';
			}else
			{
				$error = "حدث خطء الرجاء المحاولة في وقت اخر";
			}
		}
	}else
	{
		$error = 'الرجاء ملء جميع الحقول';
	}

}

/*&& isset($_GET['userID']) && is_numeric($_GET['userID'])*/
if(isset($_GET['view']) && $_GET['view'] === "add")
{ ?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--Add Categoey form-->
						<h2 class="text-center">اضافة قسم</h2>
						<?php 
							if(isset($error))
							{
								echo "<div class='msg error'>$error</div>";
							}elseif(isset($success))
							{
								
								echo "<div class='msg success'>$success</div>";
							}
						?>
						<form method="post" action="<?php $_SERVER['PHP_SELF']?>">
							<input maxlength="200" type="text" name="cat_name"  placeholder="اسم القسم" />
							<textarea maxlength="240" name="cat_description" placeholder="وصف القسم"></textarea>
							<button type="submit" class="btn btn-default" name="addCategory">اضافة</button>
						</form>
					</div><!--/Add Category form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
<?php }elseif (isset($_GET['view']) && $_GET['view'] === "edit" && isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) && isset( $_GET['cat_name']) && isset( $_GET['cat_description'])) { ?>
		<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--Add Categoey form-->
						<h2 class="text-center">تعديل قسم</h2>
						<?php 
							if(isset($error))
							{
								echo "<div class='msg error'>$error</div>";
							}elseif(isset($success))
							{
								
								echo "<div class='msg success'>$success</div>";
							}
						?>
						<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
							<input maxlength="240" type="text" name="cat_name"  value="<?php echo $_GET['cat_name']?>" />
							<input type="hidden" name="cat_id"  value="<?php echo $_GET['cat_id']?>"  />
							<textarea maxlength="240" name="cat_description" ><?php echo $_GET['cat_description']?></textarea>
							<button type="submit" class="btn btn-default" name="editCategory">تعديل</button>
						</form>
					</div><!--/Add Category form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
<?php }

if(isset($_GET['action']) && $_GET['action'] == "delete" && isset($_GET['cat_id']) && is_numeric($_GET['cat_id']))
{
	if(deleteCtegoryById($_GET['cat_id']))
	{
		$success = "تم حذف القسم بنجاح";
	}else
	{
		$error = "حدث خطء الرجاء المحاولة في وقت اخر";
	}
}
?>

<section id="cart_items">
	<div class="container">
		<?php 
			if(isset($error))
			{
				echo "<div class='msg error'>$error</div>";
			}elseif(isset($success))
			{
				header("refresh:3;url=categories.php");
				echo "<div class='msg success'>$success</div>";
			}
		?>
		<div class="table-responsive cart_info text-center">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td >#</td>
						<td >اسم القسم</td>
						<td >الوصف</td>
						<td >تعديل</td>
						<td>حذف</td>
					</tr>
				</thead>
				<tbody>
					<?php getCategories() ?>
				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items-->
<?php require_once("./inc/footer.php"); ?>