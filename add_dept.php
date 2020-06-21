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
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }
  </style>
  <body style="background-color:rgb(244, 245, 245)";>
    <div class="container">
      <br> <br> <br>
      <form style="max-width:300px" class="mx-auto" action="includes/add.dept.inc.php" method="post">
        <div class="form-group">
          <input type="text" class="shadow form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter dept name" name="dept_name">
          <small id="emailHelp" class="form-text text-muted">Dept name in short form ( i.e. ECE, CSE )</small>
        </div>
        <div class="form-group">
          <input type="number" class="shadow form-control" id="exampleInputPassword1" name="dept_code" placeholder="Enter dept code">
        </div>
        <?php
          $sql = "SELECT * FROM dept_series;";
          $res = mysqli_query($conn, $sql);
          $title = array();

          while ($head = mysqli_fetch_field($res)) {
            array_push($title, $head->name);
          }

          foreach ($title as $key) {
            if (strpos($key, "eries")) {
              echo '<div class="form-group">
                      <small id="emailHelp" class="form-text text-muted">Enter student number for '.$key.'</small>
                      <input type="number" class="shadow form-control" id="exampleInputPassword1" name='.$key.'>
                    </div>';
            }
          }
         ?>
        <button type="submit" class="shadow btn btn-sm btn-block btn-success">Add dept</button>
      </form>
      <br> <br> <br>
    </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
