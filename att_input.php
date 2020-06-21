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
    <title> RAM | Attendance</title>
  </head>
  <body>
    <div style="background-color: rgb(241, 244, 244); min-height:500px; padding-bottom:50px">
      <div class="container">
        <br>
        <?php

        //date finding
        $table = $_SESSION['att_table'];
        $sql = "SELECT * FROM $table;";
         $result = mysqli_query($conn, $sql);
         $checkresult = mysqli_num_rows($result);

         if ($checkresult > 0) {
           while ($row=mysqli_fetch_assoc($result)) {
             $date = $row['last_date'];
           }
         }
        //date finding

          $tazbinur_att_dept = $_SESSION['tazbinur_att_dept'];
          $tazbinur_att_series = $_SESSION['tazbinur_att_series'];
          $tazbinur_att_course = $_SESSION['tazbinur_att_course'];

          echo '<p class="lead text-success text-center" style="font-size: 15px">Take attendance of '.$tazbinur_att_dept.' '.$tazbinur_att_series.' Series<br>';
          echo 'Course: '.$tazbinur_att_course.'</p>';

          echo '<p class="text-center text-info" style="font-size: 15px">Last Att recorded: '.$date.'</p>';
         ?>
        <p class="lead text-muted text-center" style="font-size: 15px">Mark absent students</p>
        <hr>

        <form class="" action="includes/att.input.inc.php" method="post">

        <table class="table table-striped mx-auto text-center" id="group_1" style="max-width:500px">
         <thead class="thead-dark">
           <tr>
             <th scope="col">Roll</th>
             <th scope="col">Absent</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <?php
               //echo $_SESSION['att_table']." ".$_SESSION['att_section'];
               $table = $_SESSION['att_table'];
               //$sql = 'SELECT * FROM '.$_SESSION['att_table'].';';
              $sql = "SELECT * FROM $table;";
               $result = mysqli_query($conn, $sql);
               $checkresult = mysqli_num_rows($result);

               if ($checkresult > 0) {
                 while ($row=mysqli_fetch_assoc($result)) {
                   //if ($row['section']==$_SESSION['att_section']) {
                     //echo $row['roll']."<br>";
                     echo "<td>".$row['roll'].'</td>
                     <td><input type="checkbox" style="max-width:100px" class="form-control mx-auto" id="roll" aria-describedby="emailHelp" value='.$row['roll'].' name="roll[]"></td>
                   </tr>';
                   //}
                 }
               }

               $date = date('r');
               echo '<input type="hidden" name="date" value='.$date.'>';

              ?>

         </tbody>
       </table>

       <button type="submit" name="submit" class="btn btn-block btn-success mx-auto" style="max-width:300px"><i class="fas fa-check" style="padding-right: 10px;"></i>Submit Attendance</button>
       </form>

        </div>
        </div>

        <div class="text-center bg-success text-light shadow" style="height: 35px">
        <label class="lead pt-2" style="font-size: 15px">Absent students:</label>
        <input type="text" id="show_count" name="count-checked-checkboxes" value="0" size="60" maxlength="50" class="btn btn-sm btn-outline-success lead text-light" style="width: 40px; height: 20px; padding-bottom: 5px; margin-left: 0px" />
        </div>

  </body>
  <!-- checked count -->
   <script type="text/javascript">
   $(document).ready(function(){

    var $checkboxes = $('#group_1 td input[type="checkbox"]');

    $checkboxes.change(function(){
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        // $('#count-checked-checkboxes').text(countCheckedCheckboxes);

        $('#show_count').val(countCheckedCheckboxes);
    });

  });
   </script>
   <!-- checked count -->
</html>

<?php
  include 'footer.php';
 ?>
