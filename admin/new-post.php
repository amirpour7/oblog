<?php
include("./include/nav.php");

$categories = $base->query("SELECT * FROM `categories`");

if( isset($_POST['add-post'])){

if(trim($_POST['title']) != "" && trim($_POST['auther']) != "" &&  trim($_POST['category']) != "" &&  trim($_POST['body']) != "" && trim($_FILES['image']['name']) != "" ){

$title= $_POST['title'];

$auther= $_POST['auther'];

$category = $_POST['category'];

$body= $_POST['body'];

$name_image = $_FILES['image']['name'];

$tmp_name = $_FILES['image']['tmp_name'];

if(move_uploaded_file($tmp_name , "../upload/posts/$name_image")){
  echo "آپلود شد";
}else{
  echo "ارور وجود داشت";
}

$post_insert = $base->prepare("INSERT INTO `posts` (title , category_id , body , auther , image) VALUES (:title , :category_id , :body , :auther , :name_image)");
$post_insert->execute(['title' => $title,'category_id' => $category,'body' => $body, 'auther' => $auther,'name_image' =>$name_image]);


header("Location:post.php");
exit();

}else{
  header("location:new-post.php?err_ms = فیلد ها نباید خالی باشند");

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
                                     <h4>ایجاد مقاله</h4>
                                     <hr>
                      </div>
                      <?php
                      if(isset($_GET['err_ms'])){
                        ?>
                                 <div class="col">
    <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
   <?php echo $_GET['err_ms'];?>
  </div>
</div>
    </div>
  <?php
      }
   ?>
               <div>
                      <form class="p-5" enctype="multipart/form-data" method = "post">
                                <div>
                                      <label class="form-label" for="title">عنوان</label>
                                      <input type="text" name="title" id="title" class="form-control">
                                    <small class="text-muted">لطفا عنوان مقاله را وارد کنید</small>
                               </div>
                                     <div>
                                     <label class="form-label" for="author">نویسنده</label>
                                      <input type="text" name="auther" id="author" class="form-control mb-3">
                                    <small class="text-muted">لطفا نام نویسنده را وارد کنید</small>
                                     </div>
                               <div>
                               <label class="form-label" for="category">دسته بندی</label>
                               <select class="form-select mb-3" name="category" id="category">
                                 <?php
                                 if($categories->rowcount() > 0){
                                   foreach($categories as $category){
                                     ?>
                                      <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                                     <?php
                                   }
                                 }
                                 ?>
                                             
                      
                               </select>
                               <small class="text-muted">لطفا دسته بندی را انتخاب کنید</small>
                               </div>
                       <div>
                       <label class="form-label" for="body">متن مقاله</label>
                                      <textarea  name="body"  id="body" class=" form-control mb-3"></textarea>
                                    <small class="text-muted">لطفا متن مقاله را وارد کنید</small>
                        </div>
              <div>
              <label class="form-label" for="image">تصویر مقاله</label>
                                      <input type="file" name="image" id="image" class="form-control mb-3">
                                    <small class="text-muted">لطفا تصویر مقاله را آپلود کنید</small>
             </div>
             <div>
                            <button name="add-post" class=" mt-2 mb-2 btn btn-outline-secondary" type="submit">ایجاد</button>
             </div>
                      </form>
                      </div>
                      
       </div>
  </div>
</section>
<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<?php
include("../include/footer.php");
?>