<!DOCTYPE html>
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
    <title> RAM | Notepad</title>
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
      <div class="container" style="min-height: 500px">
        <br>
        <div class="text-center">
        <a href="add_student_note.php" class="btn btn-sm btn-outline-primary px-4" style="font-size: 13px; border-radius: 50px;"><i class="fas fa-pencil-alt" style="padding-right: 5px;"></i> Add notes</a>
        </div>
        <hr>

        <?php

        $note_num = 0;

        $sql = "SELECT * FROM student_note ORDER by id DESC;";
        $result = mysqli_query($conn, $sql);
        $check_result = mysqli_num_rows($result);

        if ($check_result>0) {
          while ( $row = mysqli_fetch_assoc($result) ) {
            $id = $row['id'];
            $title = $row['title'];
            $text = $row['text'];
            $fulldate = $row['date'];
            $roll = $row['roll'];

            if ( $roll == $_SESSION['user_roll'] ) {

            $note_num++;

            /*

            $month = $alldate['5'].$alldate['6'];
            $date = $alldate['8'].$alldate['9'];

            if ($month==1) {
              $month="Jan";
            } elseif ($month==2) {
              $month="Feb";
            } elseif ($month==3) {
              $month="Mar";
            } elseif ($month==4) {
              $month="Apr";
            } elseif ($month==5) {
              $month="May";
            } elseif ($month==6) {
              $month="June";
            } elseif ($month==7) {
              $month="July";
            } elseif ($month==8) {
              $month="Aug";
            } elseif ($month==9) {
              $month="Sep";
            } elseif ($month==10) {
              $month="Oct";
            } elseif ($month==11) {
              $month="Nov";
            } elseif ($month==12) {
              $month="Dec";
            }

            $hour = $alldate[11].$alldate[12];
            $minute = $alldate[14].$alldate[15];

            $suf = "am";

            if ($hour>12) {
              $hour=24-$hour;
              $suf="pm";
            }

            */

            $font = "News Cycle";

            echo '<form class="" action="includes/std.note.inc.php" method="post">';

            echo '<div class="card shadow mx-auto" style="margin-top: 20px; margin-bottom: 0px; max-width: 500px">
                    <div class="card-body">
                      <text class="text-primary lead" style="font-size: 10px;"><i class="far fa-edit" style="padding-right: 5px;"></i>Student note</text>
                      <text class="text-primary lead" style="font-size: 10px; padding-left: 10px;"><i class="far fa-clock" style="padding-right: 3px"></i> '.$fulldate.' </text>
                      <h5 class="card-title" style="font-family: '.$font.', sans-serif; font-size:20px; padding-top: 10px">'.$title.'</h5>

                      <p class="card-text text-muted" style="font-size: 15px">'.$text.'</p> <hr>';

            echo '<input type="hidden" name="id" value='.$id.'>';

                  if ( isset($_SESSION['status']) ) {
                    if ( $_SESSION['status']=="student" ) {
                      echo '<button type="submit" class="btn btn-danger btn-sm" style="font-size: 10px" name="delete"><i class="far fa-trash-alt" style="padding-right: 5px"></i> Delete this note</button>';
                    }
                  }

                  echo '</form>
                  </div>
                </div>';
              }
          }
        }
        if( $note_num==0 ){
          echo '<p class="lead text-muted text-center">No note added!</p>';
        }
         ?>
         <br> <br>

    </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
