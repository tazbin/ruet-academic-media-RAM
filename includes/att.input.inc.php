<?php

//date time
date_default_timezone_set('Asia/Dhaka');

$time = date('h').":".date('i')." ".date('a');

$date = date('D').", ".date('d')." ".date('M')." ".date('Y');

$fulldatetime = $date." - ".$time;

//date time

include 'dbh.inc.php';
$a_table = $_SESSION['att_table'];

$track = array();
unset($track);
$track = array();

$sql = "SELECT * FROM $a_table;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck>0) {
  while ($row = mysqli_fetch_assoc($result)) {
  //  if ($row['section']==$_SESSION['att_section']) {

      //updating total day
      $day = 0;
      $day=$row['tot_day']+1;
      //echo $day." ";
      $my_roll = $row['roll'];
      //echo $my_roll."<br>";
      $ami = "UPDATE $a_table SET tot_day=$day WHERE roll=$my_roll;";
      mysqli_query($conn, $ami);

      //updating att day
      $day = 0;
      $day=$row['att_day']+1;
      //array_push($track,$day);
      $track[$my_roll]=$day;

      //echo $day." ";
      //$my_roll = $row['roll'];
      //echo $my_roll."<br>";
      $ami = "UPDATE $a_table SET att_day=$day, last_date='$fulldatetime' WHERE roll=$my_roll;";
      mysqli_query($conn, $ami);

  //  }
  }
}


$sql = "SELECT * from $a_table";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if(isset($_POST['submit'])){//to run PHP script on submit
if(!empty($_POST['roll'])){
// Loop to store and display values of individual checked checkbox.
echo $_SESSION['att_table']." ".$_SESSION['att_section'];
foreach($_POST['roll'] as $selected){
  echo $selected."</br>";

  //updating absent att day
  /*
  if ($row['roll'] == $selected) {
    $day = $row['att_day']-1;
    echo $row['att_day']." ";
  } */

  //echo $day." ";
  $day=$track[$selected]-1;

  $ami = "UPDATE $a_table SET att_day=$day WHERE roll=$selected;";
  echo "updated ";
  mysqli_query($conn, $ami);
      }
    }
  }

//   header("Location: ../teacher_profile.php?attendance=received");
?>
<script type="text/javascript">
  window.location.href = "../teacher_profile.php?attendance=received"
</script>
<?php
  exit();



 ?>
