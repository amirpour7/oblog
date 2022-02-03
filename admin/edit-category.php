<?php
include("./include/nav.php");


if(isset($_GET['id'])){

$category_id = $_GET['id'];
$category = $base->prepare("SELECT * FROM `categories` WHERE id = :category_id ");
$category->execute(['category_id' => $category_id ]);
$category = $category->fetch();


}

if(isset($_POST['btncategoryedit'])){

if(trim($_POST['categoryedit']) != ""){

$title = $_POST['categoryedit'];


$query = $base->prepare("UPDATE `categories` SET title = :title WHERE id = :category_id");
$query->execute(['title' => $title , 'category_id' => $category_id ]);
header("location:category.php");
   exit();
}else{
      header("location:edit-category.php?id=$category_id&err-ms=تمام فیلد ها باید وارد شوند");
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
                    <div>
                    <h4 class="pt-4 pb-4">ویرایش دسته بندی</h4>
                    <hr>
                    </div>
 <?php
 if(isset($_GET['err-ms'])){
   ?>
 <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
   <?php echo $_GET['err-ms'];?>
  </div>
</div>
    </div>
<?php
 }
?>
                    <div>
                    <form method="post" class="p-5">
                    <?php
                   
                  ?>
                                           <label for="categorynew" class="ms-2 form-label">نام دسته</label>
                      <input type="text" value="<?php echo $category['title']; ?>" name="categoryedit" id="categorynew" class="ms-2 mb-3 form-control">
                      <button type="submit" name="btncategoryedit" class=" ms-2 mb-3 btn btn-outline-secondary">ویرایش</button>
                   
        
               </form>
                    </div>
        </div>
   </div>
</section>
<?php
include("../include/footer.php");
?>