<?php 
$pageTitle = "الملابس";
require_once("./inc/header.php"); 

if(!isset($_SESSION['roles']) && $_SESSION['roles'] != 1)
{
	header("location:index.php");
	exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$clo_name        = $_POST['clo_name'];
	$clo_description = $_POST['clo_description'];
	$clo_price       = $_POST['clo_price'];
	$cat_id          = $_POST['cat_id'];
	$img             = $_FILES['clo_file'];


	// Check If Request Add Category 
	if(isset($_POST['addItem'])){
		if(!empty($clo_name) && !empty($clo_description) && !empty($clo_price) && !empty($cat_id) && is_numeric($cat_id) && !empty($img['name']))
		{

			if(addItem($clo_name,$clo_description,$clo_price,$cat_id,$img))
			{
				$success = 'تم اضافة المنتج بنجاح';
				header("refresh:3;url=items.php");
			}else
			{
				$error = "حدث خطء الرجاء المحاولة في وقت اخر";
			}
		}else
		{
			$error = 'الرجاء ملء جميع الحقول';
		}

	}

		// Check If Request Edit Category 
		if(isset($_POST['editItem'])){	
			if(!empty($clo_name) && !empty($clo_description) && !empty($clo_price) && !empty($cat_id) && is_numeric($cat_id))
			{

				if(editItem($_POST['clo_id'],$clo_name,$clo_description,$clo_price,$cat_id,$_POST['clo_img'],$img))
				{
					header("refresh:3;url=items.php");
					$success = 'تم التعديل بنجاح';
				}else
				{
					$error = "حدث خطء الرجاء المحاولة في وقت اخر";
				}
				
			}else
			{
				$error = 'الرجاء ملء جميع الحقول';
			}
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
						<h2 class="text-center">اضافة منتج</h2>
						<?php 
							if(isset($error))
							{
								echo "<div class='msg error'>$error</div>";
							}elseif(isset($success))
							{
								
								echo "<div class='msg success'>$success</div>";
							}
						?> 
						<form  enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']?>">
							<input maxlength="200" type="text" name="clo_name"  placeholder="الاسم" />
							<input maxlength="200" type="text" name="clo_price"  placeholder="الثمن" />							
							<textarea maxlength="40" name="clo_description" placeholder="الوصف"></textarea>
							<select  style="margin: 10px 0;" name="cat_id" >
								<option>الاصناف</option>
								<?php getAllCategoriesToClo() ?>
							</select>

							<input style="padding: 10px" type="file" name="clo_file"/>
							<button type="submit" class="btn btn-default" name="addItem">اضافة</button>
						</form>
					</div><!--/Add Category form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
<?php }elseif (isset($_GET['view']) && $_GET['view'] === "edit" && 
		isset($_GET['clo_id']) && 
		is_numeric($_GET['clo_id']) && 
		isset( $_GET['clo_name']) && 
		isset( $_GET['clo_description']) && 
		isset( $_GET['cat_name']) && 
		isset( $_GET['clo_price']) &&
		isset( $_GET['clo_img'])
	){ ?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--Add Categoey form-->
						<h2 class="text-center">اضافة منتج</h2>
						<?php 
							if(isset($error))
							{
								echo "<div class='msg error'>$error</div>";
							}elseif(isset($success))
							{
								
								echo "<div class='msg success'>$success</div>";
							}
						?> 
						<form  enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']?>">
							<input maxlength="200" type="text" name="clo_name"  value="<?php echo $_GET['clo_name']?>" />
							<input maxlength="200" type="text" name="clo_price"  value="<?php echo $_GET['clo_price']?>" />							
							<input type="hidden" name="clo_id"  value="<?php echo $_GET['clo_id']?>" />							
							<input type="hidden" name="clo_img"  value="<?php echo $_GET['clo_img']?>" />							
							<textarea maxlength="40" name="clo_description" placeholder="الوصف"><?php echo $_GET['clo_description']?></textarea>
							<select  style="margin: 10px 0;" name="cat_id" >
								<option>الاصناف</option>
								<?php getAllCategoriesToClo( $_GET['cat_name']) ?>
							</select>

							<input style="padding: 10px" type="file" name="clo_file"/>
							<button type="submit" class="btn btn-default" name="editItem">edit</button>
						</form>
					</div><!--/Add Category form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
<?php }

if(isset($_GET['action']) && $_GET['action'] == "delete" && isset($_GET['clo_id']) && is_numeric($_GET['clo_id']))
{
	if(deleteItemsById($_GET['clo_id']))
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
				header("refresh:3;url=items.php");
				echo "<div class='msg success'>$success</div>";
			}
		?>
		<div class="table-responsive cart_info text-center">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td >#</td>
						<td >الاسم</td>
						<td >الوصف</td>
						<td >القسم</td>
						<td >الثمن</td>
						<td >تاريخ الاضافة</td>
						<td>تعديل</td>
						<td>حذف</td>
					</tr>
				</thead>
				<tbody>
					<?php getClothing() ?>
				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items-->
<?php require_once("./inc/footer.php"); ?>