<?php
session_start();
$user=$_SESSION['eid'];
if(empty($user)){
    header("location:login.php");
}
?>
<?php
error_reporting(0);
if(isset($_POST['sub'])){
    header('location:feedback.php');
}
?>


<!doctype html>
<html lang="en">
  <head>
    <?php include('head.php'); ?>
  <style>
        #hero {
  width: 100%;
  height: calc(100vh - 110px);
  background: url("images/hero-bg.jpg") top center;
  position: relative;
}
      .mar{
          margin-top: 6%;;
      }
      .fb{
     font-size: 25px;
     color: darkturquoise;
 }

  </style>
    
    <title>Dashboard</title>
  </head>
  <body >
    <?php include('nav.php'); ?>
    <form method="post">
    <section id="hero" class="d-flex align-items-center">
    <div class="container mar text-center">
    <button class="btn btn-success" name="sub">SUBMIT FEEDBACK</button>
    <div class="mt-3 fb ">Your feedback is valuable to us!!</div>
    </div>
    </form>
    <?php include('foot.php'); ?>
  </body>
</html>