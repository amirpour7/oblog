<?php
include("./include/nav.php");
$admins = $base->query("SELECT * FROM `users`");
if(isset($_GET['action']) && isset($_GET['id'])){
$id = $_GET['id'];
$query_delete = $base->prepare("DELETE FROM `users` WHERE id = :id");
$query_delete->execute(['id' => $id]);
header("location:admins.php");
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
                       <h4>مدیران</h4>
                       <a href="add-admins.php" class="btn btn-outline-primary me-3"><i class="bi bi-patch-plus-fill"></i> افزودن مدیر جدید</a>
                       </div>
                       <hr>
                <div>
                <table class="table table-light table-striped table-responsive">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ایمیل مدیر</th>
      <th scope="col">امکانات</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if($admins->rowcount() > 0){
      foreach($admins as $modators){
        ?>
         <tr>
      <th scope="row"><?php echo $modators['id']; ?></th>
      <td><?php  echo $modators['email']; ?></td>
      <td>
            <div class="dropdown">
         
            <button data-bs-toggle="dropdown" class="btn dropdown-toggle">
                      <i class="bi bi-gear"></i>
               </button>
               <ul class="dropdown-menu">  
               <li class="dropdown-item"><a href="edit-admins.php?id=<?php echo $modators['id'];?>"><i class="bi bi-pencil-fill"></i> ویرایش</a></li>  
              <li class="dropdown-item"><a href="admins.php?action=delete&id=<?php echo $modators['id'];?>"><i class="bi bi-trash-fill"></i> حذف</a></li>
             
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
  کسی عضو سایت شما نیست
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