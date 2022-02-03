<?php
$query_slider = "SELECT * FROM `posts-slider`";
$posts_slider = $base->query($query_slider);


?>
<section>

<div id="carouselExampleCaptions" class="carousel slide d-none d-md-block " data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
<?php
if($posts_slider->rowcount()>0){
foreach($posts_slider as $post_slider){
$id_post = $post_slider['post_id'];
$query_posts = "SELECT * FROM `posts` WHERE id = $id_post";
$post = $base->query($query_posts)->fetch();

?>



    <div class="carousel-item <?php echo ($post_slider['active']) ? "active" : ""; ?>">
      <img src="./upload/posts/<?php echo $post['image'] ?>"  class="d-block w-100 height100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5><?php  echo $post['title'] ?></h5>
        <p>
    <?php echo substr($post['body'] , 0 , 200)."..."?>

        </p>
        <a href="single.php?post=<?php echo $post['id'] ?>" class="btn btn-danger">مشاهده</a>
      </div>
    </div>

<?php
}
}
?>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</section>