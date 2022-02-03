<?php
include("./include/nav.php");

$categories = $base->query("SELECT * FROM `categories` ORDER BY id DESC");
if(isset($_GET['action']) && isset($_GET['id'])){
  $id = $_GET['id'];
  $query = $base->prepare("DELETE FROM `categories` WHERE id = :id");
  $query->execute(['id' => $id ]);
  header("location:category.php");
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
                       <h4>دسته بندی ها</h4>
                <a href="new-category.php" class="btn btn-outline-primary me-2"><i class="bi bi-plus-circle"></i> افزودن دسته بندی جدید</a>
                
                       </div>
                       <hr>
                <div>
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
      <th scope="row"><?php echo $category['id'] ; ?></th>
     <td><?php echo $category['title'] ; ?></td>
      <td>
            <div class="dropdown">
            <button data-bs-toggle="dropdown" class="btn dropdown-toggle">
                      <i class="bi bi-gear"></i>
               </button>
               <ul class="dropdown-menu">
                      <li class="dropdown-item"><a href="edit-category.php?id=<?php echo $category['id']; ?>"><i class="bi bi-pencil-fill"></i> ویرایش</a></li>
                     <li class="dropdown-item"><a href="category.php?action=delete&id=<?php echo $category['id'] ; ?>"><i class="bi bi-trash-fill"></i> حذف</a></li>
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