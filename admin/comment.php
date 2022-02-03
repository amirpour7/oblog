<?php
include("./include/nav.php");


 $comments = $base->query("SELECT * FROM comments ORDER BY id DESC");

 if(isset($_GET['action']) && isset($_GET['id'])){
  
  $action = $_GET['action'];
  $id = $_GET['id'];

  if($action == "delete"){
    $query = $base->prepare('DELETE FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
    header("Location:comment.php");
    exit();
  }else{
    $query = $base->prepare("UPDATE comments SET statues='1' WHERE id = :id");
    $query->execute(['id' => $id]);
    header("Location:comment.php");
   exit();
   }
   
 }



?>
<br>
<br>
<br>
<section class="mt-4">
   <div class="row">
        <div class="col">
                       <div class="d-flex justify-content-between">
                       <h4>کامنت ها</h4>
                       </div>
                       <hr>
                <div>
                <table class="table table-info table-responsive">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">نام فرد</th>
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
      <th scope="row"><?php echo $comment['id']; ?></th>
      <td><?php echo $comment['name']; ?></td>
      <td><?php echo $comment['comment']; ?></td>
      <td>
            <div class="dropdown">
         
            <button data-bs-toggle="dropdown" class="btn dropdown-toggle">
                      <i class="bi bi-gear"></i>
               </button>
               <ul class="dropdown-menu">
               <?php
              if($comment['statues']){
                ?>
                <li class="dropdown-item"><a><i class="bi bi-shield-fill-check"></i> تایید شده</a></li>
                <?php
              }else{
                ?>
                <li class="dropdown-item"><a href="comment.php?action=approve&id=<?php echo $comment['id'];?>"><i class="bi bi-check-circle"></i> تایید</a></li>
              <?php
              }
              ?>
                      
              <li class="dropdown-item"><a href="comment.php?action=delete&id=<?php echo $comment['id'];?>"><i class="bi bi-trash-fill"></i> حذف</a></li>
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
  کامنتی وجود ندارد
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