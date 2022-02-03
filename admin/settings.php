<?php
include("./include/nav.php");


$abouts = $base->query("SELECT * FROM `information` WHERE id = 1");
$footers = $base->query("SELECT * FROM `information` WHERE id = 2");
$versions = $base->query("SELECT * FROM `information` WHERE id = 3");
$sites = $base->query("SELECT * FROM `information` WHERE id = 4 ");
$adminsite = $base->query("SELECT * FROM `information` WHERE id = 5 ");
$log = $base->query("SELECT * FROM `information` WHERE id = 6");


$posts = $base->query("SELECT *  FROM `posts`");


if(isset($_POST['edit-settings'])){
    if(trim($_POST['about']) != "" && trim($_POST['footer']) != "" && trim($_POST['version']) != "" && trim($_POST['siten']) != ""){
    
    $form_a = $_POST['about'];

    $form_b = $_POST['footer'];

    $form_c = $_POST['version'];
    
    
    
    $form_e = $_POST['siten'];

    $form_f = $_POST['adminsite'];
    $form_g = $_POST['log'];

    

    $insert_a = $base->prepare("UPDATE `information` SET body = :form_a WHERE id = 1");

    $insert_b = $base->prepare("UPDATE `information` SET body = :form_b WHERE id = 2");

    $insert_c = $base->prepare("UPDATE `information` SET body = :form_c WHERE id = 3");
    
    
    $insert_e = $base->prepare("UPDATE `information` SET body = :form_e WHERE id = 4");

    $insert_f = $base->prepare("UPDATE `information` SET body = :form_f WHERE id = 5");

    $insert_g = $base->query("UPDATE `information` SET body = '$form_g' WHERE id = 6");
    
    
    $insert_a->execute(['form_a' => $form_a]);

    $insert_b->execute(['form_b' => $form_b]);

    $insert_c->execute(['form_c' => $form_c]);


    $insert_e->execute(['form_e' => $form_e]);

    $insert_f->execute(['form_f' => $form_f]);

    header("location:settings.php");
    exit();
    }else{
        header("location:settings.php?err=همه ی فیلد ها باید پر شود‌");
        exit();
    }
}


?>
<br>
<br>
<br>
<br>
<section>
    <?php
    if(isset($_GET['err'])){
        ?>
        <div class="alert alert-danger">
        <?php echo $_GET['err'];?>
      </div>
      <?php
    }
    ?>
   
    
 <div>
     <h4>تنظیمات</h4>     
     <hr>      
 </div>
 
     <form class="p-4" method="post">

     <?php
 if($log->rowcount() > 0){
 foreach($log as $notif){
?>

<?php
 }
 }

 $ver = file_get_contents('./version.txt');

 $verall = file_get_contents("https://drive.google.com/uc?export=view&id=1GotcLq0ztno-3Uulz2LBZaiqqv7kIHzn");


$beta = file_get_contents('https://drive.google.com/uc?export=view&id=1ihxcmaUuDXfwMPEbJ8K9P1ibfoic35dL');


  
 
 if($ver== $verall){
    ?>
<div class="alert alert-success" role="alert">
  شما جدیدترین ورژن را دارید. 
  <br>
  ورژن شما <?php echo $ver; ?>
  <br>
  آخرین نسخه بتا : <?php echo $beta;?>
</div>
    <?php
 }else{
   ?>
<div class="alert alert-danger" role="alert">
    ورژن شما قدیمی است. لطفا با مراجعه به گیت هاب آپدیت کنید.<br> ورژن فعلی : <?php echo $ver; ?> <br> ورژن جدید: <?php echo $verall ; ?>
  <br>
  آخرین نسخه بتا : <?php echo $beta;?>
</div>
   <?php
 }
?>

<div class="alert alert-primary" role="alert">
<div class="text-center">

  Github : https://github.com/amirpour7/oblog
  <br>
  Telegram : https://t.me/oblog_amirreza
   <br>
  Developed by Amirreza Pourzolfaghari
  <br>
  Copyright 2021-2022 Oblogv3 build <?php echo $ver;  ?>
 
</div>

<?php


?>
</div>
     <label class="form-label"> غیر فعال کردن اعلان ورود</label>
    
<select name="log" class="form-select" aria-label="غیر فعال کردن اعلان ورود">
  <option
  <?php 
if($notif['body'] == 1)
{
    echo 'selected';
}else{
    echo '';
} 
?>
 value="1">فعال</option>
  <option
  <?php 
if($notif['body'] == 0)
{
    echo 'selected';
}else{
    echo '';
} 
?> value="0">غیر فعال</option>

</select>
     <label class="form-label" for="about">متن ارتباط با ما</label>
 <?php
 if($abouts->rowcount() > 0){
 foreach($abouts as $about){
?>
 <textarea class="form-control  " name="about" id="about" cols="30" rows="10">
  <?php echo $about['body'];?>
</textarea>
<?php
 }
 }
?>
  <hr>         
 
 
     
<label class="form-label" for="footer">متن پابرگ</label>

<?php
 if($footers->rowcount() > 0){
 foreach($footers as $footer){
?>
 <textarea class="form-control  " name="footer" id="footer" cols="30" rows="10">
  <?php echo $footer['body'];?>
</textarea>
<?php
 }
 }
?>
      
     
     <hr>         
 
    
<label class="form-label" for="version">نسخه</label>

<?php
 if($versions->rowcount() > 0){
 foreach($versions as $version){
?>
 <input value="<?php echo $version['body'];?>" class="form-control" name="version" id="version">
  

<?php
 }
 }
 ?>


 <?php
 if($sites->rowcount() > 0){
 foreach($sites as $site){
?>
 <label class="form-label" for="siten">نام سایت</label>
 <input value="<?php echo $site['body']; ?>" name="siten" class="form-control" type="text">
<?php
 }
}
?>
 <?php
 if($adminsite->rowcount() > 0){
 foreach($adminsite as $adminsit){
?>
 <label class="form-label" for="adminsite">نام مدیریت سایت</label>
 <input value="<?php echo $adminsit['body']; ?>" name="adminsite" class="form-control" type="text">
<?php
 }
}
?>


<button type="submit" name="edit-settings" class="btn btn-outline-secondary mt-3">ذخیره تغییرات</button>
</form>
     
     <hr>         
 </div>         
</section>

<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#footer' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#about' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<?php
include("../include/footer.php");
?>