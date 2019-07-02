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
    <title> RAM | Course Manager</title>
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
        <p class="lead text-muted text-center" style="font-size: 15px">Sir, welcome to your profile!</p>
        <hr>
        <br>
        <!-- -->
        <?php

        $teacher = $_SESSION['user_name'];

        $sql = "SELECT COUNT(id) as total FROM course_teacher WHERE teacher='$teacher';";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);

        if ($data['total']==0) {
          echo '<p class="lead text-center">No course added yet.</p>';
        } else{
          $teacher_name = $_SESSION['user_name'];
          $sql = "SELECT * FROM course_teacher WHERE teacher='$teacher_name';";
          $result = mysqli_query($conn, $sql);
          $check_result = mysqli_num_rows($result);

          echo '<table class="table mx-auto text-center" style="max-width: 400px;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Course</th>
                <th scope="col">Dept</th>
                <th scope="col">Series</th>
                <th scope="col">Section</th>
              </tr>
            </thead>
            <tbody>';

              while ($row = mysqli_fetch_assoc($result)) {
                $d_course = $row['course_number'];
                $d_dept = $row['dept'];
                $d_series = $row['series'];
                $d_section = $row['section'];

                echo "  <tr> <td>".$d_course."</td>";
                echo "  <td>".$d_dept."</td>";
                echo "<td>".$d_series."</td>";
                echo "<td>".$d_section."</td></tr>";
              }
              echo '</tbody>
          </table>';
        }

       ?>
        <!-- -->
        <br>
        <a href="add_course.php" class="btn btn-sm btn-outline-success btn-block mx-auto" style="max-width:300px"><i class="fas fa-plus-circle" style="margin-left:5px"></i> Add Course</a>
        <a href="delete_course.php" class="btn btn-sm btn-outline-danger btn-block mx-auto" style="max-width:300px"><i class="fas fa-minus-circle" style="margin-left:5px"></i> Delete Course</a>
        </div>
        </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
