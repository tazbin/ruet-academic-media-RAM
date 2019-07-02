<!DOCTYPE html>
<?php
  include 'header.php';

  if ( $_SESSION['status']!="teacher"  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Home</title>
  </head>
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }
  </style>
  <body style="background-color:rgb(244, 245, 245);>
    <div style="min-height:500px; padding-bottom:50px;">
      <div class="container">
        <p class="lead text-center" style="margin-top: 30px;"><i class="fas fa-cloud-upload-alt" style="padding-right: 5px;"></i> Oploading course materials</p>
        <hr>
      </div>
        <div class="container">
          <form class="mx-auto pb-3 pt-2" action="includes/upload.file.inc.php" enctype="multipart/form-data" method="post" style="max-width:400px;">

            <div class="form-group">
              <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
            </div>

            <div class="form-group"  style="margin-bottom: -5px">
              <label for="exampleInputEmail1">Select Course</label>
              <select class="form-control shadow" name="course">
                <option value="none">-</option>

                <?php
              $sql = "SELECT * FROM course_teacher;";
              $result = mysqli_query($conn, $sql);
              $check_result = mysqli_num_rows($result);

                  while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['teacher_id'] == $_SESSION['user_id']) {
                      $d_course = $row['course_number'];
                      $d_dept = $row['dept'];
                      $d_series = $row['series'];
                      echo "<option value=".$row['id'].">".$d_course." -  ".$d_dept."'".$d_series.", section ".$row['section']."<hr></option>";
                    }
                  }
               ?>

              </select>
            </div> <br>

            <textarea class="form-control shadow" id="exampleFormControlTextarea1" name="about" rows="4" placeholder="Say something about the file"></textarea> <br>

            <form class="md-form" action="#">
              <div class="file-field">
                <div class="btn btn-primary btn-sm float-left">
                  <span>Choose files</span>
                  <input type="file" multiple>
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload one or more files">
                </div>
              </div>
            </form>

            <button type="submit" class="shadow btn btn-sm btn-block btn-success" name="upload" style="margin-top:20px">
              <i class="fas fa-cloud-upload-alt" style="padding-right:5px"></i>
              Upload file</button>

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
