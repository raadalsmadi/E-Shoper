<?php 
$pageTitle = "السلة";
	require_once("./inc/header.php"); 
	if(!isset($_SESSION['login']) || $_SESSION['login'] !== true)
	{
		header("location:index.php");
		exit();
	}
	if (isset($_GET['action']) && $_GET['action'] === "AddCartToUser" && isset($_GET['clo_id']) && is_numeric($_GET['clo_id']))
	{
		$re = addCloToCartUser($_GET['clo_id'],$_SESSION['userID']);
		if($re === "isFound"){
			$error = "تم اضافة هاذا المنتج من قبل";
		}elseif($re === true)
		{
			$success ="تم اضافة المنتج الي السلة";
			header("refresh:3;url=cart.php");
		}else
		{
			$error = "حدث خطء في اضافة المنتج الي السلة الرجاء المحوله  في وقت اخر";
		}
	}

	if (isset($_GET['action']) && $_GET['action'] === "delete" && isset($_GET['cart_id']) && is_numeric($_GET['cart_id']))
	{
		if(deleteCartById($_GET['cart_id']))
		{
			$success = "تم حثف المنتج من السلة بنجاح";
			header("refresh:3;url=cart.php");

		}else{
			$error = "حدث خطء الرجاء المحاولة في ما بعد";
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
					
					echo "<div class='msg success'>$success</div>";
				}
			?>
			<div class="table-responsive cart_info text-center">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">السلعة</td>
							<td class="description">الوصف</td>
							<td class="price">الثمن</td>
							<td>حذف</td>
						</tr>
					</thead>
					<tbody>
						<?php 
							$carts = getAllCartForUser($_SESSION['userID']);

							foreach ($carts as $cart) {
								$clo = getClothingById($cart['clo_id'])
							

						?>
						<tr>
							<td class="cart_product"><img src="images/uploadImages/<?php echo $clo['clo_img']?>" alt=""></td>
							<td class="cart_description">
								<h4><?php echo $clo['clo_description']?></h4>
								
							</td>
							<td class="cart_price"><p><?php echo $clo['clo_price']?>$</p></td>

							<td class="cart_delete">
								<a class="cart_quantity_delete" href="?action=delete&cart_id=<?php echo $cart['cart_id']?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
				<a href="#" style="width:120px;margin:10px"  class="btn btn-info pull-left">شراء</a>
							
		</div>
	</section> <!--/#cart_items-->

	
<?php require_once("./inc/footer.php"); ?>