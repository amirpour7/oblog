<?php
include("./include/header.php");
include("./include/svg.php");
include("./include/slider.php");

if (isset($_GET['category'])){
    $category_id = $_GET['category'];

    $allposts = $base->prepare("SELECT * FROM posts WHERE category_id = :id");
    $allposts->execute(['id' => $category_id]);
   
}else{
$query_allposts = "SELECT * FROM `posts`";
$allposts = $base->query($query_allposts);
}
?>
<div id="hello" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
 <div class="modal-header align-items-center">
 <h5>فرم ارتباط با ما</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>

</div>
<div class="modal-body">
               <form action="procces.php" method="post">
                              <label class="form-label" for="name">نام</label>
                              <input name="name" class="form-control" type="text">

                              <label class="form-label" for="email">ایمیل</label>
                              <input name="email" class="form-control" type="email">

                              <label class="form-label" for="text">متن</label>
                              <textarea name="text" class="form-control" type="text"></textarea>

                              <button name="send" type="submit" class="btn btn-outline-primary mt-3">ارسال</buuton>
               </form>
</div>
</div>
                          </div>
           </div>

<section class="py-3">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8 mb-4">

                <div class="row">
<?php
if($allposts->rowcount() > 0){
    foreach($allposts as $my_posts){
      $category_id = $my_posts['category_id'];
      $query_post_category = "SELECT * FROM `categories` WHERE id = $category_id";
      $post_category = $base->query($query_post_category)->fetch();
      ?>
      
      <div class="col-sm-6 mt-5">

<div class="card ">
    <img src="./upload/posts/<?php echo $my_posts['image']; ?>" class="card-img-top" alt="تصویر ندارد">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title"><?php echo $my_posts['title']; ?></h5>
            <div><span class="badge bg-secondary"> <?php echo $post_category['title'] ; ?> </span></div>
        </div>
        <p class="card-text text-justify">
           
       
<p><?php echo substr($my_posts['body'] , 0 , 150). "..."; ?></p>

       </p>
        <div class="d-flex justify-content-between">
            <a href="single.php?post=<?php echo $my_posts['id'];  ?>" class="btn btn-outline-primary stretched-link">مشاهده</a>
            <p>نویسنده: <?php echo $my_posts['auther'] ?></p>
        </div>
    </div>
</div>

</div>
<?php
    }
}else{
    ?>
    <div class="col">
    <div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
   مقاله مورد نظر یافت نشد
  </div>
</div>
    </div>
    <?php
    }
    ?>

</div>

</div>

<?php include("./include/sidebar.php") ?>

</div>

</div>

</section>

<?php
include("./include/footer.php");
?>
