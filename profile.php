<?php 
$pageTitle = "الملف الشخصي";
	require_once("./inc/header.php"); 
		if(!isset($_SESSION['login']) || $_SESSION['login'] !== true)
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

		$user = $con->prepare("SELECT * FROM users WHERE `username`=? AND userID != ?");
		$user->execute(array($username,$_SESSION['userID']));
		$user = $user->rowCount();

		$emailT = $con->prepare("SELECT * FROM users WHERE `email`=?  AND userID != ?");
		$emailT->execute(array($email,$_SESSION['userID']));
		$emailT = $emailT->rowCount();


		if(empty($username) || empty($email))
		{
			$error = "حقل اسم المستخدم وكلمة المررور يجب ان لا يكون فارغه";
		}elseif ($user > 0) {
			$error = "اسم المستخدم موجود";
		}
		elseif ($emailT > 0) {
			$error = "البريد الاكتروني موجود";
		}
		elseif(empty($password))
		{
			$stmt = $con->prepare("UPDATE  users SET `username`=?,`email`=? WHERE userID = ?");
			$reg  = $stmt->execute(array($username,$email,$_SESSION['userID']));
			if($reg)
			{
				$success = 'تم تعديل المعلومات بنجاح';
				header("refresh:3;url=logout.php");
			}
		}elseif(!empty($password)) {
			$stmt = $con->prepare("UPDATE  users SET `username`=?,`email`=?,`password`=? WHERE userID= ?");
			$reg  = $stmt->execute(array($username,$email,$passwordHash,$_SESSION['userID']));
			if($reg)
			{
				$success = 'تم تعديل المعلومات بنجاح';
				header("refresh:3;url=logout.php");
			}
		}
	}
?>
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">

				<div class="col-sm-4 col-sm-offset-4">
					<div class="signup-form"><!--sign up form-->
						<h2 class="text-center" >الملف الشخصي</h2>
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
							<input type="text" name="username" value="<?php echo $_SESSION['username']?>" />
							<input type="text" name="email" value="<?php echo $_SESSION['email']?>" />
							<input type="password" name="password"  autocomplete="new-password"  title="اتركها فارغه اذا لم تود تغير كلمة المرور" placeholder="كلمة المرور" />
							<button type="submit" class="btn btn-default" name="editProfile">تعديل</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	

<?php require_once("./inc/footer.php"); ?>