<?php
include("./include/header.php");

include("./include/svg.php");

if(isset($_GET['post'])){
    $post_ids = $_GET['post'];
    $post = $base->query( "SELECT * FROM `posts` WHERE id = $post_ids");

    $post = $post->fetch();
}
if(isset($_POST['post_comment'])){
    if(trim($_POST['name']) != "" AND trim($_POST['comment']) != ""){
  $name = $_POST['name'];
  $comment = $_POST['comment'];
  $comment_insert = $base->prepare("INSERT INTO `comments` (name , comment , post_id) VALUES (:name, :comment , :post_id)");
  $comment_insert->execute(['name' => $name, 'comment' => $comment, 'post_id' => $post_ids ]);
    header("location:single.php?post=$post_ids");
    exit();
   

}else{
?>
<div class="col ">
    <div class="alert mt-5 alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
   همه ی فیلد ها الزامی است
  </div>
</div>
    </div>
<?php
    }
}
?>

<section class="py-3">

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8 mb-4">
                <div class="container">
                    <?php
                    
                    if($post){
                        $category_id = $post['category_id'];
                        $query_post_category = "SELECT * FROM `categories` WHERE id = $category_id ";
                        $category = $base->query($query_post_category)->fetch();
                        $post_id = $post['id'];
                        $comments = $base->query("SELECT * FROM `comments` WHERE post_id = $post_id AND statues = '1' ");
                        
                     ?>
  <div class="row">

<div>
    <img  src="./upload/posts/<?php echo $post['image']; ?>" class="img-fluid mt-5" alt="">
</div>

<div class="p-3">

    <div class="d-flex align-items-center">
        <h2><?php echo $post['title']; ?></h2>
        <div class="mr-2">
            <span class="badge bg-secondary"><?php echo $category['title']; ?></span>
        </div>
    </div>
    <p class="text-justify">
        <p><?php echo $post['body']; ?></p>
    </p>

    <p>نویسنده : <?php echo $post['auther']; ?></p>
</div>

</div>
                  
<hr>
                        <div class="row">
                            <div class="col-12">

                                <form method="post">
                                    <div class="form-group">
                                        <label class="form-label" for="name">نام</label>
                                        <input type="name" name="name" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label"  for="comment">نظر شما</label>
                                        <textarea name="comment" class="form-control" rows="5"></textarea>
                                    </div>

                                    <button  type="submit" name="post_comment" class="btn btn-outline-primary mt-3">ارسال</button>
                                </form>
                                
                            </div>
                        </div>
                        <hr>
                        <div class="row p-md-3">
                            <p>تعداد نظرات : <?php echo $comments->rowcount(); ?></p>
                            <?php
                            if($comments->rowcount() > 0){
                                foreach($comments as $comment){
                                    ?>

<div class="col-12 mb-3">

<div class="card bg-light">

    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="./img/boy.svg" width="70" height="70" class="rounded-circle" alt="Cinque Terre">

            <div class="mr-3">
                <h5 class="card-title"> <?php echo $comment['name'] ?> </h5>
            </div>
        </div>

        <p class="card-text pt-3 pr-3">
            <?php echo $comment['comment'] ?>
        </p>

    </div>
</div>
</div>

                                    <?php

                                }
                            }
                            ?>
                            </div>
                     <?php
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

