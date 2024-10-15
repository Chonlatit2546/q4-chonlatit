<?php session_start();
include "../connect.php";
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

          <?php 
          /*
            if(isset($_SESSION["username"])){
               foreach($_SESSION["cart"] as $item){
                  echo "<div>";
                  echo $item["pname"];
                  echo " ";
                  echo $item["price"];
                  echo "<br>";

                  echo "คุณมีสิทธิเลือกสิ้นค้า";
                  echo "<br>";   

                  $stmt = $pdo->prepare("SELECT SELECT * FROM product WHERE price <= ?");
                  $stmt->bindParam(1, $item["price"]);
                  $stmt->execute();

                  $i = 0;

                  while($i < $item["qty"]){

                     $i++;
                  };

                  

                  echo "</div>";
               }
            }
            else{
               foreach($_SESSION["cart"] as $item){
                  echo "<div>";
                  echo $item["pname"];
                  echo $item["price"];
                  echo "</div>";
               }
            }
               */
         ?> 

<?php  
if (isset($_SESSION["username"])) { 
    foreach ($_SESSION["cart"] as $item) { 
      
         // กำจัดอักขระพิเศษจาก pname เพื่อใช้เป็น id
         $sanitizedPname = preg_replace('/[^a-zA-Z0-9]/', '', $item["pname"]);


        echo "<div>"; 
        echo $item["pname"] . "<br>" . "ราคา:" . $item["price"] . " จำนวน:" . $item["qty"] ."<br>";
        echo "<label>ใช้สิทธิหรือไม่ </label>";
        echo "<label>ใช้</label>";
        echo "<input type='radio' name='s' value='yes' onchange='handleRight(". json_encode($sanitizedPname) . ")'>";
        echo "<label >ไม่ใช้</label>";
        echo "<input type='radio' name='s' value='no' onchange='handleRight(". json_encode($sanitizedPname) . ")'>";
        echo "<br>";
        echo "คุณมีสิทธิเลือกสินค้าเพิ่มอีก 1 ชิ้นที่ราคาเท่ากันหรือน้อยกว่า จำนวน " . $item['qty'] . "ชิ้น" ."<br>"; 
   
        // ดึงรายการสินค้าที่มีราคาน้อยกว่าหรือเท่ากับ
        $stmt = $pdo->prepare("SELECT * FROM product WHERE price <= ?"); 
        $stmt->bindParam(1, $item["price"]); 
        $stmt->execute(); 
        $availableProducts = $stmt->fetchAll(); // ดึงข้อมูลทั้งหมด
      
        // แสดงสินค้าให้เลือก
        echo "<form method='post' id='select-free-product". $sanitizedPname ."'>";
        $i = 0;
        while ($i < $item['qty']) {
        echo "<select>";
        foreach ($availableProducts as $product) {
            
            echo "<option>". $product['pname'] ."</option>";
            
        }
        echo "</select>";
        echo "<br>";
        $i++;
      }
        echo "<input type='submit' name='select_free' value='เลือกรายการฟรี'>";
        echo "</form>";

        

        echo "</div>";
    }
} else {
   echo "<div>"; 
   
   $totalPrice = 0;

   foreach ($_SESSION["cart"] as $item) { 
      
      echo $item["pname"] . " " . "ราคา:" . $item["price"] . " จำนวน:" . $item["qty"] ."<br>";
      $totalPrice += $item['price'] * $item['qty'];

   }

 if($totalPrice > 500){

   
     
     echo "<label>ใช้สิทธิหรือไม่ </label>";
     echo "<label>ใช้</label>";
     echo "<input type='radio' name='s' value='yes' onchange='handleRight2()'>";
     echo "<label >ไม่ใช้</label>";
     echo "<input type='radio' name='s' value='no' onchange='handleRight2()'>";
     echo "<br>";
     echo "คุณมีสิทธิเลือกสินค้าเพิ่มอีก 1 ชิ้นที่ราคาเท่ากันหรือน้อยกว่า"; 


     // ดึงรายการสินค้าที่มีราคาน้อยกว่าหรือเท่ากับ
     $stmt = $pdo->prepare("SELECT * FROM product WHERE price <= ?"); 
     $stmt->bindParam(1, $item["price"]); 
     $stmt->execute(); 
     $availableProducts = $stmt->fetchAll(); // ดึงข้อมูลทั้งหมด
   
     // แสดงสินค้าให้เลือก
     echo "<form method='post' id='select-free-product'>";
     $i = 0;
     
     echo "<select>";
     foreach ($availableProducts as $product) {
         
         echo "<option>". $product['pname'] ."</option>";
         
     }
     echo "</select>";
     echo "<br>";
     $i++;
   
     echo "<input type='submit' name='select_free' value='เลือกรายการฟรี'>";
     echo "</form>";

     

    
 }
   echo "</div>";
}
?>

      </article>


      <nav id="menu">
         <h2>Navigation</h2>
         <ul class="menu">
         <li class="dead"><a href="../index.php">Home</a></li>
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