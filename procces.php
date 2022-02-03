<?php
include("./include/header.php");
?>
<?php
if(isset($_POST['send'])){
               if(trim($_POST['name']) != "" && trim($_POST['text']) != "" && trim($_POST['email']) != ""){
                              $name = $_POST['name'];
                              $text = $_POST['text'];
                              $email = $_POST['email'];
                              $query = $base->prepare("INSERT INTO `messages` (name , email , text) VALUES (:name , :email , :text)"
                              );
                              $query->execute(['name' => $name , 'email' => $email, 'text' => $text  ]);
                              ?>
                              <div class="alert alert-success mt-5" role="alert">
                                <h4 class="alert-heading">موفقیت آمیز بودن ارسال</h4>
                                
                                <hr>
                                <p class="mb-0">فرم ارسال شد و به زودی در ایمیل جواب داده خواهد شد</p>
                              </div>
                              <a href="index.php" class="btn btn-outline-primary mt-4">
                                 بازگشت
               </a>
                              <?php
               
}else{
  ?>
  <div class="alert alert-danger mt-5" role="alert">
                                <h4 class="alert-heading">خطا در ارسال</h4>
                                
                                <hr>
                                <p class="mb-0">همه ی فیلد ها باید پر شوند</p>
                              </div>
                              <a href="index.php" class="btn btn-outline-primary mt-4">
                                 بازگشت
               </a>
                              <?php
}
}

include("./include/footer.php");

?>