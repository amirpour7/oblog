<?php
include("./include/nav.php");

include("../include/svg.php");

if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {

  $entity = $_GET['entity'];
  $action = $_GET['action'];
  $id = $_GET['id'];

  if ($action == "delete") {

      if ($entity == "post") {
          $query = $base->prepare('DELETE FROM posts WHERE id = :id');
      } elseif ($entity == "category") {
          $query = $base->prepare('DELETE FROM categories WHERE id = :id');
      } else {
          $query = $base->prepare('DELETE FROM comments WHERE id = :id');
      }
      
      $query->execute(['id' => $id]);
  } else {
      $query = $base->prepare("UPDATE comments SET statues='1' WHERE id = :id");
      $query->execute(['id' => $id]);
  }
}

$posts= $base->query("SELECT * FROM `posts` ORDER BY id DESC");
$comments = $base->query("SELECT * FROM `comments` WHERE statues = '0' ORDER BY id DESC");
$categories = $base->query("SELECT * FROM `categories` ORDER BY id DESC");
 


 ?>
<br>
<br>
<br>
<section>
<div class="row">
               <div class="col mt-5">
         <h4 class="text-center">داشبورد</h4>
         <hr>
         <div>
         <h4>مقالات اخیر</h4>
         
         <table class="table table-warning table-responsive">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">عنوان</th>
      <th scope="col">نویسنده</th>
      <th scope="col">امکانات</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if($posts->rowcount() > 0){
      foreach($posts as $post){
        ?>
            <tr>
      <td><?php echo $post['id']; ?></td>
      <td><?php echo $post['title']; ?></td>
      <td><?php echo $post['auther']; ?></td>
      <td>
            <div class="dropdown">
            <button data-bs-toggle="dropdown" class="btn dropdown-toggle">
                      <i class="bi bi-gear"></i>
               </button>
               <ul class="dropdown-menu">
                      <li class="dropdown-item"><a href="edit-post.php?id=<?php echo $post['id']; ?>"><i class="bi bi-pencil-fill"></i> ویرایش</a></li>
                     <li class="dropdown-item"><a href="index.php?entity=post&action=delete&id=<?php echo $post['id']; ?> "><i class="bi bi-trash-fill"></i> حذف</a></li>
               </ul>
            </div>
                    
      </td>
    </tr>
    <?php
      }
    }else{
      ?>
         <div class="col">
    <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
   هیچ دسته بندی وجود ندارد
  </div>
</div>
    </div>
      <?php
    }
    ?>

 

   
    
                    

   
  </tbody>
</table>
         </div>
         <div>
         <h4>کامنت های اخیر</h4>
         
         <table class="table table-info table-responsive">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">نام</th>
      <th scope="col">کامنت</th>
      <th scope="col">امکانات</th>
    </tr>
  </thead>
  <tbody>
  <?php
    if($comments->rowcount() > 0){
      foreach($comments as $comment){
        ?>
            <tr>
      <td><?php echo $comment['id']; ?></td>
      <td><?php echo $comment['name']; ?></td>
      <td><?php echo $comment['comment']; ?></td>
      <td>
            <div class="dropdown">
            <button data-bs-toggle="dropdown" class="btn dropdown-toggle">
                      <i class="bi bi-gear"></i>
               </button>
               <ul class="dropdown-menu">
               <li class="dropdown-item"><a href="index.php?entity=comment&action=approve&id=<?php echo $comment['id'] ;?>"><i class="bi bi-check-lg"></i> تایید</a></li>
               <li class="dropdown-item"><a href="index.php?entity=comment&action=delete&id=<?php echo $comment['id'] ;?>"><i class="bi bi-trash-fill"></i> حذف</a></li>
               </ul>
            </div>
                    
      </td>
    </tr>
    <?php
      }
    }else{
      ?>
         <div class="col">
    <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
   کامنتی وجود ندارد یا تایید شده
  </div>
</div>
    </div>
      <?php
    }
    ?>
    
   
  </tbody>
</table>
         </div>

         <div>
         <h4>دسته بندی ها</h4>
         
  <table class="table table-danger table-responsive">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">عنوان</th>
      <th scope="col">امکانات</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if($categories->rowcount() > 0){
      foreach($categories as $category){
        ?>
   <tr>
      <td><?php echo $category['id']; ?></td>
      <td><?php echo $category['title']; ?></td>
      <td>
            <div class="dropdown">
            <button data-bs-toggle="dropdown" class="btn dropdown-toggle">
                      <i class="bi bi-gear"></i>
               </button>
               <ul class="dropdown-menu">
               <li class="dropdown-item"><a href="edit-category.php?id=<?php echo $category['id'] ;?>"><i class="bi bi-pencil-fill"></i> ویرایش</a></li>
               <li class="dropdown-item"><a href="index.php?entity=category&action=delete&id=<?php echo $category['id'] ;?>"><i class="bi bi-trash-fill"></i> حذف</a></li>
               </ul>
            </div>
                    
      </td>
    </tr>
   
        <?php
      }
    }else{
      ?>
         <div class="col">
    <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
   دسته بندی ای موجود نیست
  </div>
</div>
    </div>
      <?php
    }
    ?>
   
   
  </tbody>
</table>
  </div>
  </div>
</div>
</section>

<?php
include("../include/footer.php");
?>