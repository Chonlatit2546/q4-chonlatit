<?php

session_start();

// เพิ่มสินค้า
if ($_GET["action"]=="add") {

	$pid = $_GET['pid'];
	$quantity = $_POST['quantity']; //ดึงค่าจำนวนสินค้าคงเหลือมาจาก index.php

	$cart_item = array(
 		'pid' => $pid,
		'pname' => $_GET['pname'],
		'price' => $_GET['price'],
		'qty' => $_POST['qty'],
		'stock' => $quantity // เก็บสต็อกใน session ด้วย
	);

	// ถ้ายังไม่มีสินค้าใดๆในรถเข็น
	if(empty($_SESSION['cart']))
    	$_SESSION['cart'] = array();
 
	// ถ้ามีสินค้านั้นอยู่แล้วให้บวกเพิ่ม
	if(array_key_exists($pid, $_SESSION['cart'])){
		if($_SESSION['cart'][$pid]['qty'] + $_POST['qty'] > $_SESSION['cart'][$pid]['stock']){
			echo "<script>alert('จำนวนสินค้าที่คุณเลือกเกินจำนวนที่มีอยู่ในสต็อก');</script>";
		}
		else{
			$_SESSION['cart'][$pid]['qty'] += $_POST['qty'];
		}
	}
		
	// หากยังไม่เคยเลือกสินค้นนั้นจะ
	else
	    $_SESSION['cart'][$pid] = $cart_item;

// ปรับปรุงจำนวนสินค้า
} else if ($_GET["action"]=="update") {
	$pid = $_GET["pid"];     
	$qty = $_GET["qty"];

	// ตรวจสอบว่าจำนวนที่ปรับปรุงไม่เกินสต็อก
	if ($qty <= $_SESSION['cart'][$pid]['stock']) {
		$_SESSION['cart'][$pid]['qty'] = $qty;
	} else {
		echo "<script>alert('จำนวนสินค้าที่คุณเลือกเกินจำนวนที่มีอยู่ในสต็อก');</script>";
	}

	

// ลบสินค้า
} else if ($_GET["action"]=="delete") {
	
	$pid = $_GET['pid'];
	unset($_SESSION['cart'][$pid]);
}
?>
<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>CS Shop</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="mobile-web-app-capable" content="yes">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link href="mcss.css" rel="stylesheet" type="text/css" />
   <script src="mpage.js"></script>
</head>

<body>

   <header>
      <div class="logo">
         <img src="cslogo.jpg" width="200" alt="Site Logo">
      </div>
      <div class="search">
         <form>
            <input type="search" placeholder="Search the site...">
            <button>Search</button>
         </form>
      </div>
   </header>

   <div class="mobile_bar">
      <a href="#"><img src="responsive-demo-home.gif" alt="Home"></a>
      <a href="#" onClick='toggle_visibility("menu"); return false;'><img src="responsive-demo-menu.gif" alt="Menu"></a>
   </div>

   <main>
      <article>
      <a href="index.php" style="color:blue;">< เลือกสินค้าต่อ</a>
      <form action="Quiz4_test/1_test.php" method="post">
<table border="1">
<?php 
	$sum = 0;
	foreach ($_SESSION["cart"] as $item) {
		$sum += $item["price"] * $item["qty"];
?>
	<tr>
		<td><?=$item["pname"]?></td>
		<td><?=$item["price"]?></td>
		<td>			
			<input type="number" id="<?=$item["pid"]?>" value="<?=$item["qty"]?>" min="1" max="<?=$item['stock']?>">
			<a href="#" style="color:blue;" onclick="update(<?=$item['pid']?>)">แก้ไข</a>
			<a href="?action=delete&pid=<?=$item["pid"]?>" style="color:blue;">ลบ</a>
		</td>
	</tr>
<?php } ?>
<tr><td colspan="3" align="right">รวม <?=$sum?> บาท</td></tr>
</table>
      <button type="submit">checkout</button>
</form>


      </article>
      <nav id="menu">
         <h2>Navigation</h2>
         <ul class="menu">
         <li class="dead"><a href="./index.php">Home</a></li>
            <li><a href="./deleteProduct.php">Delete Product</a></li>
            <li><a href="./addProduct.php">Add Product</a></li>
            <li><a href="./editProduct.php">Edit Product</a></li>
            <li><a href="./member.php">Member</a></li>
            <li><a href="./deleteMember.php">Delete Member</a></li>
            <li><a href="./addMember.php">Add Member</a></li>
            <li><a href="./editMember.php">Edit Member</a></li>
            <li><a href="./user-home.php">Order</a></li>
            <li><a href="./Lab7.php">lab7</a></li>
            <li><a href="./mpage1.php">workshop1</a></li>
            <li><a href="./mpage2.php">workshop2</a></li>
            <li><a href="./mpage3.php">workshop3</a></li>
            <li><a href="./mpage4.php">workshop4</a></li>
            <li><a href="./mpage5.php">workshop5</a></li>
            <li><a href="./mpage6.php">workshop6</a></li>
            <li><a href="./mpage7.php">workshop7</a></li>
            <li><a href="./mpage9.php">workshop9</a></li>
         </ul>
      </nav>
      <aside>
         <h2>Aside</h2>
         <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit libero sit amet nunc ultricies, eu feugiat diam placerat. Phasellus tincidunt nisi et lectus pulvinar, quis tincidunt lacus viverra. Phasellus in aliquet massa. Integer iaculis massa id dolor venenatis scelerisque.
            <br><br>
         </p>
      </aside>
   </main>
   <footer>
      <a href="#">Sitemap</a>
      <a href="#">Contact</a>
      <a href="#">Privacy</a>
   </footer>
</body>

</html>