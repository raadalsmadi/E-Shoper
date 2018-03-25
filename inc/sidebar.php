			<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>االاقسام</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							<?php 
								$cats = getCategoriesToMain();
								foreach ($cats as $cat) {
									
								
							?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#ID_<?php echo $cat['catID']?>">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											<?php echo $cat['cat_name']?>
										</a>
									</h4>
								</div>
								<div id="ID_<?php echo $cat['catID']?>" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
								<?php 
									$catID = $cat['catID'];
									$clos = getAllClothingInMain("LIMIT 10","WHERE clothing.cat_id = $catID");
									foreach ($clos as $clo) {
										echo "<li><a href=''>".$clo['clo_name']." </a></li>";
									}
								?>
											
										</ul>
									</div>
								</div>
								
							</div>
							<?php } ?>
						</div><!--/category-products-->
					</div>
				</div>