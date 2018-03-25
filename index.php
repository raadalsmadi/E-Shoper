<?php $pageTitle = "الرئسية"; require_once("./inc/header.php")  ?>

	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">

								<div class="col-sm-6">
									<img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">

								<div class="col-sm-6">
									<img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>
							
						</div>
						

					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
		
				<?php require_once("./inc/sidebar.php"); ?>				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->

						<h2 class="title text-center">اخر منتجات التي تم اضافتها</h2>
						<?php 
							$clos = getAllClothingInMain("LIMIT 9");
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
												<a target="_blank" href="cart.php?action=AddCartToUser&clo_id=<?php echo $clo['clo_id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> اضافه الي السلة</a>
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

		
					</div><!--features_items-->
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<?php 
									$cats = getCategoriesToMain();
									$active = "active";
									foreach ($cats as $cat) {
										echo "<li class='$active'><a href='#ID".$cat['catID']."' data-toggle='tab'>".$cat['cat_name']."</a></li>";
										$active = '';
									}
								?>
							</ul>
						</div>

						<div class="tab-content">
							<?php 
								$active = "active in";
								foreach ($cats as $cat) {
									
								
							?>
							<div class="tab-pane fade <?php echo $active;?>" id="ID<?php echo $cat['catID'] ?>" >

								<?php 
								$catID = $cat['catID'];
								$clos = getAllClothingInMain("LIMIT 4","WHERE clothing.cat_id = $catID");
								foreach($clos as $clo) {
								?>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/uploadImages/<?php echo $clo['clo_img']?>" alt="" />
												<h2>$<?php echo $clo['clo_price']?></h2>
												<p><?php echo $clo['clo_description']?></p>
												<?php if(isset($_SESSION['login']) && $_SESSION['roles'] == 0) { ?>
													<a href="cart.php?action=AddCartToUser&clo_id=<?php echo $clo['clo_id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												<?php }?>
											</div>
											
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						    <?php $active = ''; }?>
						</div>
					</div><!--/category-tab-->
					
					
				</div>
			</div>
		</div>
	</section>
	
<?php  require_once("./inc/footer.php")  ?>