<!DOCTYPE html>
<?php
  include 'header.php';
  //include 'includes/result.form.inc.php';

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | News</title>
    <link href="https://fonts.googleapis.com/css?family=News+Cycle" rel="stylesheet">
  </head>
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }
  </style>
  <body style="background-color: rgb(241, 244, 244);">
    <div style=" min-height:500px;">
      <div class="container">
        <br>
        <?php

        $sql = "SELECT * FROM news ORDER by id DESC;";
        $result = mysqli_query($conn, $sql);
        $check_result = mysqli_num_rows($result);

        if ($check_result>0) {
          while ( $row = mysqli_fetch_assoc($result) ) {
            $id = $row['id'];
            $title = $row['title'];
            $text = $row['text'];
            $fulldate = $row['date'];

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

            echo '<form class="" action="includes/news.post.inc.php" method="post">';

            echo '<div class="card shadow" style="margin-top: 25px; margin-bottom: 0px">
                    <div class="card-body">
                      <text class="text-info lead" style="font-size: 15px"><i class="far fa-newspaper" style="padding-right: 10px;"></i>R.A.M. NEWS</text>
                      <text class="text-info lead" style="font-size: 10px; padding-left: 10px;"><i class="far fa-clock" style="padding-right: 3px"></i> '.$fulldate.' </text>
                      <h5 class="card-title" style="font-family: '.$font.', sans-serif; font-size:40px; padding-top: 10px">'.$title.'</h5>

                      <p class="card-text text-muted" style="font-size: 15px">'.$text.'</p> <hr>';

            echo '<input type="hidden" name="id" value='.$id.'>';

                  if ( isset($_SESSION['status']) ) {
                    if ( $_SESSION['status']=="admin" ) {
                      echo '<button type="submit" class="btn btn-danger btn-sm" name="delete"><i class="far fa-trash-alt" style="padding-right: 5px"></i> Delete news</button>';
                    }
                  }

                  echo '</form>
                  </div>
                </div>';
          }
        }
         ?>
         <br> <br>
      </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
