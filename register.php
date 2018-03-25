<?php 
$pageTitle = "تسجيل";
	require_once("./inc/header.php"); 
		if(isset($_SESSION['login']) && $_SESSION['login'] === true)
	{
		header("location:index.php");
		exit();
	}
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		// Variable Register User
		$username     = trim($_POST['username']);
		$email        = trim($_POST['email']);
		$password     = $_POST['password'];
		$passwordHash = md5($password); // Password Encreption in hash md5

		$user = $con->prepare("SELECT * FROM users WHERE `username`=?");
		$user->execute(array($username));
		$user = $user->rowCount();

		$emailT = $con->prepare("SELECT * FROM users WHERE `email`=?");
		$emailT->execute(array($email));
		$emailT = $emailT->rowCount();


		if(empty($username) || empty($email) || empty($password))
		{
			$error = "الرجاء ملء جميع الحقول";
		}elseif ($user > 0) {
			$error = "اسم المستخدم موجود";
		}
		elseif ($emailT > 0) {
			$error = "البريد الاكتروني موجود";
		}
		else
		{
			$stmt = $con->prepare("INSERT INTO users (`username`,`email`,`password`) VALUES (?,?,?)");
			$reg  = $stmt->execute(array($username,$email,$passwordHash));
			if($reg)
			{
				$success = 'تم عمل حساب بنجاح';
				header("refresh:3;url=login.php");
			}
		}
	}
?>
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">

				<div class="col-sm-4 col-sm-offset-4">
					<div class="signup-form"><!--sign up form-->
						<h2 class="text-center" >انشاء حساب جديد</h2>
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
							<input type="text" name="username" placeholder="اسم المستخدم"/>
							<input type="text" name="email" placeholder=" البريد الالكتروني" />
							<input type="password" name="password"  autocomplete="new-password" placeholder="كلمة المرور" />
							<button type="submit" class="btn btn-default" name="register">تسجيل</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	

<?php require_once("./inc/footer.php"); ?>