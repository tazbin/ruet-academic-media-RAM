<!DOCTYPE html>
<?php
  include 'header.php';
  //include 'includes/result.form.inc.php';
  if ( !isset($_SESSION['user_name']) || $_SESSION['status']!="teacher"  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Statistics</title>
  </head>
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }
  </style>
  <body>
    <div style="background-color: rgb(241, 244, 244); min-height:500px; padding-bottom:50px">
      <div class="container">

        <h3 class="display-4 text-center" style="padding-top:30px; font-size: 30px">
          <?php
            echo $_SESSION['user_name'];
           ?>
        </h3>
        <p class="lead text-muted text-center" style="font-size: 15px">Sir, select course to view statistics!</p>
        <hr>
        <br>
        <form class="mx-auto shadow" style="max-width:320px; border: 1px solid rgb(21, 187, 59); border-radius: 5px; padding:30px;" action="includes/view.statistics.inc.php" method="post">


          <div class="form-group">
            <label for="exampleInputEmail1">Select Course</label>
            <select class="form-control shadow" name="sta_course">
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
          </div>
          <button type="submit" name="submit" class="shadow btn btn-block btn-success"><i class="fas fa-chart-pie" style="padding-right: 5px;"></i> View statistics</button>
        </form>


        <br>

        <?php

        $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (strpos($fullURL, "empty")) {
          echo '<p class="text-danger text-center">Select a course!</p>';
        }

         ?>

      </div>

        </div>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
