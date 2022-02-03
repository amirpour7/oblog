<?php
session_start();
include("./include/config.php");
include("./include/db.php");
include("../include/svg.php");

if(isset($_POST['login'])){

if (trim($_POST['email']) != "" AND trim($_POST['password']) != ""){

$email = $_POST['email'];
$password= $_POST['password'];
$user_select = $base->prepare("SELECT * FROM users WHERE email=:email AND password=:password ");
$user_select->execute(['email' => $email, 'password' => $password]);
   if($user_select->rowcount() == 1){
                  $_SESSION['email'] = $email;
                  header("location:index.php");
               
   }else{
   header("location:signin.php?err=نام کاربری یا رمز عبور اشتباه است");
   }
}else{
header("location:signin.php?err=همه ی فیلد ها باید پر شود");
exit();
    }           
}
$sy = $base->query("SELECT * FROM `information` WHERE id = 4 ");
?>
<br>
<!DOCTYPE html>
<html lang="fa">
<head>
               <meta charset="UTF-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <?php
  if($sy->rowcount() > 0){
  foreach($sy as $si){
   ?>
   <title><?php echo $si['body']; ?></title>
   <?php 
  }
}
?> 
               <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
               <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
               <link rel="stylesheet" href="./css/admin.css">
</head>
<body class="body">
       <div class="container bg-light">
   <?php
if(isset($_GET['err'])){
  ?>

<div class="col mt-3">
    <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
   <?php echo $_GET['err']; ?>
  </div>
</div>
    </div>

<?php   
   }  
   
   $log = $base->query("SELECT * FROM `information` WHERE id = 6");
 ?>
                      <div class="row mt-4 text-center">
                                     <h3 class="mt-3 mb-3">ورود به پنل مدیریت</h3>
                                     <p>برای ورود به پنل مدیریت لطفا فرم زیر را پر کنید</p>
                      </div>
<?php
 if($log->rowcount() > 0){
  foreach($log as $notif){

    if($notif['body'] == 1){
?>
    <div class="card">
  <div class="card-body">
    ایمیل پیشفرض : admin@gmail.com
    <br>
    رمز پیشفرض : oblog
    <br>

    لطفا بعد از ورود به پنل مدیریت ایمیل و پسورد خود را از طریق بخش مدیران ویرایش کرده و  تغییر داده و این بخش را نیز از طریق تنظیمات "غیر فعال کردن اعلان ورود" غیر فعال کنید.
  </div>
</div>

<?php
    }
  }
}
?>
            <div class="card-body">
               <div class="col  p-5  mt-5 mb-5 justify-content-center align-items-center">
              <form action="" method="post">
             
              <label for="email" class="form-label">ایمیل:</label>
              
              <div class=" col-md-12 input-group">
              <span class="input-group-text"><i class="bi bi-envelope-open"></i></span>
              <input type="email" name="email" id="email" class="form-control">
              
             </div>
            <label class="form-label" for="password">رمز ورود:</label>
               <div class="input-group">
               <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
               <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div>
                   <button class=" mt-3  justify-content-center btn btn-outline-primary" name="login" type="submit"><i class="bi bi-shield-lock-fill"></i> ورود</button>
                    </div>
             </form>
                  </div>
            </div>
       </div>






</body>
</html>
<?php
include("../include/footer.php");
?>