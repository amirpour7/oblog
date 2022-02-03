<?php
include("./include/nav.php");
if(isset($_POST['add-admin'])){
if(trim($_POST['admin-mail']) != "" && trim($_POST['admin-pass']) != ""){
$admin_mail = $_POST['admin-mail'];
$admin_pass = $_POST['admin-pass'];
$add = $base->prepare("INSERT INTO `users` (email , password) VALUES (:email , :password)");
$add->execute(['email' => $admin_mail , 'password' => $admin_pass ]);
header("location:admins.php");
exit();
}
}
?>
<br><br><br>
<section>
 <div class="row">
  <div class="col">
 <div class="mt-3">
<h4>افزودن مدیر جدید</h4>
<hr>
</div>
<div>
<form class="p-5"  method="post">
               <label class="form-label" for="email">ایمیل مدیر</label>
               <input  name="admin-mail" class="form-control" type="email">
               <label class="form-label" for="password">رمز مدیر</label>
               <input name="admin-pass" class="form-control" type="password">
               <button name="add-admin" type="submit" class="btn btn-outline-secondary mt-3">افزودن مدیر</button>
</form>
</div>
</div>
</div>
</section>
<?php
include("../include/footer.php");
?>
