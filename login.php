<?php
error_reporting(0);
$array=["user"=>"test_user","password"=>123456];
$error="";
if(isset($_POST['sub'])){
    $username=$_POST['user'];
    $password=$_POST['password'];
    if($username==$array['user'] && $password==$array['password']){
        session_start();
        $_SESSION['eid']=$username;
        header('location:dashboard.php');
    }
    else
    {
        $error="Enter correct Username and password";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <style>
        .mar{
            margin-top: 6%;
            background-color: turquoise;
        }
    </style>
    <?php include('head.php'); ?>
    <title>login</title>
  </head>
  <body>
    <?php include('nav.php'); ?>

    <div class="container mar">
        
    <form method="post">
  <div class="mb-3">
    <label  class="form-label">Username</label>
    <input type="text" name="user" class="form-control"  >
    <div  class="form-text">We'll never share your username with anyone else.</div>
  </div>
  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password" name="password" class="form-control" >
  </div>
  <div class="mb-3">
      <div class="text-danger"><?php echo $error ?></div>
  </div>
  
  <button type="submit" name="sub" class="btn btn-primary">Submit</button>
</form>

    </div>

    <?php include('foot.php'); ?>
  </body>
</html>