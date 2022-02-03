<?php
include("./include/nav.php");
$connect = $base->query("SELECT * FROM messages");
if(isset($_GET['action']) && isset($_GET['id'])){

  $id = $_GET['id'];
  $query = $base->prepare("DELETE FROM `messages` WHERE id = :id");
  $query->execute(['id' => $id]);
  header("location:connect.php");
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
                       <h4>ارتباط ها</h4>
                       </div>
                       <hr>
                <div>
                <table class="table table-succes table-responsive">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">نام فرد</th>
      <th scope="col">ایمیل فرد</th>
      <th scope="col">متن فرد</th>
      <th scope="col">امکانات</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if($connect->rowcount() > 0){
      foreach($connect as $con){
        ?>
         <tr>
      <th scope="row"><?php echo $con['id']; ?></th>
      <td><?php echo $con['name']; ?></td>
      <td><?php echo $con['email']; ?></td>
      <td><?php echo $con['text']; ?></td>
      <td>
            <div class="dropdown">
         
            <button data-bs-toggle="dropdown" class="btn dropdown-toggle">
                      <i class="bi bi-gear"></i>
               </button>
               <ul class="dropdown-menu">    
              <li class="dropdown-item"><a href="connect.php?action=delete&id=<?php echo $con['id'];?>"><i class="bi bi-trash-fill"></i> حذف</a></li>
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
 پیامی نیست
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