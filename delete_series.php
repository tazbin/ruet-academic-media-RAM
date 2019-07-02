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
  </head>
  <body style="background-color:rgb(244, 245, 245);>
    <div class="container">
      <br> <br> <br>
      <form style="max-width:300px" class="mx-auto" action="includes/delete.series.inc.php" method="post">
        <select class="btn btn-block btn-outline-danger" name="del_series">
          <option value="none">-</option>
        <?php
            $sql = "SELECT * FROM dept_series;";
            $res = mysqli_query($conn, $sql);
            $title = array();

            while ($head = mysqli_fetch_field($res)) {
              array_push($title, $head->name);
            }

            foreach ($title as $key) {
              if (strpos($key, "eries")) {
                echo '<option value='.$key.'>'.$key[7].$key[8].' series</option>';
              }
            }
          echo '</select>';
         ?>
        <button type="submit" name='ds' class="btn btn-sm btn-block btn-danger">Deletet series</button>
      </form>
      <br> <br> <br>
    </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
