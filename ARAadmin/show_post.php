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
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->


    <section class="content container-fluid">
     <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

            <?php
            
      if (isset($_GET['del'])) {
        $id = $_GET['del'];
       
        $sql = "DELETE FROM `posts` WHERE id=$id";
           $run = mysqli_query($con,$sql);
           if ($run) {
            echo "<center><h3 style='color:green;padding:10px;border:5px solid green'>Sucessfully Deleted!.</h3></center>";

           }
           else {
            echo "<center><h3 style='color:red;padding:10px;border:5px solid red'>Error occor while Delete Request Pleas Try again</h3></center>";

           }

    }
            ?>
              <h3 class="box-title">Monthly Post's</h3>


            </div>
            <!-- /.box-header -->
            <?php

             $query = "SELECT * FROM `posts`";
             $run = mysqli_query($con,$query);

             if(mysqli_num_rows($run) > 0){



             ?>


            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Heading</th>
                  <th>Discription</th>
                  <th>Image</th>
                  <th>Author</th>
                  <th>DateTime</th>
                  <th>Delete</th>
                </tr>
                <?php

                 while ($row = mysqli_fetch_array($run)) {
                     $postid = $row['id'];
                        $heading = $row['heading'];
                        $disc = $row['discription'];
                          $post_img = $row['imgs'];
                            $author =  $row['author'];
                            $date =  $row['timestamp'];


                 ?>

                           <tr>

                             <td> <?php echo $postid; ?> </td>
                             <td><?php echo $heading; ?></td>
                             <td><?php echo $disc; ?></td>
                               
                             <td>
                             <?php 
                               $arr = explode(",",$post_img);
                               foreach($arr as $file){
                                ?>
                                <img src="upload/<?php echo $file?>" alt="profile" class="img-rounded" width="40px" height="40px">
                               <?php } ?>  
                             
                            
                             </td>
                            <td><?php echo $author; ?></td>
                            <td><?php echo $date; ?></td>
                            
                  <td> <a  href="show_post.php?del=<?php echo $postid; ?>"><h4> <i class="fa fa-trash-o" aria-hidden="true"></i></h4></a> </td>
                           </tr>
                           <?php
           }
                            ?>

              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    


      </section>
  </div>


  
  <!-- /.content-wrapper -->
  <?php
}
  else {
    echo "<center><h3>No More Post Available!</h3></center>";
  }
   ?>

   
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


</body>
</html>
