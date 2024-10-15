function toggle_visibility(id) {
  var e = document.getElementById(id);
  if(e.style.display == 'block')
    e.style.display = 'none';
  else
    e.style.display = 'block';
}
window.onresize = function(event) {
  var e = document.getElementById("menu");
  var w = window.innerWidth;
  if(w > 599)
    e.style.display = 'block';
  else
    e.style.display = 'none';
};

function confirmDelete(usr){
   var ans = confirm("ต้องการลบสมาชิก " + usr);
   if(ans == true){
      document.location = "./deleteMember_db.php?username=" + usr;
   }
}

// ใช้สำหรับปรับปรุงจำนวนสินค้า
function update(pid) {
  var qty = document.getElementById(pid).value;
  console.log(qty);
  // ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
  document.location = "cart.php?action=update&pid=" + pid + "&qty=" + qty; 
}

function deleteProduct(pid){
  var ans = confirm("ต้องการลบสินค้า " + pid);
  if(ans == true){
    document.location = "./deleteProduct_db.php?pid=" + pid;
  }
}

function handleRight(pname){
  let selectedRadio = document.querySelector("input[name='s']:checked");
  let free = document.getElementById('select-free-product' + pname);
  if (selectedRadio && (selectedRadio.value=='no')) {
    
    free.style.display = 'none';
  }else if (selectedRadio && selectedRadio.value == 'yes') {
    free.style.display = 'block'; // แสดงส่วนการเลือกสินค้าฟรีเมื่อเลือก 'yes'
  }
}

function handleRight2(){
  let selectedRadio = document.querySelector("input[name='s']:checked");
  let free = document.getElementById('select-free-product');
  if (selectedRadio && (selectedRadio.value=='no')) {
    
    free.style.display = 'none';
  }else if (selectedRadio && selectedRadio.value == 'yes') {
    free.style.display = 'block'; // แสดงส่วนการเลือกสินค้าฟรีเมื่อเลือก 'yes'
  }
}
