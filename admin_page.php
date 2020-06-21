<?php
  include 'header.php';

  if ( $_SESSION['status']!="admin"  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> RAM | Admin</title>
  </head>
  <body style="background-color: rgb(244, 245, 245);">

    <br> <br> <br> <br>

    <?php

      $sql = "SELECT * FROM dept_series;";
      $res = mysqli_query($conn, $sql);
      $title = array();

      while ($head = mysqli_fetch_field($res)) {
        array_push($title, $head->name);
      }

      echo '<p class="lead text-center text-muted">Current department & series</p>';
      echo
     '<table class="table mx-auto" style="max-width:700px">
        <thead class="thead-dark">
          <tr class="text-center">';
          echo '<th scope="col">Dept.</th>';
          echo '<th scope="col">Code</th>';
          foreach ($title as $key) {
            if (strpos($key, "eries")) {
              echo '<th scope="col">'.$key[7].$key[8].' Series</th>';
            } else {
              //echo '<th scope="col">'.$key.'</th>';
            }
                }
          echo "</tr>
        </thead>
        <tbody>";

        $ami = "SELECT * FROM dept_series";
        $result = mysqli_query($conn, $ami);
        $checkresult = mysqli_num_rows($result);

        if ($checkresult>0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr class="text-center">';
            foreach ($title as $key) {
                    echo '<td>'.$row[$key].'</td>';
                  }
            echo "</tr>";
          }
        }

        echo "</tbody>
      </table>";

      ?>

      <br> <br>

      <?php
        $sql = "SELECT * FROM teacher_data;";
        $result = mysqli_query($conn, $sql);
        $checkresult = mysqli_num_rows($result);

        if ($checkresult>0) {
          echo '<p class="lead text-center text-muted">Registered teachers list</p>';
          echo '<table class="table mx-auto" style="max-width:700px">
           <thead class="thead-dark">
             <tr class="text-center">
               <th scope="col">Name</th>
               <th scope="col">Designation</th>
               <th scope="col">Department</th>
               <th scope="col">e-mail</th>
               <th scope="col">phone</th>
             </tr>
           </thead>
           <tbody>';
          while ($row=mysqli_fetch_assoc($result)) {
            echo '<tr class="text-center">
              <td>'.$row['teacher_name'].'</td>
              <td>'.$row['teacher_designation'].'</td>
              <td>'.$row['teacher_dept'].'</td>
              <td>'.$row['teacher_mail'].'</td>
              <td>'.$row['teacher_phone'].'</td>
            </tr>';
          }
        } else{
          echo '<p class="lead text-center text-muted">No teacher has been registered yet</p>';
        }

        echo '</tbody>
      </table>;';
       ?>

       <br> <br> <br>

       <div class="container" style="max-width:300px">
         <a href="add_dept.php" class="btn btn-block btn-sm btn-outline-success"><i class="fas fa-plus-circle" style="margin-left:5px"></i> Add a department</a>
         <a href="delete_dept.php" class="btn btn-block btn-sm btn-outline-danger"><i class="fas fa-minus-circle" style="margin-left:5px"></i> Delete a department</a>
         <hr style="background-color: rgb(215, 212, 217)">
         <a href="add_series.php" class="btn btn-block btn-sm btn-outline-success"><i class="fas fa-plus-circle" style="margin-left:5px"></i> Add a Series</a>
         <a href="delete_series.php" class="btn btn-block btn-sm btn-outline-danger"><i class="fas fa-minus-circle" style="margin-left:5px"></i> Delete a series</a>
         <hr style="background-color: rgb(215, 212, 217)">
         <a href="view_report.php" class="btn btn-block btn-sm btn-outline-primary"><i class="far fa-envelope-open" style="margin-left:5px"></i> View messages/reports</a>
         <hr style="background-color: rgb(215, 212, 217)">
         <a href="admin-change.php" class="btn btn-block btn-sm btn-outline-primary"><i class="fas fa-key" style="margin-left:5px"></i> Change password</a>
       </div>

       <br> <br> <br>


  </body>
</html>

<?php
  include 'footer.php';
 ?>
