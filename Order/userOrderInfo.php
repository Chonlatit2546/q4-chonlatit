<?php include "../connect.php" ?>
<?php session_start();

$stmt = $pdo->prepare('SELECT product.pname,orders.ord_date,item.quantity,SUM(item.quantity * product.price) AS price FROM item JOIN orders ON item.ord_id = orders.ord_id JOIN product ON item.pid = product.pid WHERE orders.username = ? GROUP BY product.pname,orders.ord_date ORDER BY ord_date;');
$stmt->bindParam(1, $_GET["username"]);
$stmt->execute();

?>

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

         <a href="user-home.php" style="color:blue;">กลับ</a>
         <?php
         echo "<h2>รายการสั่งซื้อของคุณ " . $_GET["username"] . "</h2>";
         echo "<table>";
         echo "<tr>
      <th>product name</th>
      <th>order date</th>
      <th>quantity</th>
      <th>price</th>
      </tr>";

         while ($row = $stmt->fetch()) {

            echo "<tr>";
            echo "<td>" . $row["pname"] . "</td>";
            echo "<td>" . $row["ord_date"] . "</td>";
            echo "<td>" . $row["quantity"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "</tr>";

            // echo $row["pname"] . " " . $row["ord_date"] . " " . $row["quantity"] . " " . $row["price"] . "<br>";
         }
         echo "</table>";
         ?>

      </article>
      <nav id="menu">
         <h2>Navigation</h2>
         <ul class="menu">
         <li class="dead"><a href="../index.php">Home</a></li>
            <li><a href="../Product/deleteProduct.php">Delete Product</a></li>
            <li><a href="../Product/addProduct.php">Add Product</a></li>
            <li><a href="../Product/editProduct.php">Edit Product</a></li>
            <li><a href="../Member/member.php">Member</a></li>
            <li><a href="../Member/deleteMember.php">Delete Member</a></li>
            <li><a href="../Member/addMember.php">Add Member</a></li>
            <li><a href="../Member/editMember.php">Edit Member</a></li>
            <li><a href="user-home.php">Order</a></li>
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