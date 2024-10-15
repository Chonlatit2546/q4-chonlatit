<?php include "../connect.php" ?>

<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>CS Shop</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="mobile-web-app-capable" content="yes">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link href="../mcss.css" rel="stylesheet" type="text/css" />
   <script src="../mpage.js"></script>
</head>

<body>

   <header>
      <div class="logo">
         <img src="../cslogo.jpg" width="200" alt="Site Logo">
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

         <?php session_start(); ?>


         <?php
         // 1. กำหนดคำสั่ง SQL ให้ดึงสินค้าตามรหัสสินค้า
         $stmt = $pdo->prepare("SELECT * FROM product WHERE pid = ?");
         $stmt->bindParam(1, $_GET["pid"]);  // 2. นำค่า pid ที่ส่งมากับ URL กำหนดเป็นเงื่อนไข        
         $stmt->execute();    // 3. เริ่มค้นหา
         $row = $stmt->fetch();   // 4. ดึงผลลัพธ์ (เนื่องจากมีข้อมูล 1 แถวจึงเรียกเมธอด fetch เพียงครั้งเดียว)
         ?>

         <a href="cart.php?action=" style="color:blue;">สินค้าในตะกร้า (<?= sizeof($_SESSION['cart']) ?>)</a>
         <div style="display:flex">
            <div>
               <img src='../prod_photo/<?= $row["pid"] ?>.jpg' width='200'>
            </div>
            <div style="padding: 15px">
               <h2><?= $row["pname"] ?></h2>
               รายละเอียดสินค้า: <?= $row["pdetail"] ?><br>
               ราคาขาย <?= $row["price"] ?> บาท<br>
               <form method="post" action="../cart.php?action=add&pid=<?= $row["pid"] ?>&pname=<?= $row["pname"] ?>&price=<?= $row["price"] ?>">
                  <input type="number" name="qty" value="1" min="1" max="<?= $row["quantity"] ?>">
                  <input type="hidden" name="quantity" value="<?= $row['quantity'] ?>">
                  <input type="submit" value="ซื้อ">
               </form>
            </div>
         </div>


      </article>
      <nav id="menu">
         <h2>Navigation</h2>
         <ul class="menu">
         <li class="dead"><a href="../index.php">Home</a></li>
            <li><a href="deleteProduct.php">Delete Product</a></li>
            <li><a href="addProduct.php">Add Product</a></li>
            <li><a href="editProduct.php">Edit Product</a></li>
            <li><a href="../Member/member.php">Member</a></li>
            <li><a href="../Member/deleteMember.php">Delete Member</a></li>
            <li><a href="../Member/addMember.php">Add Member</a></li>
            <li><a href="../Member/editMember.php">Edit Member</a></li>
            <li><a href="../Order/user-home.php">Order</a></li>
            <li><a href="../Lab7/Lab7.php">lab7</a></li>
            <li><a href="../Lab8-9/mpage1.php">workshop1</a></li>
            <li><a href="../Lab8-9/mpage2.php">workshop2</a></li>
            <li><a href="../Lab8-9/mpage3.php">workshop3</a></li>
            <li><a href="../Lab8-9/mpage4.php">workshop4</a></li>
            <li><a href="../Lab8-9/mpage5.php">workshop5</a></li>
            <li><a href="../Lab8-9/mpage6.php">workshop6</a></li>
            <li><a href="../Lab8-9/mpage7.php">workshop7</a></li>
            <li><a href="../Lab8-9/mpage9.php">workshop9</a></li>
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