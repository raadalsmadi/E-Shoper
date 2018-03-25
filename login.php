<?php 
$pageTitle = "دخول";
	require_once("./inc/header.php"); 
	if(isset($_SESSION['login']) && $_SESSION['login'] === true)
	{
		header("location:index.php");
		exit();
	}
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		// Variable Login User And Admin
		$username     = trim($_POST['username']);
		$password     = $_POST['password'];
		$passwordHash = md5($password); // Password Encreption in hash md5



		if(empty($username) || empty($password) )
		{
			$error = "الرجاء ملء جميع الحقول";
		}
		else
		{
			$stmt = $con->prepare("SELECT * FROM users WHERE (username = ? OR email = ?) AND password = ? LIMIT 1 ");
			$stmt->execute(array($username,$username,$passwordHash));
			$count = $stmt->rowCount();
			$user = $stmt->fetch();
			if($count > 0)
			{
				if($user['active'] == 1)
				{
					$_SESSION['username'] = $user['username'];
					$_SESSION['userID']  = $user['userID'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['roles'] = $user['roles'];
					$_SESSION['login'] = true;
					if($_SESSION['roles'] == 1)
					{
						header("location:index.php");
					}else{
						header("location:index.php");
					}
				}else
				{
					$error = "لم يتم تفعير حسابك بعد";
				}
				
			}else{
				$error = "اسم المستخدم او كلمة المرور غير موجوده";
			}
		}
	}
?>
	
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--login form-->
						<h2 class="text-center">الدخول الي حسابك</h2>
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
							<input type="text" name="username" placeholder="اسم المستخدم او البريد الالكتروني"  autocomplete="off" />
							<input type="password" name="password"  placeholder="كلمة المرور"  autocomplete="new-password" />
							<button type="submit" class="btn btn-default" name="login">دخول</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	

<?php require_once("./inc/footer.php"); ?>