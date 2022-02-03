<?php
include("./include/nav.php");

if(isset($_GET['id'])){
  $idad = $_GET['id'];
  $edits = $base->prepare("SELECT * FROM users WHERE id = :idad");
  $edits->execute(['idad' => $idad]);
  $edits = $edits->fetch();
}
if(isset($_POST['edit-admin'])){
if(trim($_POST['admin-maile']) != ""  && trim($_POST['admin-passe']) == ""){
$mail = $_POST['admin-maile'];
$queryf = $base->query("UPDATE `users` SET email = '$mail' WHERE id=$idad ");
header("location:admins.php");
exit();
}
if(trim($_POST['admin-maile']) != "" && trim($_POST['admin-passe']) != ""){
               $mail = $_POST['admin-maile'];
               $pass = $_POST['admin-passe'];
               
               $queryf = $base->query("UPDATE `users` SET email = '$mail' WHERE id=$idad");
               $queryg = $base->query("UPDATE `users` SET password = '$pass' WHERE id=$idad");
               header("location:admins.php");
              
               }
}

// if(isset($_POST['add-admin'])){
// if(trim($_POST['admin-mail']) != "" && trim($_POST['admin-pass']) != ""){
// $admin_mail = $_POST['admin-mail'];
// $admin_pass = md5($_POST['admin-pass']);
// $add = $base->prepare("INSERT INTO `users` (email , password) VALUES (:email , :password)");
// $add->execute(['email' => $admin_mail , 'password' => $admin_pass ]);
// header("location:admins.php");
// exit();
// }
// }
?>
<br><br><br>
<section>
 <div class="row">
  <div class="col">
 <div class="mt-3">
<h4>ویرایش مدیر</h4>
<hr>
</div>
<div>
<form class="p-5"  method="post">
               
               
               <label class="form-label" for="email">ایمیل مدیر</label>
               <input value="<?php echo $edits['email'];?>" name="admin-maile" class="form-control" type="email">
               <label class="form-label" for="password">رمز مدیر</label>
               <input name="admin-passe" class="form-control" type="password">
              
               
               <button name="edit-admin" type="submit" class="btn btn-outline-secondary mt-3">ویرایش مدیر</button>
</form>
</div>
</div>
</div>
</section>
<?php
include("../include/footer.php");
?>
