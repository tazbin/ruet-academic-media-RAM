<?php
include 'header.php';
  if ( !isset($_SESSION['user_name']) || $_SESSION['status']!="student"  ) {
    //  header("Location: index.php?authentication=protected");
    ?>
    <script>
        window.location.href="index.php?authentication=protected";
    </script>
    <?php
     exit();
  }
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | <?php echo $_SESSION['user_roll']; ?></title>
  </head>
  <!-- donut chart -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <!-- donut chart -->

  <!-- horizontal bar chart -->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <!-- horizontal bar chart -->
  <style>
    .shadow{
      -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
      -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
      box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    }

  </style>
  <body style="margin: 0px, padding: 0px">
    <div style="background-color: rgb(241, 244, 244); min-height:500px; padding-bottom:50px">
      <div class="container">

        <h3 class="lead text-center display-4" style="padding-top:10px">
          <?php
            //echo $_SESSION['user_name'];
           ?>
        </h3>
        <p class="lead text-muted text-center"><i class="fas fa-book-reader" style="padding-right: 10px"></i>Academic status</p>
        <hr>

      </div>

      <!-- notice bar -->

        <?php

        $st_roll = $_SESSION['user_roll'];

        $st_series = $st_roll[0].$st_roll[1];
        $st_dept = $st_roll[2].$st_roll[3];
        $st_roll_digit = $st_roll[4].$st_roll[5].$st_roll[6];

        //echo $st_roll." ".$st_series." ".$st_dept." ".$st_roll_digit;

        $sql = "SELECT COUNT(id) as total FROM course_teacher WHERE dept_code='$st_dept' && series=$st_series && ( start_roll <= $st_roll_digit && end_roll >= $st_roll_digit );";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);

        if ($data['total'] == 0) {
          echo '<p class="text-center text-muted lead">No courses has been added for you yet.</p>';
        } else{
          //collecting course data
          $ss = "SELECT * FROM course_teacher WHERE dept_code='$st_dept' && series=$st_series && ( start_roll <= $st_roll_digit && end_roll >= $st_roll_digit );";
          $rr = mysqli_query($conn, $ss);
          echo '<div class="row justify-content-center px-0 mx-0">';
          while ($data = mysqli_fetch_assoc($rr)) {

                $my_course = $data['course_number'];
                $my_teacher = $data['teacher'];
                $chart_id = $data['id'];
                $chart_id_bar = $data['id']+99999;
                $my_table = "_".$data['id'];

                //collecting result data
                $sql = "SELECT * from $my_table;";
                $result = mysqli_query($conn, $sql);
                $check_result = mysqli_num_rows($result);



                if ($check_result>0) {

                  while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['roll']==$st_roll) {

                      $my_tot_day = $row['tot_day'];
                      $my_att_day = $row['att_day'];
                      $my_ct_1 = $row['ct_1'];
                      $my_ct_2 = $row['ct_2'];
                      $my_ct_3 = $row['ct_3'];
                      $my_ct_4 = $row['ct_4'];
                      $date = $row['last_date'];

                      $chart_ct_1 = $my_ct_1;
                      $chart_ct_2 = $my_ct_2;
                      $chart_ct_3 = $my_ct_3;
                      $chart_ct_4 = $my_ct_4;

                      if ($date==NULL) {
                        $date="No date available";
                      }

                      if (is_null($my_ct_1)) {
                        $my_ct_1="N/A";
                        $chart_ct_1=0;
                      } if (is_null($my_ct_2)) {
                        $my_ct_2="N/A";
                        $chart_ct_2=0;
                      } if (is_null($my_ct_3)) {
                        $my_ct_3="N/A";
                        $chart_ct_3=0;
                      } if (is_null($my_ct_4)) {
                        $my_ct_4="N/A";
                        $chart_ct_4=0;
                      }

                      if ($my_tot_day==0) {
                        $att = "N/A";
                        $yes=100;
                      } else{
                        $att = round( ($my_att_day/$my_tot_day)*100 ,2);
                        $yes = $att;
                      }

                      $no=100-$yes;

                      echo '<div class="col-md-4 col-sm-12 card shadow mb-4 mr-2 ml-2" style="max-width: 20rem;">
                                  <div class="card-body text-center">
                                    <h5 class="card-title lead text-success pl-0"  style="font-size:25px"><i class="fas fa-book" style="padding-right: 10px"></i>'.$my_course.'</h5>
                                    <h6 class="card-subtitle lead mb-2 pl-0 text-info"  style="font-size:15px"><i class="fas fa-user-circle" style="padding-right: 10px"></i>'.$my_teacher.'</h6>
                                      <ul class="list-group list-group-flush">
                                      <div id='.$chart_id.' class="mx-auto" style="height: 150px; width:100%; margin-top: 10px"></div>
                                      <div class="row px-3 py-2" style="font-size: 12px">
                                      <div class="text-left text-muted">
                                      <i class="fas fa-calendar-alt" style="padding-right: 5px"></i>
                                      Total day: '.$my_tot_day.'
                                      </div>
                                      <div class="ml-auto text-muted">
                                      <i class="fas fa-thumbs-up" style="padding-right: 5px"></i>
                                      Attended day: '.$my_att_day.'
                                      </div>
                                      </div>
                                      <text class="list-group-item lead py-2" style="font-size: 15px; margin-top: 10px; color: rgb(5, 157, 139);"><i class="fas fa-university" style="padding-right: 10px"></i>Attendance: '.$att.' %</text>
                                      <text class="lead py-0" style="font-size: 12px; margin-top: 10px;"><i class="fas fa-university" style="padding-right: 10px"></i>'.$date.'</text>';

                                      if ($att=='N/A') {
                                        $class = 2*( ($my_tot_day/2)- $my_att_day);
                                        echo '<li class="list-group-item lead py-1" style="font-size: 13px; margin-top: 10px;"><i class="fas fa-exclamation-triangle" style="padding-right: 5px"></i>No calss has been taken yet. </li>';
                                      } elseif ($att<50) {
                                        $class = 2*( ($my_tot_day/2)- $my_att_day);
                                        echo '<li class="list-group-item lead py-1" style="font-size: 13px; margin-top: 10px; color: #d9534f;"><i class="fas fa-exclamation-triangle" style="padding-right: 5px"></i>You must attend '.$class.' more class(s) to have 50% attendance! </li>';
                                      } elseif ($att>=50 && $att<=65) {
                                        echo '<li class="list-group-item lead py-1" style="font-size: 13px; margin-top: 10px; color: #f0ad4e;"><i class="fas fa-exclamation-triangle" style="padding-right: 5px"></i>Your attandance is on edge, do not miss any class! </li>';
                                      } else {
                                        echo '<li class="list-group-item lead py-1" style="font-size: 13px; margin-top: 10px; color: #5cb85c;"><i class="fas fa-thumbs-up" style="padding-right: 5px"></i>Your attendance is good, keep clam & study more! </li>';
                                      }

                                        echo'<div id='.$chart_id_bar.' style="height: 150px; width: 100%; margin-top: -10px; margin-bottom: -25px"></div>
                                      <div style="line-height: 0.1">
                                        <table class="table text-center" style="font-size: 10px; height: 50px;">
                                          <thead class="thead-light">
                                            <tr>
                                              <th scope="col"><i class="far fa-edit" style="padding-right: 5px"></i>Class Test</th>
                                              <th scope="col"><i class="far fa-check-square" style="padding-right: 5px"></i>Mark</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th scope="row">1</th>
                                              <td>'.$my_ct_1.'</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">2</th>
                                              <td>'.$my_ct_2.'</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">3</th>
                                              <td>'.$my_ct_3.'</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">4</th>
                                              <td>'.$my_ct_4.'</td>
                                            </tr>

                                          </tbody>
                                        </table>
                                      </div>

                                      </ul>
                                      </div>
                                      </div>
                                      ';

                                      /*
                                      <li class="list-group-item lead pl-2" style="font-size: 10px"><i class="far fa-edit" style="padding-right: 10px"></i>Class test 1: '.$my_ct_1.'</li>
                                      <li class="list-group-item lead py-2" style="font-size: 10px"><i class="far fa-edit" style="padding-right: 10px"></i>Class test 2: '.$my_ct_2.'</li>
                                      <li class="list-group-item lead py-2" style="font-size: 10px"><i class="far fa-edit" style="padding-right: 10px"></i>Class test 3: '.$my_ct_3.'</li>
                                      <li class="list-group-item lead py-2" style="font-size: 10px"><i class="far fa-edit" style="padding-right: 10px"></i>Class test 4: '.$my_ct_4.'</li>
                                      */

                                 echo "<script>
                                     new Morris.Donut({
                                   // ID of the element in which to draw the chart.
                                   element: '$chart_id',
                                   // Chart data records -- each entry in this array corresponds to a point on
                                   // the chart.
                                   data: [
                                     { label: 'Attended', value: $yes },
                                     { label: 'Not attended', value: $no }
                                   ],

                                    labelColor: 'rgb(125, 125, 126)',
                                    colors: [
                                      'rgb(1, 201, 177)',
                                      'rgb(247, 9, 223)'
                                    ],
                                   barGap:4,
                                   barSizeRatio:0.20,
                                   // The name of the data record attribute that contains x-values.
                                   //xkey: 'year',
                                   // A list of names of data record attributes that contain y-values.
                                   ykeys: ['value'],
                                   // Labels for the ykeys -- will be displayed when you hover over the
                                   // chart.
                                   labels: ['Mark']
                                 })

                                 //bar charts for ct marks

                                 var data = [

                                     { y: '', a: $chart_ct_1, b: 20-$chart_ct_1,},
                                     { y: '', a: $chart_ct_2, b: 20-$chart_ct_2,},
                                     { y: '', a: $chart_ct_3, b: 20-$chart_ct_3,},
                                     { y: '', a: $chart_ct_4, b: 20-$chart_ct_4}
                                   ],
                                   formatY = function (y) {
                                           return y;
                                       },
                                   formatX = function (x) {
                                           return x.src.y;
                                       },

                                   config = {
                                     data: data,
                                     xkey: 'y',
                                     ykeys: ['a', 'b'],
                                     labels: ['Total Income', 'Total Outcome'],
                                     fillOpacity: 0.6,
                                     hideHover: 'auto',
                                     stacked: true,
                                     resize: true,
                                     pointFillColors:['#ffffff'],
                                     pointStrokeColors: ['black'],
                                     barColors:['rgb(1, 135, 201)', 'rgb(244, 240, 244)'],
                                     barGap:4,
                                     barSizeRatio:0.30,
                                     yLabelFormat:formatY,
                                     xLabelFormat: formatX,
                                     hoverCallback: function (index, options, content, row) {
                                       return '';
                                     }
                                 };

                                 config.element = '$chart_id_bar';
                                 Morris.Bar(config);

                                 //bar charts for ct mark

                                 </script>";

                    }
                  }

                }
              }
              echo '</div>';
            }
         ?>
        <!-- </div> -->
      </div>
    </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
