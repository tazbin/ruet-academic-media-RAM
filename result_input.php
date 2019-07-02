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
    <title> RAM | Result</title>
  </head>
  <body>
    <div style="background-color: rgb(241, 244, 244); min-height:500px; padding-bottom:50px">
      <div class="container">
        <br>

          <?php
            echo '<p class="lead text-muted text-center" style="font-size: 15px">Insert <strong class="text-info">'.$_SESSION['exam'].'</strong> result for <strong class="text-info">'.$_SESSION['course_number'].'</strong></p>';
            echo '<hr>';

          //  echo $_SESSION['exam_dept']." ".$_SESSION['exam_series'];

           ?>

           <form class="" action="includes/result.final.inc.php" method="post">

           <table class="table table-striped mx-auto text-center" style="max-width:500px">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Roll</th>
                <th scope="col">Marks</th>
              </tr>
            </thead>
            <tbody>
              <tr>

                <?php
                  $sql = "SELECT * FROM course_teacher;";
                  $result = mysqli_query($conn, $sql);
                  $result_check = mysqli_num_rows($result);

                  if( $result_check > 0 ){
                    while ($row = mysqli_fetch_assoc($result)){
                      if ($row['teacher_id'] == $_SESSION['user_id'] && $row['course_number'] == $_SESSION['course_number']) {
                        $_SESSION['exam_table'] = "_".$row['id'];
                      }
                    }
                  }

                    //echo $_SESSION['exam_table']."<br>";
                    $table = $_SESSION['exam_table'];

                    $sql = "SELECT * FROM $table;";
                    $result = mysqli_query($conn, $sql);
                    $result_check = mysqli_num_rows($result);

                    if( $result_check > 0 ){
                      while ($row = mysqli_fetch_assoc($result)){
                        //if ($row['section'] == $_SESSION['section']) {
                          //echo $row['roll']."<br>";
                          echo "<td>".$row['roll'].'</td>
                          <td><input type="number" style="max-width:100px" class="form-control mx-auto" id="exampleInputEmail1" aria-describedby="emailHelp" name='.$row['roll']."></td>
                        </tr>";
                        //}

                      }
                    }
                 ?>

            </tbody>
          </table>

          <button type="submit" name="result" class="btn btn-block btn-success mx-auto" style="max-width:300px"><i class="fas fa-check" style="padding-right: 10px;"></i>Submit Result</button>
          </form>
      </div>

      <br>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
