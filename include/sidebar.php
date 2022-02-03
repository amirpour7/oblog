<?php
$categoriside = "SELECT * FROM `categories`";
$daste = $base->query($categoriside);
?>
            <div class="col-md-4 mb-3">

<div class=" mt-5 card bg-light mb-3">
    <div class="card-body">
        <h5 class="card-title">جستجو در وبلاگ</h5>
        <form action="search.php" method="get">
            <div class="input-group mb-3">
                <div class="input-group-prepend order-2">
                    <button  class="btn btn-outline-primary" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg>
                    </button>
                </div>
                <input name="search" type="text" class="form-control" placeholder="جستجو ...">
            </div>
        </form>
    </div>
</div>


<div class="list-group mb-3">
    <a href="#" class="list-group-item list-group-item-action active">
        دسته بندی ها
    </a>
    <?php
if($daste->rowcount() > 0){
    foreach($daste as $cat){
    ?>
<a href="index.php?category=<?php echo $cat['id'];?>"class="list-group-item list-group-item-action"><?php echo $cat['title'];?></a>
   
 <?php
}
}
?>
</div>


<div class="card bg-light mb-3 p-3">
    <div class="card-body">
<?php
if(isset($_POST['subscribe'])){
    if(trim($_POST['name2']) != "" && trim($_POST['email']) != ""){
   $name2 = $_POST['name2'];
   $email = $_POST['email'];
   $sub_in = $base->prepare("INSERT INTO `subscribers` (name , email) VALUES (:name , :email)");
   $sub_in->execute(['name' => $name2 , 'email' => $email]);
   
 
   
}else{
    ?>

<div class="col">
    <div class="alert alert-danger d-flex align-items-center" role="alert">
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


        <form method="post">
            <div class="form-group">
                <label class="form-label" for="name">نام</label>
                <input type="text" name="name2" id="name" class="form-control" placeholder="نام خود را وارد کنید.">

            </div>
            <div class="form-group">
                <label class="form-label" for="email">ایمیل</label>
                <input  type="email" name="email" class="form-control " id="email"placeholder="type your email...">
            </div>

<button  type="submit" name="subscribe" class=" mt-3 btn btn-outline-primary btn-block">ارسال</button>

   

        </form>
    </div>
</div>


<div class="card p-3">
    <div class="card-body">
        <?php
         $query_inform = "SELECT * FROM `information` WHERE id = 1";
         $inform = $base->query($query_inform);
         if($inform->rowcount() > 0){
             foreach($inform as $information){

         ?>
        <h3> درباره ما </h2>
            <p class="text-justify">
            <?php echo $information['body']; ?>
       
            </p>
      <?php
        }
         }
         ?>
    </div>
</div>

</div>

    </div>

</div>


</section>
