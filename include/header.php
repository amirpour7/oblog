<?php
include("./include/config.php");
include("./include/db.php");
$query ="SELECT * FROM `categories`";
$categories = $base->query($query);
$sy = $base->query("SELECT * FROM `information` WHERE id = 4 ");

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
 
               <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
               <link rel="stylesheet" href="./css/style.css">
               <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
</head>
<body>

<nav class="navbar nav-tabs fixed-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  
    <a class="navbar-brand" href="index.php"><?php echo $si['body']; ?></a>
  <?php 
  }
}
?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">خانه</a>
        </li>
        <?php

        if($categories->rowcount() > 0){
          foreach($categories as $category){
            ?>
  <li class="nav-item <?php echo (isset($_GET['category']) && $category['id'] == $_GET['category']) ? "active" : ""; ?> ">
          <a href="index.php?category=<?php echo $category['id'] ?> " class="nav-link"><?php echo $category['title'] ?> </a>

          </li>
            <?php
          }
        }
       ?> 
       
   <li class="nav-item">
        <a href="#hello" data-bs-toggle="modal" class="nav-link">ارتباط با ما</a>
      </li>
  
        
      </ul>
      <form action= "search.php" method = "get" class="d-flex">
        <input name="search" class="form-control me-2" type="search" placeholder="متن شما" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">جستجو</button>
      </form>
    </div>
  </div>
</nav>