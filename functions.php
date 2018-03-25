<?php 

/*----- Function Get All Users From Database -----*/
function getUsers()
{
	global $con;
	$stmt = $con->prepare("SELECT * FROM users WHERE roles != 1");
	$stmt->execute();
	$users = $stmt->fetchAll();
	$number = 0;
	foreach ($users as $user) { $number+=1;?>
		<tr>
			<td ><?php echo $number ?></td>
			<td ><?php echo $user['username'] ?></td>
			<td ><?php echo $user['email'] ?></td>
			<?php 
				if($user['active'] == 1)
				{
					echo '<td ><a class="btn btn-success" >الحساب مفعل</a></td>';
				}else
				{
					echo "<td >
					<a class='btn btn-info' href='?action=active&userID={$user['userID']}'>تفعيل</a>
					</td>";
				}
			?>
			<td >
				<a class="btn btn-danger" href="?action=delete&userID=<?php echo $user["userID"] ?>">حذف</a>
			</td>
		</tr>
	<?php }
}

function deleteUserById($id)
{
	global $con;
	$stmt = $con->prepare("DELETE FROM users WHERE userID=?");
	if($stmt->execute([$id]))
	{
		return true;
	}else
	{
		return false;
	}
}

function activeUser($id)
{
	global $con;
	$stmt = $con->prepare("UPDATE users SET active = '1'  WHERE userID=?");
	if($stmt->execute([$id]))
	{
		return true;
	}else
	{
		return false;
	}
}

function addCategory($cat_name,$cat_description)
{
	global $con;
	$stmt = $con->prepare("INSERT INTO categories (`cat_name`,`cat_description`) VALUES (?,?)");
	return $stmt->execute([$cat_name,$cat_description]);
}

function editCategory($id,$cat_name,$cat_description)
{
	global $con;
	$stmt = $con->prepare("UPDATE categories SET  cat_name=?,cat_description=? WHERE catID = ?");
	return $stmt->execute([$cat_name,$cat_description,$id]);
}

function getCategories()
{
	global $con;
	$stmt = $con->prepare("SELECT * FROM categories");
	$stmt->execute();
	$categories = $stmt->fetchAll();
	$number = 0;
	foreach ($categories as $category) { $number+=1;?>
		<tr>
			<td ><?php echo $number ?></td>
			<td ><?php echo $category['cat_name'] ?></td>
			<td ><?php echo $category['cat_description'] ?></td> <?php 
			echo "<td ><a class='btn btn-success' href='?view=edit&cat_id={$category['catID']}&cat_description={$category["cat_description"]}&cat_name={$category["cat_name"]}'>تعديل</a></td>"
			?>
			<td ><a class="btn btn-danger" href="?action=delete&cat_id=<?php echo $category["catID"] ?>">حذف</a></td>
		</tr>
	<?php }
}

function deleteCtegoryById($id)
{
	global $con;
	$stmt = $con->prepare("DELETE FROM categories WHERE catID=?");
	if($stmt->execute([$id]))
	{
		return true;
	}else
	{
		return false;
	}
}

function getCategoriesToMain($limit = '')
{
	global $con;
	$stmt = $con->prepare("SELECT * FROM categories");
	$stmt->execute();
	return $categories = $stmt->fetchAll();
}


function getAllCategoriesToClo($cat_name = '')
{
	global $con;
	$stmt = $con->prepare("SELECT * FROM categories");
	$stmt->execute();
	$categories = $stmt->fetchAll();
	$selected = null;
	foreach ($categories as $category) {
		$selected   = $category['cat_name'] == $cat_name ? "selected" : null;
		echo "<option value='".$category["catID"]."' $selected>".$category["cat_name"]."</option>";
	}	
}
function addItem($clo_name,$clo_description,$clo_price,$cat_id,$img)
{
	global $con;
	if(!is_dir("./images/"))
	{
		mkdir("./images/");
	}
	if(!is_dir("./images/uploadImages/"))
	{
		mkdir("./images/uploadImages/");
	}
	$imgName = md5(time().rand(0,999999).$clo_description.$cat_id.rand(0,5951)).".".explode(".", $img['name'],2)[1];
	$uplaod = move_uploaded_file($img['tmp_name'], "./images/uploadImages/$imgName");
	if($uplaod)
	{
		$stmt = $con->prepare("INSERT INTO clothing (`clo_name`,`clo_description`,`clo_price`,`cat_id`,`clo_img`) VALUES (?,?,?,?,?)");
		return $stmt->execute([$clo_name,$clo_description,$clo_price,$cat_id,$imgName]);		
	}

}


function editItem($clo_id,$clo_name,$clo_description,$clo_price,$cat_id,$clo_img,$img)
{
	global $con;
	$imgName = $clo_img;
	if(!empty($img['name']))
	{
		$imgName = md5(time().rand(0,95429).$clo_description.$cat_id.rand(0,99051).time()).".".explode(".", $img['name'],2)[1];
		$uplaod = move_uploaded_file($img['tmp_name'], "./images/uploadImages/$imgName");
		if($uplaod)
		{
			unlink("./images/uploadImages/$clo_img");	
		}else{
			echo "Error Update Img";
		}
	}

	$stmt = $con->prepare("UPDATE  clothing SET `clo_name`=?,`clo_description`=?,`clo_price`=?,`cat_id`=?,`clo_img`=? WHERE clo_id=?");
	return $stmt->execute([$clo_name,$clo_description,$clo_price,$cat_id,$imgName,$clo_id]);		
	
}

function getClothingById($id)
{
	global $con;
	$stmt = $con->prepare("SELECT * FROM clothing WHERE clo_id = ? LIMIT 1");
	$stmt->execute([$id]);
	return $categories = $stmt->fetch();

}

function getClothingByNameCategory($where ='',$value = null)
{
	global $con;
	$stmt = $con->prepare("SELECT * FROM clothing $where ORDER BY clo_id DESC ");
	$stmt->execute([$value]);
	return $categories = $stmt->fetchAll();

}



function getClothing()
{
	global $con;
	$stmt = $con->prepare("SELECT * FROM clothing INNER JOIN categories ON clothing.cat_id = categories.catID ORDER BY clo_id DESC");
	$stmt->execute();
	$clothing = $stmt->fetchAll();
	$number = 0;
	foreach ($clothing as $clothing) { $number+=1;?>
		<tr>
			<td ><?php echo $number ?></td>
			<td ><?php echo $clothing['clo_name'] ?></td>
			<td ><?php echo $clothing['clo_description'] ?></td> 
			<td ><?php echo $clothing['cat_name']  ?></td> 
			<td ><?php echo $clothing['clo_price'] ?></td> 
			<td ><?php echo $clothing['clo_date'] ?></td> 
			<?php 
			echo "<td ><a class='btn btn-success' href='?view=edit&clo_id={$clothing['clo_id']}&clo_name={$clothing['clo_name']}&clo_description={$clothing['clo_description']}&cat_name={$clothing['cat_name']}&clo_price={$clothing['clo_price']}&clo_img={$clothing['clo_img']}'>تعديل</a></td>"
			?>
			<td ><a class="btn btn-danger" href="?action=delete&clo_id=<?php echo $clothing["clo_id"] ?>">حذف</a></td>
		</tr>
	<?php }
}

function deleteItemsById($id)
{
	global $con;
	$imgName = getClothingById($id)['clo_img'];
	if(unlink("./images/uploadImages/$imgName")){
		$stmt = $con->prepare("DELETE FROM clothing WHERE clo_ID=?");
		if($stmt->execute([$id]))
		{
			return true;
		}else
		{
			return false;
		}		
	}
}


function getAllClothingInMain($limit = '',$where = '')
{
	 
	global $con;
	$stmt = $con->prepare("SELECT * FROM clothing INNER JOIN categories ON clothing.cat_id = categories.catID $where ORDER BY clo_id DESC $limit");
	$stmt->execute();
	$clothing = $stmt->fetchAll();
	return $clothing;
}


function addCloToCartUser($clo_id,$user_id)
{
	global $con;
	$stmt = $con->prepare("SELECT * FROM carts WHERE clo_id=? AND user_id =?");
	$stmt->execute([$clo_id,$user_id]);
	$count = $stmt->rowCount();
	if($count > 0)
	{
		return "isFound";
	}

	$stmt = $con->prepare("INSERT INTO carts (`clo_id`,`user_id`) VALUES (?,?)");
	return $stmt->execute([$clo_id,$user_id]);	
}

function getAllCartForUser($user_id)
{
	global $con;
	$stmt = $con->prepare("SELECT * FROM carts WHERE  user_id =? ORDER BY cart_id DESC");
	$stmt->execute([$user_id]);
	return $carts = $stmt->fetchAll();
}

function rowCountCartForUser($user_id)
{
	global $con;
	$stmt = $con->prepare("SELECT * FROM carts WHERE  user_id =? ");
	$stmt->execute([$user_id]);
	return $carts = $stmt->rowCount();
}

function deleteCartById($cart_id)
{
		global $con;
		$stmt = $con->prepare("DELETE FROM carts WHERE cart_id=?");
		if($stmt->execute([$cart_id]))
		{
			return true;
		}else
		{
			return false;
		}
}