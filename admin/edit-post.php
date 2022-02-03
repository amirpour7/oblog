<?php
include("./include/nav.php");


if(isset($_GET['id'])){
  $post_id = $_GET['id'];
  $post = $base->prepare("SELECT * FROM `posts` WHERE id = :id");
  $post->execute(['id' => $post_id]);
  $post= $post->fetch();

  $query_category = "SELECT * FROM `categories`";
  $categories = $base->query($query_category);
}
if(isset($_POST['edit-post'])){
  if(trim($_POST['title']) != "" && trim($_POST['auther']) != "" && trim($_POST['category']) != "" && trim($_POST['body']) != ""){
   $title =   $_POST['title'];
   $auther = $_POST['auther'];
   $category = $_POST['category'];
   $body = $_POST['body'];
   if( trim($_FILES['image']['name']) != "" ){
     $img_name = $_FILES['image']['name'];
     $img_tmp = $_FILES['image']['tmp_name'];
     
     if(move_uploaded_file($img_tmp , "../upload/posts/$img_name")){
       //successfully uploaded
     }else{
      //has an error for uploading
     }
     $post_update =$base->prepare("UPDATE `posts` SET title = :title, auther = :auther ,category_id = :category, body=:body, image = :image WHERE id = :id");
     $post_update->execute(['title' => $title ,'auther' => $auther, 'category' => $category , 'body' =>$body , 'image'=> $img_name ,  'id' => $post_id]);
     header("Location:post.php");
     exit();
     
    }else{
      $post_update =$base->prepare("UPDATE `posts` SET title = :title, auther = :auther ,category_id = :category, body=:body WHERE id = :id");
     $post_update->execute(['title' => $title ,'auther' => $auther, 'category' => $category , 'body' =>$body , 'id' => $post_id ]);
     header("Location:post.php");
     exit();
     
    }


  }else{
header("location:edit-post.php?id=$post_id&err=همه ی فیلد ها الزامی است");
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
                                     <h4>ویرایش مقاله</h4>
                                     <hr>
                      </div>
                      <?php
                      if(isset($_GET['err'])){
                        ?>
                            <div class="col">
    <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
   <?php echo $_GET['err'];  ?>
  </div>
</div>
    </div>
                        <?php
                      }
                      ?>
                      <div>
                      <form class="p-5" enctype="multipart/form-data" method="post">
                                <div>
                                      <label class="form-label" for="title">عنوان</label>
                                      <input type="text" value="<?php echo $post['title']; ?>" name="title" id="title" class="form-control">
                                    <small class="text-muted">لطفا عنوان مقاله را وارد کنید</small>
                               </div>
                                     <div>
                                     <label class="form-label" for="author">نویسنده</label>
                                      <input value="<?php echo $post['auther']; ?>" type="text" name="auther" id="author" class="form-control mb-3">
                                    <small class="text-muted">لطفا نام نویسنده را وارد کنید</small>
                                     </div>
                               <div>
                               <label class="form-label" for="category">دسته بندی</label>
                               <select class="form-select mb-3" name="category" id="category">
                                 <?php
                                if($categories->rowcount() > 0){
                                  foreach($categories as $category){
                                    ?>
                                    <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $post['category_id']) ? "selected" : "" ?>><?php echo $category['title']; ?></option>
                                    <?php
                                  }
                                }
                                 ?>
                                           
                               </select>
                               <small class="text-muted">لطفا دسته بندی را انتخاب کنید</small>
                               </div>
                       <div>
                       <label class="form-label" for="body">متن مقاله</label>
                                      <textarea  name="body" id="body" class="form-control mb-3"><?php echo $post['body']; ?></textarea>
                                    <small class="text-muted">لطفا متن مقاله را وارد کنید</small>
                       
                                  </div>
                                  <br>
                                 <img class="w-50" src="../upload/posts/<?php echo $post['image']; ?>" alt=""> 
              <div>
              <label class="form-label" for="image">تصویر مقاله</label>
                                      <input type="file" name="image" id="image" class="form-control mb-3">
                                    <small class="text-muted">لطفا تصویر مقاله را آپلود کنید</small>
             </div>
             <div>
                            <button name="edit-post" class=" mt-2 mb-2 btn btn-outline-secondary" type="submit">ویرایش</button>
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