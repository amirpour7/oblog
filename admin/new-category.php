<?php
include("./include/nav.php");


if (isset($_POST['btncategory'])){
  
  if (trim($_POST['categorynew'])){

$new = $_POST['categorynew'];

$query = $base->prepare("INSERT INTO `categories` (title) VALUES (:title)");

$query->execute(['title' => $new ]);

header("Location:category.php");
exit();

  }else{
‌?>


    <div class="col mt-3">
    <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
  همه ی فیلد ها الزامی است!!
  </div>
</div>
    </div>
    <?php

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

                    <h4 class="pt-4 pb-4">افزودن دسته جدید</h4>
                    <hr>
                    </div>
                    <div>
                      <form method="post" class="p-5">
                      <label for="categorynew" class="ms-2 form-label">نام دسته</label>
                      <input type="text" name="categorynew" id="categorynew" class="ms-2 mb-3 form-control">
                      <button type="submit" name="btncategory" class=" ms-2 mb-3 btn btn-outline-secondary">ایجاد</button>
               </form>
                    </div>
                    
      
  </div>
   </div>
</section>
<?php
include("../include/footer.php");
?>