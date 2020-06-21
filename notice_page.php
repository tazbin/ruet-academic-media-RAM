<?php
  include 'header.php';

  if ( !isset($_SESSION['user_name']) || $_SESSION['status']!="student"  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Notice Page</title>
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
        <p class="lead text-muted text-center"><i class="fas fa-bullhorn" style="padding-right:10px"></i>Notice board</p>
        <hr>

      </div>

      <!-- notice bar -->

        <?php

        $roll = $_SESSION['user_roll'];
        $st_series = $roll[0].$roll[1];
        $st_dept_code = $roll[2].$roll[3];


        $digit_roll = $roll[4].$roll[5].$roll[6];

        //echo $st_series." ".$st_dept_code." ".$st_sec;
        $is_notice=0;

        //to store notice ids
        unset($all_notice_id);
        $all_notice_id = array();

        $sql = "SELECT * from course_teacher;";
        $result = mysqli_query($conn, $sql);
        $check_result = mysqli_num_rows($result);

        if ($check_result>0) {
          while ($row = mysqli_fetch_assoc($result)) {
            if ( $row['dept_code']==$st_dept_code && $row['series']==$st_series && ( $row['start_roll']<= $digit_roll && $row['end_roll']>= $digit_roll ) ) {
              $notice_id = $row['id'];
              $notice_course = $row['course_number'];

              array_push($all_notice_id,$notice_id );

            }
          }
        }

        //mathing notice id
        $sql_2 = "SELECT * from notice JOIN teacher_data ON notice.sender=teacher_data.teacher_mail ORDER BY notice_id DESC;";
        $result_2 = mysqli_query($conn, $sql_2);
        $check_result_2 = mysqli_num_rows($result_2);

        if ($check_result_2 > 0) {
          while ($row_2 = mysqli_fetch_assoc($result_2)) {
            $notice_subject = $row_2['notice_subject'];
            $notice_date = $row_2['notice_date'];
            $sender = $row_2['sender'];
            $notice_text = $row_2['notice_text'];
            $receiver = $row_2['receiver'];
            $is_file = $row_2['is_file'];
            $file_name = $row_2['file_name'];
            $tazbinur = $row_2['teacher_name'];

            $size = count($all_notice_id);

            for ($i=0; $i < $size; $i++) {

              if ( $row_2['receiver'] == $all_notice_id[$i] ) {
                $is_notice++;
                echo '<div class="container">
                <div href="#" class="shadow container mx-auto list-group-item list-group-item-action mb-2" style="max-width: 500px;">
                  <div class="d-flex w-100 justify-content-between" style="margin-bottom: -10px;">
                    <h5 class="mb-0 lead text-success"><i class="far fa-bookmark" style="padding-right:10px"></i>'.$notice_subject.'</h5>
                    <small class="text-muted" style="font-size: 10px;"><i class="far fa-calendar-alt" style="padding-right:5px"></i>'.$notice_date.'</small>
                  </div><hr class="bg-muted">
                  <p class="mb-2 lead" style="font-size: 15px;">'.$notice_text.'</p>';

                  if ($is_file==1) {
                    echo '<a href="uploads/'.$file_name.'" style="font-size: 12px"><i class="fas fa-cloud-download-alt" style="padding-right: 5px"></i>'.$file_name.'</a><br>';
                  }

                  echo '<small class="text-muted" style="font-size: 10px"><i class="fas fa-user-circle text-info" style="padding-right: 3px"></i> <text class="text-info">'.$tazbinur.'</text><i class="fas fa-book text-info" style="padding-left:10px; padding-right: 5px"></i><text class="text-info">'.$notice_course.'</text></small>
                </div>
                </div>';

                break;
              }

            }
          }
        }
        //mathing notice id

        if ($is_notice==0) {

          echo '<div class="text-center lead"><i class="far fa-bell-slash text-center"></i>';
          echo '<p class="lead text-center text-muted" style="font-size: 14px"> <i> No Notice has been posted yet</i></p></div>';
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
