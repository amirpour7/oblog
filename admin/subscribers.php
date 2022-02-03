<?php
include("./include/nav.php");

$users = $base->query("SELECT * FROM subscribers");
if(isset($_GET['action']) && isset($_GET['id'])){

  $id = $_GET['id'];
  $query = $base->prepare("DELETE FROM `subscribers` WHERE id = :id");
  $query->execute(['id' => $id]);
  header("location:subscribers.php");
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
                       <h4>کاربران</h4>
                       </div>
                       <hr>
                <div>
                <table class="table table-primary table-responsive">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">نام فرد</th>
      <th scope="col">ایمیل فرد</th>
      <th scope="col">امکانات</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if($users->rowcount() > 0){
      foreach($users as $user){
        ?>
         <tr>
      <th scope="row"><?php echo $user['id']; ?></th>
      <td><?php echo $user['name']; ?></td>
      <td><?php echo $user['email']; ?></td>
      <td>
            <div class="dropdown">
         
            <button data-bs-toggle="dropdown" class="btn dropdown-toggle">
                      <i class="bi bi-gear"></i>
               </button>
               <ul class="dropdown-menu">    
              <li class="dropdown-item"><a href="subscribers.php?action=delete&id=<?php echo $user['id'];?>"><i class="bi bi-trash-fill"></i> حذف</a></li>
               </ul>
            </div>
                    
      </td>
    </tr>
        <?php
      }
    }else{
      ?>
               <div class="col">
    <div class="alert alert-danger align-items-center" role="alert">
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