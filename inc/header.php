<?php 
ob_start();
session_start();
require_once("./inc/connect.php");
require_once("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
    	<?php 
    		echo $title = isset($pageTitle) ? $pageTitle : 'الملابس';
    	?>
    </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-rtl.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0770123456</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@shop.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-left">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php 
									if(!isset($_SESSION['login']) || $_SESSION['login'] !== true)
									{ ?>
									<li><a href="login.php">دخول <i class="fa fa-sign-in"></i> </a></li>
									<li><a href="register.php">تسجيل <i class="fa fa-sign-in"></i> </a></li>
									<?php }else{
										?>
									<li class="dropdown"><a href="#"><?php echo $_SESSION['username']?><i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="logout.php">تسجيل الخروج</a></li>
                                        <li><a href="profile.php">الملف الشخصي</a></li>
                                    </ul>
                                </li> 

                                <?php 
                                	if($_SESSION['roles'] == 1)
                                	{ ?>
											<li class="dropdown" ><a href="">الاصناف  <i class="fa fa-angle-down"></i>
                                 <ul role="menu" class="sub-menu">
                                        <li><a href="categories.php?view=add">اضافة قسم </a></li>
                                        <li><a href="categories.php">عرض الاقسام</a></li>
                                    </ul>
											</a></li>
									<li class="dropdown" ><a href="">منتجات <i class="fa fa-angle-down"></i>
                                      <ul role="menu" class="sub-menu">
                                        <li><a href="items.php?view=add">اضافة منتجات </a></li>
                                        <li><a href="items.php">عرض منتجات</a></li>
                                    </ul>
											</a></li>
											<li class="dropdown" ><a href="users.php">المستخدمين  </a></li>
                                	<?php }else
                                	{
                                		?> 
											<li><a href="cart.php">السلة ( <span style="color:#fe980f" > <?php echo rowCountCartForUser($_SESSION['userID'])?>  </span> ) <i class="fa fa-shopping-cart"></i> </a></li>
                                		<?php
                                	}
                                ?>
								

									<?php 
									}
								?>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-rigth">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="./index.php" >الرئسية</a></li>
								<li><a href="./shop.php" >كل منتجات</a></li>
								<?php 
									$cats = getCategoriesToMain();
									foreach ($cats as $cat) {
										echo "<li><a href='./shop.php?cat_name=".str_replace(" ","-",$cat['cat_name'])."' >".$cat['cat_name']."</a></li>";
									}
								?>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->