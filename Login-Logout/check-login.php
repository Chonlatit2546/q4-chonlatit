
         <?php
         include "../connect.php";
         session_start();

         $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
         $stmt->bindParam(1, $_POST["username"]);
         $stmt->bindParam(2, $_POST["password"]);
         $stmt->execute();
         $row = $stmt->fetch();

         // หาก username และ password ตรงกัน จะมีข้อมูลในตัวแปร $row
         if (!empty($row)) {
            // นำข้อมูลผู้ใช้จากฐานข้อมูลเขียนลง session 2 ค่า
            $_SESSION["fullname"] = $row["name"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];



            // แสดง link เพื่อไปยังหน้าต่อไปหลังจากตรวจสอบสำเร็จแล้ว
            echo "เข้าสู่ระบบสำเร็จ<br>";

            header("Location: ../index.php");
            //echo "<a href='user-home.php' style='color:blue;'>ไปยังหน้าหลักของผู้ใช้</a>";

            // กรณี username และ password ไม่ตรงกัน
         } else {
            echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง";
            echo "<a href='login-form.php' style='color:blue;'>เข้าสู่ระบบอีกครัง</a>";
         }
         ?>

 