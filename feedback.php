<?php
session_start();
$user=$_SESSION['eid'];
error_reporting(0);
function input_fields($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;   
}
$nameErr=$empErr=$jobErr=$revErr=$prosErr=$consErr=$advErr=$fileErr="";
if(isset($_POST['sub'])){
  $name=input_fields($_POST['name']);
  $emp=input_fields($_POST['emp']);
  $job=input_fields($_POST['job']);
  $review=input_fields($_POST['review']);
  $pro=input_fields($_POST['pros']);
  $cons=input_fields($_POST['cons']);
  $advice=input_fields($_POST['advice']);
  $tmp=$_FILES['file']['tmp_name'];
  $fname=$_FILES['file']['name'];
  $size=$_FILES['file']['size'];
  $ext=pathinfo($fname,PATHINFO_EXTENSION);
  $fn="attachment-".rand().".$ext";
 
if(empty($name)){
  $nameErr="THIS FIELD IS MANDATORY";
}
else
{
  if(!preg_match("/^[a-zA-Z ]+$/",$name))
  {
    $nameErr="Name should contain";
  }
}
if(empty($emp)){
  $empErr="THIS FIELD IS MANDATORY";
}
if(empty($job)){
  $jobErr="THIS FIELD IS MANDATORY";
}
if(empty($review)){
  $revErr="THIS FIELD IS MANDATORY";
}
if(empty($pro)){
  $prosErr="THIS FIELD IS MANDATORY";
}

else{
  if(!preg_match("/^[A-Za-z ]{20,100}$/",$pro)){
    $prosErr="Min 20 Max 200 char";

  }
}


if(empty($cons)){
  $consErr="THIS FIELD IS MANDATORY";
}
else{
  if(!preg_match("/^[A-Za-z ]{20,100}$/",$pro)){
    $consErr="Min 20 Max 200 char";

  }
}
if(empty($advice)){
  $advErr="THIS FIELD IS MANDATORY";
}
else{
  if(!preg_match("/^[A-Za-z ]{20,100}$/",$pro)){
    $advErr="Min 20 Max 200 char";

  }
}
if(!empty($tmp)){
  if($ext=="docx" || $ext=="pdf"){
    if($size<1024*1024*10){
      $dst="upload/";
      if(move_uploaded_file($tmp,$dst.$fn)){
  
      }
      else{
        $fileErr="uploading error";
      }

    }
    else{
      $fileErr="less than 10mb file allowed";
    }

  }
  else{
    $fileErr="only document and pdf allowed";
  }

}
else{
  $fileErr="Plzz select a file";
}

if($nameErr== "" && $empErr== "" && $jobErr== "" && $revErr== "" && $prosErr== "" && $consErr== "" && $advErr== "" && $fileErr== "" )
{
if(!(is_dir("user/".$name))){
  mkdir("user/".$name);
  $a=fopen("user/".$name."/details.txt","w");
  fwrite($a,$emp."\n".$job."\n".$review."\n".$pro."\n".$cons."\n".$advice);
  header("location:dashboard.php");

}
else{
   echo "";
}
}
}

?>

<!doctype html>
<html lang="en">
  <head>
  <script src="rating.js"></script>
      <style>
          .mar{
              margin-top: 6%;
              background-color: burlywood;
          }
          .cc{
            background-color: lightseagreen;
          }
          label{
            font-size: 35px;
          }
    </style>
    <?php include('head.php'); ?>
    <title>feedback</title>
  </head>
  <body class="cc" >
    <?php include('nav.php'); ?>
    <div class="container mar">
   
        <h2 class="text-center"> FEEDBACK FORM</h2>
    <form method="post" enctype="multipart/form-data">
    <span class="text-danger ">ALL FIELDS ARE MANDATORY !!</span>
    
  <div class="mb-3">
    <label  class="form-label">Are you a current or former employee?</label><br>
    <span class="text-danger "><?php echo $empErr; ?></span>
    <input type="radio" name="emp" value="current"> Current
    <input type="radio" name="emp" value="former"> Former
  </div>

  <div class="mb-3">
    <label  class="form-label">Name</label><br>
    <span class="text-danger "><?php echo $nameErr; ?></span>
    <input type="text" name="name" class="form-control"  >
    
  </div>

  
  <div class="mb-3">
    <label  class="form-label">Job-Title</label><br>
    <span class="text-danger "><?php echo $jobErr; ?></span>
    <input type="text" name="job" class="form-control"  >
  </div>
  <div class="mb-3">
    <label  class="form-label">Review headline</label><br>
    <span class="text-danger "><?php echo $revErr; ?></span>
    <input type="text" name="review" class="form-control"  >
  </div>
  <div class="mb-3">
    <label  class="form-label" >Pros</label><br>
    <span class="text-danger "><?php echo $prosErr; ?></span><br>
    <textarea  name="pros"></textarea>
  </div>
  <div class="mb-3">
    <label  class="form-label"  >Cons</label><br>
    <span class="text-danger "><?php echo $consErr; ?></span><br>
    <textarea name="cons" ></textarea>
  </div>
  <div class="mb-3">
    <label  class="form-label"  >Advice Management</label><br>
    <span class="text-danger "><?php echo $advErr; ?></span><br>
    <textarea name="advice"></textarea>
  </div>
  <div class="mb-3">
    <label  class="form-label">Submit Proof</label><br>
    <input type="file" name="file"><br>
    <span class="text-danger "><?php echo $fileErr; ?></span>
  </div>
  
  <div class="mb-3">
  <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
  <label for="vehicle1">I agree to all terms and conditions.</label><br>
  </div>
  
  <button type="submit" name="sub" class="btn btn-primary">Submit</button>
    </form>
    </div>
   
    <?php include('foot.php'); ?>
  </body>
</html>