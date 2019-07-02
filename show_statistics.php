<!DOCTYPE html>
<?php
  include 'header.php';
  //include 'includes/result.form.inc.php';

  if ( !isset($_SESSION['user_name']) || $_SESSION['status']!="teacher"  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Statistics</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  </head>
  <body>
    <div style="background-color: rgb(241, 244, 244); min-height:500px; padding-bottom:50px">
      <div class="container">
          <?php
            $sta_id = $_SESSION['sta_course'];

            $sql = "SELECT * FROM course_teacher where id=$sta_id;";
            $result = mysqli_query($conn, $sql);
            $check_result = mysqli_num_rows($result);

            if ($check_result>0) {
              while ( $row = mysqli_fetch_assoc($result) ) {
                $sta_course_name = $row['course_number'];
                $_SESSION['pdf_course'] = $row['course_number'];
                $sta_dept = $row['dept'];
                $sta_series = $row['series'];
                $sta_section = $row['section'];
              }
            }
            echo '<div class="text-center"><p class="lead text-muted text-center display-4" style="padding-top:30px"><i class="fas fa-chart-pie" style="padding-right: 10px"></i>Statistics</p>';
            echo '<text class="lead text-info text-center" style="font-size: 15px"> Course Name: '.$sta_course_name.'</text><br>';
            echo '<text class="lead text-info text-center" style="font-size: 15px"> Department: '.$sta_dept.', Series: '.$sta_series. ', Section: '.$sta_section.'</text></div>';
           ?>
        <hr>

        <?php
          //showing eache student data
          $sta_table = $_SESSION['sta_table'];
          $sql = "SELECT * FROM $sta_table;";
          $result = mysqli_query($conn, $sql);
          $check_result = mysqli_num_rows($result);

          echo '<div class="row justify-content-center">
            <div class="col-md-3 col-sm-6" style="padding-top: 4px; padding-bottom:4px" align="center">
                <form method="post" action="pdf.generate.php">
                <input type="hidden" name="table" value='.$sta_table.'>
                <input type="hidden" name="dept" value='.$sta_dept.'>
                <input type="hidden" name="series" value='.$sta_series.'>
                <input type="hidden" name="course" value='.$sta_course_name.'>
                      <button type="submit" style="border-radius: 50px;" name="generate_pdf" class="btn btn-sm btn-outline-danger lead px-5" style="font-size: 12px"><i class="fas fa-file-pdf" style="padding-right: 5px"></i> Get PDF Report</button>
                </form>
              </div>

              <div class="col-md-3 col-sm-6" style="padding-top: 4px; padding-bottom:4px" align="center">
                    <form method="post" action="pdf.generate.php">
                    <input type="hidden" name="table" value='.$sta_table.'>
                    <input type="hidden" name="dept" value='.$sta_dept.'>
                    <input type="hidden" name="series" value='.$sta_series.'>
                    <input type="hidden" name="course" value='.$sta_course_name.'>
                          <button type="submit" style="border-radius: 50px;" name="generate_excel" class="btn btn-sm btn-outline-success lead px-5" style="font-size: 12px"><i class="fas fa-file-excel" style="padding-right: 5px"></i> Get Excel Report</button>
                    </form>
                  </div>
               </div>

                <hr>';

          if ($check_result>0) {
            echo '<div class="row justify-content-center">';
            while ( $row = mysqli_fetch_assoc($result) ) {
              $st_roll = $row['roll'];
              $st_roll_bar = $row['roll']+9999;
              $st_tot_day = $row['tot_day'];
              $st_att_day = $row['att_day'];
              $st_ct_1 = $row['ct_1'];
              $st_ct_2 = $row['ct_2'];
              $st_ct_3 = $row['ct_3'];
              $st_ct_4 = $row['ct_4'];

              $chart_ct_1 = $st_ct_1;
              $chart_ct_2 = $st_ct_2;
              $chart_ct_3 = $st_ct_3;
              $chart_ct_4 = $st_ct_4;


              if (is_null($st_ct_1)) {
                $st_ct_1="N/A";
                $chart_ct_1=0;
              }
              if (is_null($st_ct_2)) {
                $st_ct_2="N/A";
                $chart_ct_2=0;
              }
              if (is_null($st_ct_3)) {
                $st_ct_3="N/A";
                $chart_ct_3=0;
              }
              if (is_null($st_ct_4)) {
                $st_ct_4="N/A";
                $chart_ct_4=0;
              }

              if ($st_tot_day==0) {
                $att="N/A";
                $yes=100;
              } else{
                $att = round( ($st_att_day/$st_tot_day)*100 ,2)."%";
                $yes=round( ($st_att_day/$st_tot_day)*100 ,2);
              }

              $no=100-$yes;

              echo '<div class="pr-3">
                        <div class="card ml-2 mx-auto" style="width: 16.5rem;
                        -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
                        -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
                        box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
                        ">
                          <div class="card-body mx-auto">
                            <h5 class="card-title lead text-success pl-4"  style="font-size:35px">'.$st_roll.'</h5>
                            <h6 class="card-subtitle lead mb-2 pl-4 text-info"  style="font-size:15px"><i class="fas fa-user-graduate" style="padding-right: 10px"></i>Student</h6>
                            <div id='.$st_roll.' style="height: 150px; width:100%"></div>
                            <ul class="list-group list-group-flush">

                            <text class="py-1 text-center text-muted" style="font-size: 12px;"><i class="fas fa-calendar-alt" style="padding-right: 5px"></i>Total day: '.$st_tot_day.'</text>
                            <text class="py-1 text-center text-muted" style="font-size: 12px;"><i class="fas fa-thumbs-up" style="padding-right: 5px"></i>Attended day: '.$st_att_day.'</text>
                              <li class="list-group-item py-1" style="font-size: 15px; color: rgb(4, 179, 158);"><i class="fas fa-university" style="padding-right: 10px"></i>Attendance: '.$att.'</li>
                              <div id='.$st_roll_bar.' style="height: 150px; width:100%; margin-bottom: -20px"></div>
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
                                      <td>'.$st_ct_1.'</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">2</th>
                                      <td>'.$st_ct_2.'</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">3</th>
                                      <td>'.$st_ct_3.'</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">4</th>
                                      <td>'.$st_ct_4.'</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </ul>
                          </div>
                        </div> <br>
                    </div>';

                    /*
                    <li class="list-group-item lead py-1" style="font-size: 10px"><i class="far fa-edit" style="padding-right: 10px"></i>Class test 1: <text style="color: rgb(3, 121, 180);">'.$st_ct_1.'</text></li>
                    <li class="list-group-item lead py-1" style="font-size: 10px"><i class="far fa-edit" style="padding-right: 10px"></i>Class test 2: <text style="color: rgb(3, 121, 180);">'.$st_ct_2.'</text></li>
                    <li class="list-group-item lead py-1" style="font-size: 10px"><i class="far fa-edit" style="padding-right: 10px"></i>Class test 3: <text style="color: rgb(3, 121, 180);">'.$st_ct_3.'</text></li>
                    <li class="list-group-item lead py-1" style="font-size: 10px"><i class="far fa-edit" style="padding-right: 10px"></i>Class test 4: <text style="color: rgb(3, 121, 180);">'.$st_ct_4.'</text></li>
                    */

                    echo "<script>
                        new Morris.Donut({
                      // ID of the element in which to draw the chart.
                      element: '$st_roll',
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
                      xkey: 'year',
                      // A list of names of data record attributes that contain y-values.
                      ykeys: ['value'],
                      // Labels for the ykeys -- will be displayed when you hover over the
                      // chart.
                      labels: ['Mark']
                    });

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

                    config.element = '$st_roll_bar';
                    Morris.Bar(config);

                    //bar charts for ct mark
                    </script>";
            }
            echo '</div>';
          }
          //showing eache student data
        ?>
      </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
