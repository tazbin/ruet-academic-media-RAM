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
    <title> RAM | Pending List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }

  @media (max-width: 500px) {
  .tt {
    display: none;
  }

  .cc{
    display: block;
  }
}

@media (min-width: 501px) {
  .tt {
    display: block;
  }

  .cc{
    display: none;
  }
}

}
  </style>
  <body style="background-color:rgb(244, 245, 245);">
    <div style="min-height:500px; padding-bottom:50px">
      <div class="container" style="padding-top:50px">

        <div class="tt">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" style="width: 10%">Roll</th>
              <th scope="col" style="width: 30%">Name</th>
              <th scope="col" style="width: 15%">E-mail</th>
              <th scope="col" style="width: 15%">Phone</th>
              <th scope="col" style="width: 5%">Department</th>
              <th scope="col" style="width: 5%">Series</th>
              <th scope="col" style="width: 20%">Action</th>
            </tr>
          </thead>
          <tbody style="font-size: 13px">
            <?php
              $sql = "SELECT * FROM student_data;";
              $result=mysqli_query($conn, $sql);
              $check_result = mysqli_num_rows($result);

              if ($check_result>0) {
                while ($row=mysqli_fetch_assoc($result)) {
                  $roll = $row['st_roll'];
                  $name = $row['st_name'];
                  $dept = $row['st_dept'];
                  $series = $row['st_series'];
                  $pending = $row['is_pending'];
                  $mail = $row['st_mail'];
                  $phone = $row['st_phone'];

                  if ($pending==1) {
                    echo '<tr><td>'.$roll.'</td>';
                    echo '<td>'.$name.'</td>';
                    echo '<td>'.$mail.'</td>';
                    echo '<td>'.$phone.'</td>';
                    echo '<td>'.$dept.'</td>';
                    echo '<td>'.$series.'</td>';
                    echo '<td>
                    <form action="includes/pending.action.inc.php" method="post">
                      <input type="hidden" name="roll" value="'.$roll.'">
                      <button type="submit" name="approve" class="btn btn-sm btn-success" style="margin-right:5px; font-size: 10px"><i class="far fa-check-circle" style="padding-right: 3px;"></i> Approve</button>
                      <button type="submit" name="remove" class="btn btn-sm btn-danger" style="margin-left:5px; font-size: 10px"><i class="fas fa-ban" style="padding-right: 3px"></i> Remove</button>
                    </form>
                    </td></tr>';
                  }
                }
              }
             ?>

          </tbody>
        </table>
      </div>

        <?php
          $sql = "SELECT * FROM student_data;";
          $result=mysqli_query($conn, $sql);
          $check_result = mysqli_num_rows($result);

          if ($check_result>0) {
            while ($row=mysqli_fetch_assoc($result)) {
              $roll = $row['st_roll'];
              $name = $row['st_name'];
              $dept = $row['st_dept'];
              $series = $row['st_series'];
              $pending = $row['is_pending'];
              $mail = $row['st_mail'];

              if ($pending==0) {
                echo '<div class="cc"><div class="card" style="width: 100%; margin-bottom: 5px">
                   <div class="card-body">
                     <h5 class="card-title">'.$name.'</h5> <hr>
                     <h6 class="card-subtitle mb-2 text-muted"></h6>
                     <p class="card-text">Roll: '.$roll.'<br>E-mail: '.$mail.'<br>Department: '.$dept.'<br>Series: '.$series.'</p>
                     <form action="includes/pending.action.inc.php" method="post">
                       <input type="hidden" name="roll" value="'.$roll.'">
                       <button type="submit" name="approve" class="btn btn-sm btn-success" style="margin-right:5px; font-size: 12px"><i class="far fa-thumbs-up" style="padding-right: 3px;"></i> Approve</button>
                       <button type="submit" name="remove" class="btn btn-sm btn-danger" style="margin-left:5px; font-size: 12px"><i class="far fa-thumbs-down" style="padding-right: 3px"></i> Remove</button>
                     </form>
                   </div>
                 </div></div>';
              }
            }
          }
         ?>

      </div>
    </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
