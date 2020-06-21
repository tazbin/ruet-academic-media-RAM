<?php
ob_start();
session_start();

 function fetch_data()
 {
   $sta_table = $_POST['table'];
      $output = '';
      $conn = mysqli_connect("localhost", "tazbinur_ram", "tazbinur_ram", "tazbinur_ram");
      $sql = "SELECT * FROM $sta_table ORDER BY roll ASC;";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_array($result))
      {
        if ($row['tot_day']==0) {
          $att=100;
        } else {
          $att =  round( ($row['att_day']/$row['tot_day'])*100 , 2);
        }

        if ($att<50) {
          $mark = 1;
        } elseif ($att>=50 && $att<=55) {
          $mark = 2;
        } elseif ($att>=56 && $att<=60) {
          $mark = 3;
        } elseif ($att>=61 && $att<=65) {
          $mark = 4;
        } elseif ($att>=66 && $att<=70) {
          $mark = 5;
        } elseif ($att>=71 && $att<=75) {
          $mark = 6;
        } elseif ($att>=76 && $att<=80) {
          $mark = 7;
        } else{
          $mark=8;
        }
      $output .= '<tr>
                          <td>'.$row["roll"].'</td>
                          <td>'.$row["tot_day"].'</td>
                          <td>'.$row["att_day"].'</td>
                          <td>'.$att.' %</td>
                          <td>'.$mark.'</td>
                          <td>'.$row["ct_1"].'</td>
                          <td>'.$row["ct_2"].'</td>
                          <td>'.$row["ct_3"].'</td>
                          <td>'.$row["ct_4"].'</td>
                     </tr>
                          ';
      }
      return $output;
 }

 if(isset($_POST["generate_pdf"]))
 {
   $sta_table = $_POST['table'];
   $sta_dept = $_POST['dept'];
   $sta_series = $_POST['series'];
   //$sta_course = $_POST['course'];
   $sta_course = $_SESSION['pdf_course'];
   $teacher = $_SESSION['user_name'];

      require_once('tcpdf/tcpdf.php');
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $obj_pdf->SetCreator(PDF_CREATOR);
      $obj_pdf->SetTitle("Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP");
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $obj_pdf->SetDefaultMonospacedFont('helvetica');
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
      $obj_pdf->setPrintHeader(false);
      $obj_pdf->setPrintFooter(false);
      $obj_pdf->SetAutoPageBreak(TRUE, 10);
      $obj_pdf->SetFont('helvetica', '', 11);
      $obj_pdf->AddPage();
      $content = '';
      $content .= '
      <h4 align="center" class="lead">Academic Status of '.$sta_dept.', '.$sta_series.' series for course: '.$sta_course.'</h4><br/><br>
      <table border="1" cellspacing="0" cellpadding="3">
           <tr>
                <th width="15%">Roll</th>
                <th width="10%">Total Day</th>
                <th width="10%">Attended Day</th>
                <th width="15%">Attendance (%)</th>
                <th width="10%">Attendance mark</th>
                <th width="10%">Class Test 1</th>
                <th width="10%">Class Test 2</th>
                <th width="10%">Class Test 3</th>
                <th width="10%">Class Test 4</th>
           </tr>
      ';
      $content .= fetch_data();
      $content .= '</table>';
      $content .= '<br><br><br>';
      $content .= '<text class="lead text-left" style="width: 20%; border-top: 1px solid rgb(10, 10, 10);">Signature<br></text>';
      $content .= $_SESSION['user_name'];
      $content .= '<br><br><br>';
      $today = date("d/m/Y");
      $content .= 'Date: '.$today;
      $obj_pdf->writeHTML($content);
      $obj_pdf->Output(''.$sta_dept.'_'.$sta_series.'_'.$sta_course.'_'.$teacher.'.pdf', 'I');

      //header("Location: show_statistics.php?pdf=generated=downloaded");
      //exit();
 }

 if(isset($_POST["generate_excel"]))
 {
   $sta_table = $_POST['table'];
   $sta_dept = $_POST['dept'];
   $sta_series = $_POST['series'];
   //$sta_course = $_POST['course'];
   $sta_course = $_SESSION['pdf_course'];
   $teacher = $_SESSION['user_name'];

      $content = '';
      $content .= '
      <h4 align="center" class="lead">Academic Status of '.$sta_dept.', '.$sta_series.' series for course: '.$sta_course.'</h4><br/><br>
      <table border="1" cellspacing="0" cellpadding="3">
           <tr>
                <th width="15%">Roll</th>
                <th width="10%">Total Day</th>
                <th width="10%">Attended Day</th>
                <th width="15%">Attendance (%)</th>
                <th width="10%">Attendance mark</th>
                <th width="10%">Class Test 1</th>
                <th width="10%">Class Test 2</th>
                <th width="10%">Class Test 3</th>
                <th width="10%">Class Test 4</th>
           </tr>
      ';
      $content .= fetch_data();
      $content .= '</table>';
      $content .= '<br>';
      $content .= $_SESSION['user_name'];
      $content .= '<br>';
      $today = date("d/m/Y");
      $content .= 'Date: '.$today;

      header("Content-Type: application/xls");
      $filename = $sta_dept.'_'.$sta_series.'_'.$sta_course.'_'.$teacher;
      header("Content-Disposition: attachment; filename=.$filename.xls");
      echo $content;


 }
 ?>
