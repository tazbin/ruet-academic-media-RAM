<?php
  include 'header.php';

  if ( !isset($_SESSION['user_name']) || $_SESSION['status']!="teacher"  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Post Notice</title>
  </head>
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }
  </style>
  <body style="background-color:rgb(244, 245, 245);>
    <div style="min-height:500px; padding-bottom:50px">
      <div class="container">

        <p class="display-4 text-center" style="padding-top:30px; font-size: 30px">
          <?php
            echo $_SESSION['user_name'];
           ?>
        </p>
        <p class="lead text-center" style="font-size: 15px">Posting notice</p>
        <hr>

      </div>

        <div class="container">
          <form class="mx-auto pb-3 pt-2" action="includes/notice.post.inc.php" method="post" enctype="multipart/form-data" style="max-width:400px;">
            <div class="form-group">
              <label for="exampleInputEmail1">Select course</label>
              <select class="form-control shadow" name="receiver">
                <option value="none">-</option>

                <?php
                $sql = "SELECT * FROM course_teacher;";
                $result = mysqli_query($conn, $sql);
                $resultcheck = mysqli_num_rows($result);

                if ($resultcheck>0){
                  while ( $row = mysqli_fetch_assoc($result) ) {
                    if ($row['teacher']==$_SESSION['user_name']) {
                      $option = $row['course_number']." ,".$row['dept']."-".$row['series'].", section ".$row['section'];
                      echo '<option value='.$row['id'].'>'.$option.'</option>';
                    }
                  }
                }
                 ?>

              </select>
            </div>

            <div class="form-group">
              <input type="text" class="form-control shadow" id="exampleInputEmail1" aria-describedby="emailHelp" name="subject" placeholder="Notice Subject">
            </div>

            <textarea class="form-control shadow" id="exampleFormControlTextarea1" name="notice" rows="4" placeholder="Write notice here"></textarea>
            <br>

            <input type="file" class="form-control btn-outline-success" name="file" value="">
            <div clss="text-center mx-auto">
              <text clss="text-center" style="font-size: 12px; padding-top: 10px; color: rgb(65, 173, 95)"><i class="far fa-check-square" style="padding-right: 5px"></i> jpg/jpeg/png/pdf/pptx/zip/txt type files are only allowed.</text>
            </div>

            <button type="submit" class="shadow btn btn-sm btn-block btn-success" name="post_notice" style="margin-top:20px">
              <i class="fas fa-bullhorn" style="padding-right:5px"></i>
              Post notice</button>
          </form>
          <?php
          $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if (strpos($fullURL, "empty")) {
              echo '<p class="text-danger text-center">Fill up all fields!</p>';
            }

            else if (strpos($fullURL, "sent")) {
              echo '<p class="text-success text-center">Notice posted!</p>';
            }
           ?>
           <br>
        </div>

        </div>

        </div>
      </div>
    </div>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
