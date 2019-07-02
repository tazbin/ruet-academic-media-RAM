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
    <title> RAM | Home</title>
  </head>
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }
  </style>
  <body>
    <div style="background-color: rgb(244, 245, 245); min-height:500px; padding-bottom:50px">
        <br>
        <p class="lead text-center">Report/messages</p>
        <hr style="max-width:80%">
          <div class="list-group container align-items-center" style="max-width:500px">
            <?php
            $sql = "SELECT * from report ORDER BY report_num DESC;";
            $result = mysqli_query($conn, $sql);
            $check_result = mysqli_num_rows($result);

            if ($check_result > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $report_text = $row['report_text'];
                $report_date = $row['report_date'];
                $user_name = $row['user_name'];
                $user_mail = $row['user_mail'];
                $user_phone = $row['user_phone'];
                $r_id = $row['report_num'];

                  echo '<div class="card shadow" style="width:80%">
                           <div class="card-header text-info"><i class="far fa-user" style="padding-right: 5px"></i>
                             '.$user_name.'<br><text style="font-size: 12px;" class="text-muted"><i class="far fa-envelope" style="padding-right:5px;"></i>'.$user_mail.'  <i class="fas fa-phone" style="padding-right:5px; padding-left:10px"></i>'.$user_phone.'</text>
                           </div>
                           <div class="card-body">
                             <p class="card-text">'.$report_text.'</p>
                             <text style="font-size: 12px" class="text-muted">
                             <i class="far fa-clock" style="padding-right: 5px"></i>'.$report_date.'
                             </text>
                             <form class="text-center mx-auto" style="margin-top: -25px" action="includes/delete.report.inc.php" method="post">
                               <input type="hidden" name="report_id" value='.$r_id.'> <br>
                               <div class="text-right" style="margin-top: -25px">
                               <button type="submit" name="button" class="btn px-4 btn-sm btn-outline-danger" style="font-size: 10px;">Delete</button>
                               </div>
                             </form>
                           </div>
                         </div><br>';

              }
            }
             ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
