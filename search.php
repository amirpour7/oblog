<?php
include("./include/header.php");
include("./include/svg.php");
if(isset($_GET['search'])){
    $word = $_GET['search'];
    $posts = $base->prepare("SELECT * FROM `posts` WHERE title  LIKE :word");
    $params = ['word' => $word];
    $posts->execute($params);
}
?>


<section class="py-3">
    <div class="container-fluid">
   
        <div class="row">
        <div class="col-sm-12 mt-5">
        <div class="alert alert-primary d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
  <div>
    موارد مرتبط با کلمه {<?php echo $_GET['search'];?>}
  </div>
</div>
        </div>
            <div class="col-md-8 mt-4 mb-4">

                <div class="row">
                    <?php
if($posts->rowcount() > 0){
    foreach($posts as $post){
        $category_id = $post['category_id'];
        $query_post_category = "SELECT * FROM `categories` WHERE id = $category_id ";
        $post_category = $base->query($query_post_category)->fetch();
               
    ?>                
                            <div class="col-sm-6 mt-2">

<div class="card">
    <img src="./upload/posts/<?php echo $post['image']; ?>" class="card-img-top" alt="...">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title"><?php echo $post['title']; ?></h5>
            <div><span class="badge bg-secondary"> <?php echo $post_category['title'] ; ?> </span></div>
        </div>
        <p class="card-text text-justify">
           
       
<p><?php echo substr($post['body'] , 0 , 500). "..."; ?></p>

       </p>
        <div class="d-flex justify-content-between">
            <a href="single.php?post=<?php echo $post['id'];  ?>" class="btn btn-outline-primary stretched-link">مشاهده</a>
            <p>نویسنده: <?php echo $post['auther'] ?></p>
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


<?php
include("./include/sidebar.php");
?>
        </div>

</div>

</section>

<?php
include("./include/footer.php");
?>
