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
    <title> RAM | Manage Notice</title>
  </head>
  <style>
    .shadow{
      -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
      -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
      box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    }
  </style>
  <body>
    <div style="background-color:rgb(244, 245, 245); min-height:500px; padding-bottom:50px">
      <div class="container">

        <br>
        <p class="lead text-muted text-center"><i class="fas fa-chalkboard" style="padding-right:10px"></i>Notice board</p>
        <hr>

      </div>

      <!-- notice bar -->
        <?php

        $is_notice=0;

        $sql = "SELECT * from notice ORDER BY notice_id DESC;";
        $result = mysqli_query($conn, $sql);
        $check_result = mysqli_num_rows($result);

        if ($check_result>0) {
          while ($row = mysqli_fetch_assoc($result)) {
            if ( $row['sender']==$_SESSION['user_mail'] ) {
              $notice_id = $row['notice_id'];
              $notice_date = $row['notice_date'];
              $notice_course_id = $row['receiver'];
              $notice_subject = $row['notice_subject'];
              $notice_text = $row['notice_text'];
              $is_file = $row['is_file'];
              $file_name = $row['file_name'];

              //mathing course id
              $sql_2 = "SELECT * from course_teacher WHERE id='$notice_course_id';";
              $result_2 = mysqli_query($conn, $sql_2);
              $check_result_2 = mysqli_num_rows($result_2);

              if ($check_result_2 > 0) {
                while ($row_2 = mysqli_fetch_assoc($result_2)) {
                  $course_name = $row_2['course_number'];
                  $dept = $row_2['dept'];
                  $series = $row_2['series'];
                  $section = $row_2['section'];

                  $is_notice++;

                    echo '<form class="container" action="includes/notice.post.inc.php" method="post">
                    <div class="shadow container mx-auto list-group-item list-group-item-action mb-2" style="max-width: 500px;">
                      <div class="d-flex w-100 justify-content-between" style="margin-bottom: -10px">
                        <h5 class="mb-0 text-success lead"><i class="far fa-bookmark" style="padding-right:10px"></i>'.$notice_subject.'</h5>
                        <small class="text-muted" style="font-size: 10px;"><i class="far fa-calendar-alt" style="padding-right:10px"></i>'.$notice_date.'</small>
                      </div><hr class="bg-muted">
                      <p class="mb-2 lead" style="font-size: 15px;">'.$notice_text.'</p>';

                      if ($is_file==1) {
                        echo '<a href="uploads/'.$file_name.'" style="font-size: 12px"><i class="fas fa-cloud-download-alt" style="padding-right: 5px"></i>'.$file_name.'</a><br>';
                      }

                      echo '<small class="text-muted" style="font-size: 12px;"><i class="fas fa-book text-info" style="padding-right: 3px"></i> <text class="text-info">'.$course_name.'</text><i class="fas fa-users text-info" style="padding-left:10px; padding-right: 5px"></i><text class="text-info">'.$dept.' '.$series.' '.$section.'</text></small>
                      <hr>
                      <input type="hidden" name="id" value='.$notice_id.'>
                      <button type="submit" class="btn btn-sm btn-danger" style="font-size: 10px" name="delete"><i class="far fa-trash-alt" style="padding-right: 5px"></i> Delete notice</button>
                    </div>
                    </form>';

                }
              }

            }
          }
        }

        if($is_notice==0) {

          echo '<div class="text-center lead"><i class="far fa-bell-slash text-center"></i>';
          echo '<p class="lead text-center text-muted" style="font-size: 14px"><i>You have not posted any notice yet<br>';
          echo 'Go to home and select "Post Notice" option to post a notice</i></p></div>';
        }

         ?>




        </div>
      </div>
    </div>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
