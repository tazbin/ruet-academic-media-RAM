<!DOCTYPE html>
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
    <title> RAM | Add Course</title>
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
        <p class="lead text-muted text-center" style="font-size: 15px">Adding new course</p>
        <hr>

        <?php

        $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (strpos($fullURL, "empty")) {
          echo '<p class="text-danger text-center">Fill all the fields!</p>';
        }

         ?>

        <form class="mx-auto shadow" style="max-width:320px; border: 1px solid rgb(34, 139, 58); border-radius: 5px; padding:30px;" action="includes/add.course.inc.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Enter course number/name</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control btn btn-block btn-outline-secondary" name="c_name" aria-describedby="basic-addon1">
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Select department</label>
            <select class="btn btn-block btn-outline-secondary" name="c_dept">
              <option value="none">-</option>

              <?php
                $sql = "SELECT * FROM dept_series";
                $result=mysqli_query($conn, $sql);
                $resultcheck = mysqli_num_rows($result);

                if ($resultcheck>0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value='.$row['dept'].'>'.$row['dept'].'</option>';
                  }
                }
               ?>

            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Select series</label>
            <select class="btn btn-block btn-outline-secondary" name="c_series">
              <option value="none">-</option>
              <!--
              <option value="15">15</option>
            -->

              <?php
              $sql = "SELECT * FROM dept_series;";
              $res = mysqli_query($conn, $sql);
              $title = array();

              while ($head = mysqli_fetch_field($res)) {
                array_push($title, $head->name);
              }

              foreach ($title as $key) {
                if (strpos($key, "eries")) {
                  echo '<option value='.$key[7].$key[8].'>'.$key[7].$key[8].'</option>';
                }
              }
               ?>

            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Enter section name</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control btn btn-block btn-outline-secondary" name="c_section" aria-describedby="basic-addon1">
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Starting roll</label>
            <div class="input-group mb-3">
              <input type="number" class="form-control btn btn-block btn-outline-secondary" name="roll_st" aria-describedby="basic-addon1">
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Ending roll</label>
            <div class="input-group mb-3">
              <input type="number" class="form-control btn btn-block btn-outline-secondary" name="roll_end" aria-describedby="basic-addon1">
            </div>
          </div>


          <button type="submit" name="submit" class="btn btn-block btn-success"><i class="fas fa-plus" style="padding-right: 5px"></i> Add course</button>
        </form>
        <br>

        </div>
        </div>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
