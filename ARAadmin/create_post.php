<?php
session_start();
session_regenerate_id();

if(!isset($_SESSION["login"]))
{
  header('Location: index.php');
  exit;
}
require_once ('include/header.php');
require_once ('include/connection.php');
?>


      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">New Post</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
<div class="container">
<div class="row">
<div class="col-md-2"></div>
 <div class="col-md-8 ">
 <form action="create_post.php" method="POST" class="form-horizontal"  onsubmit="return validate2();" enctype="multipart/form-data">
		<div class="form-group">
			<legend><b>Create Post</b></legend>
		</div>
<?php

    if (isset($_POST['post_submit'])) {
      $files=[];
      if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['upload']['name'][$i];

                //save the url and the file
                $filePath = "upload/".$_FILES['upload']['name'][$i];

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                 

                }
              }
        }
    }
       
   
   else {
     echo "<center><h3 style='color:red'>Sorry Error has been eccor! Please try again.</h3></center>";

   }
      

   if(is_array($files)){
     
           $author = $_SESSION["name"];
           $heading = $_POST['heading'];
           $discription = $_POST['discription'];
           $imgs = implode(",",$files);
           $sql = "INSERT INTO `posts`(`heading`, `discription`, `imgs`, `author`) VALUES ('$heading','$discription','$imgs','$author')";
      $run = mysqli_query($con,$sql);
    if($run){
      echo "<center><h3 style='color:green;padding:10px;border:5px solid green'>Post's has been Uploaded!.</h3></center>";
    }
    else {
      echo "<center><h3 style='color:red;padding:10px;border:5px solid red'>Sorry Error has been eccor! Please try again.Database Failure</h3></center>";
 
    }
      
}


        }

   



    ?>



		<div class="form-group">
		<label>Post Heading</label>
<input type="text" name="heading" id="input" class="form-control"  required="required">

		</div>
  <div class="form-group">
		<label>Discription</label>
<textarea name="discription" id="input" class="form-control" rows="5" required="required">

</textarea>
		</div>
   <div class="form-group">
		<label>Upload Image's</label>
        <input type="file" id="pics" name="upload[]" multiple="multiple">

       <span id="error" style="color:red"></span>

		</div>


		<div class="form-group">

				<button type="submit" name="post_submit" class="btn btn-primary">Submit</button>

		</div>
</form>
 </div>
<div class="col-md-2"></div>
   </div>

   </div>
    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer text-center">
    <!-- To the right -->

    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="#">www.ara.com</a>.</strong> All rights reserved.
  </footer>



      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="src/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="src/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="src/js/adminlte.min.js"></script>
<script type="text/javascript">

function validate2(){

var pic = document.getElementById("pics").value;
var res = pic.split(".");
var ex = res[1].toLowerCase();

if (ex !== "jpg" && ex !== "jpeg" && ex !== "png" ) {

 document.getElementById("error").innerHTML = "This type of file is not Allowd, Make sure! You have been selected a image";
 return false;
}

return true;
}

</script>


</body>
</html>
