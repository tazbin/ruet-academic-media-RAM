<?php
  include 'header.php';

  if ( $_SESSION['status']!="admin" ) {
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
  <body style="background-color:rgb(244, 245, 245);">
    <div class="container">
      <br> <br> <br>
      <form style="max-width:300px" class="mx-auto" action="includes/add.series.inc.php" method="post">
        <div class="form-group">
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter new series" name="series_name">
          <small id="emailHelp" class="form-text text-muted">Series name in last two digits  ( i.e. 15, 16 )</small>
        </div>

        <?php
          $sql = "SELECT * FROM dept_series;";
          $result = mysqli_query($conn, $sql);
          $checkresult = mysqli_num_rows($result);

          if ($checkresult>0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<div class="form-group">
                      <small id="emailHelp" class="form-text text-muted">Total student for '.$row['dept'].'</small>
                      <input type="text" class="form-control" name='.$row['dept_code'].'>
                    </div>';
            }
          }

         ?>
        <button type="submit" name="submit" class="btn btn-sm btn-block btn-success">Add dept</button>
      </form>
      <br> <br> <br>
    </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
