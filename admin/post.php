<?php
include("./include/nav.php");

$posts = $base->query("SELECT * FROM `posts` ORDER BY id DESC");

if(isset($_GET['action']) && isset($_GET['id'])){
  $action = $_GET['action'];
  $id = $_GET['id'];

  if($action == "delete"){
    $query = $base->query("DELETE FROM `posts` WHERE id = $id");

  }elseif($action == "deldefult"){
    $query = $base->prepare("UPDATE `posts-slider` SET active = '0' WHERE post_id = :id");
    $query->execute(['id' => $id]);

  }elseif($action == "slide"){
       
 $query = $base->prepare("INSERT INTO `posts-slider` (post_id) VALUES (:id)");
$query->execute(['id' => $id]);
  }elseif($action == "remove"){
    $query = $base->prepare("DELETE FROM `posts-slider` WHERE post_id = :id");
    $query->execute(['id' => $id]);
  }else{
    $query = $base->prepare("UPDATE `posts-slider` SET active = '1' WHERE post_id = :id");
    $query->execute(['id' => $id]);
  }
  
  
  header("location:post.php");
  exit();
}
?>
  
<br>
<br>
<br>
<section class="mt-4">
   <div class="row">
        <div class="col">
                       <div class="d-flex justify-content-between">
                       <h4>مقالات</h4>
                <a href="new-post.php" class="btn btn-outline-primary me-2"><i class="bi bi-plus-circle"></i> افزودن مقاله جدید</a>
                
                       </div>
                       <hr>
                <div>
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
      <th scope="row"><?php echo $post['id']; ?></th>
      <td><?php echo $post['title']; ?></td>
      <td><?php echo $post['auther']; ?></td>
      <td>
            <div class="dropdown">
            <button data-bs-toggle="dropdown" class="btn dropdown-toggle">
                      <i class="bi bi-gear"></i>
               </button>
               <ul class="dropdown-menu">
                 <?php
                 $i = $post['id'];
                 $slide = $base->query("SELECT active FROM `posts-slider` WHERE id = $i");
                 ?>
                   
              <li class="dropdown-item"><a href="post.php?action=slide&id=<?php echo $post['id']; ?>"><i class="bi bi-clipboard-plus"></i> افزودن به اسلایدر</a></li> 
              <li class="dropdown-item"><a href="post.php?action=remove&id=<?php echo $post['id']; ?> "><i class="bi bi-x-octagon"></i> حذف از اسلایدر</a></li>
              <li class="dropdown-item"><a href="post.php?action=defult&id=<?php echo $post['id']; ?>"><i class="bi bi-cloud-check"></i> پیشفرض کردن</a></li>
              <li class="dropdown-item"><a href="post.php?action=deldefult&id=<?php echo $post['id']; ?>"><i class="bi bi-x-circle"></i> حذف پیشفرض</a></li>
              <li class="dropdown-item"><a href="edit-post.php?id=<?php echo $post['id']; ?>"><i class="bi bi-pencil-fill"></i> ویرایش</a></li>
              <li class="dropdown-item"><a href="post.php?action=delete&id=<?php echo $post['id']; ?> "><i class="bi bi-trash-fill"></i> حذف</a></li>
               </ul>
            </div>
                    
      </td>
    </tr>
    <?php
      }
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