<!DOCTYPE html>
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
  </head style="background-color:rgb(244, 245, 245);>
  <body>
    <div class="container">
      <br> <br> <br>
      <form style="max-width:300px" class="mx-auto" action="includes/delete.dept.inc.php" method="post">
        <select class="btn btn-block btn-outline-danger" name="del_dept">
          <option value="none">-</option>
        <?php
          $sql = "SELECT * FROM dept_series;";
          $result = mysqli_query($conn, $sql);
          $checkresult = mysqli_num_rows($result);

          if ($checkresult>0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<option value='.$row['dept'].'>'.$row['dept'].'</option>';
            }
          }
          echo '</select>';
         ?>
        <button type="submit" name='dd' class="btn btn-sm btn-block btn-danger">Deletet dept</button>
      </form>
      <br> <br> <br>
    </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
