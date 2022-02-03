<?php
session_start();
include("./include/config.php");
include("./include/db.php");
if( ! isset($_SESSION['email'])){
  header("location:signin.php?err=شما برای دسترسی به پنل مدیریت باید وارد شوید");
  exit();
}
$sy = $base->query("SELECT * FROM `information` WHERE id = 4 ");
$sadmin = $base->query("SELECT * FROM `information` WHERE id = 5 ");

?>
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
               <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
</head>
<body >


<nav class="navbar fixed-top navbar-dark bg-dark p-3 mb-5 border-bottom">
  <div class="container ms-2">
  <button class="btn  fs-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
<i class="bi bi-text-indent-right"></i>
</button>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">پنل مدیریت</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body position-sticky">
    <ul class="nav flex-column">
      <li class=" nav-item p-2"><a class="text-dark nav-link active" href="index.php"><i class="bi bi-house"></i> داشبورد</a></li>
      <li class=" nav-item p-2"><a  class=" text-dark nav-link" href="post.php"><i class="bi bi-file-earmark-richtext"></i> مقالات</a></li>
      <li class=" nav-item p-2"><a class=" text-dark nav-link" href="category.php"><i class="bi bi-pie-chart"></i> دسته بندی ها</a></li>
      <li class="nav-item p-2"><a class="text-dark nav-link" href="comment.php"><i class="bi bi-chat-dots"></i> کامنت ها</a></li>
      <li class="nav-item p-2"><a class="text-dark nav-link" href="subscribers.php"><i class="bi bi-person"></i> کاربران</a></li>
      <li class="nav-item p-2"><a class="text-dark nav-link" href="admins.php"><i class="bi bi-person-circle"></i> مدیران</a></l
      <li class="nav-item p-2"><a class="text-dark nav-link" href="connect.php"><i class="bi bi-chat-dots"></i> ارتباط ها</a></li>
      <li class="nav-item p-2"><a class="text-dark nav-link" href="settings.php"><i class="bi bi-gear"></i> تنظیمات</a></li>
      
    </ul>
  </div>
</div>
<?php
  if($sadmin->rowcount() > 0){
  foreach($sadmin as $ssadmin){
   ?>
    <a href="index.php" class="navbar-brand"><?php echo $ssadmin['body']; ?></a>
   <?php 
  }
}
?> 
   
   

      <div class="dropdown text-end">
        <a href="index.php" class="d-block link-dark text-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="./img/hey.jpg" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" target="_blank" href="../"><i class="bi bi-eye"></i> دیدن سایت</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item " href="index.php"><i class="bi bi-house"></i> داشبورد</a></li>
          <li><a class="dropdown-item" href="new-post.php"><i class="bi bi-plus-lg"></i> افزودن پست جدید</a></li>
          <li><a class="dropdown-item" href="new-category.php"><i class="bi bi-plus-lg"></i> افزودن دسته جدید</a></li>
          <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear-fill"></i> تنظیمات</a></li>
          
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> خروج</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
