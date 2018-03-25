
<?php require_once "./inc/header.php" ?>
	
	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				<?php require_once("./inc/sidebar.php"); ?>		
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->

						<h2 class="title text-center">كل منتجات
							<?php 
								if(isset($_GET['cat_name']))
								{
									echo "في ".str_replace("-"," ",$_GET['cat_name']);
								}
							?>
						</h2>
						<?php 
							if(isset($_GET['cat_name']) && !empty($_GET['cat_name']))
							{
								$stmt = $con->prepare("SELECT catID FROM categories WHERE cat_name = ?");
								$stmt->execute([$_GET['cat_name']]);
								$catID = $stmt->fetch()['catID'];
								$where = "WHERE cat_id=?";
								
							}else{
								$catID = '';
								$where = '';
							}
							$clos = getClothingByNameCategory($where,$catID);
							foreach ($clos as $clo) {
								
						?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<span class="cat-name" ><?php echo $clo['clo_name']?></span>
											<img src="images/uploadImages/<?php echo $clo['clo_img']?>" alt="" />
											<h2>$<?php echo $clo['clo_price']?></h2>
											<p><?php echo $clo['clo_description']?></p>
											<?php if(isset($_SESSION['login']) && $_SESSION['roles'] == 0) { ?>
												<a target="_blank" href="cart.php?action=AddCartToUser&clo_id=<?php echo $clo['clo_id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> اضافة الي السلة</a>
											<?php }?>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>$<?php echo $clo['clo_price']?></h2>
												<p><?php echo $clo['clo_description']?></p>
												<?php if(isset($_SESSION['login']) && $_SESSION['roles'] == 0) { ?>
													<a href="cart.php?action=AddCartToUser&clo_id=<?php echo $clo['clo_id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												<?php }?>
											</div>
										</div>
								</div>

							</div>
						</div>
						<?php }?>

			</div>
		</div>
	</section>
	

		
<?php require_once "./inc/footer.php" ?>