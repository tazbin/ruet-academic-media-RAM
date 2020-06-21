<?php
include 'dbh.inc.php';

$dept_name=$_POST['dept_name'];
$dept_code=$_POST['dept_code'];

$sql = "SELECT * FROM dept_series;";
$res = mysqli_query($conn, $sql);
$title = array();

while ($head = mysqli_fetch_field($res)) {
  array_push($title, $head->name);
}

$series = array();

foreach ($title as $key) {

  if (strpos($key, "eries")) {
    //array_push($series, $_POST[$key]);
    $series[$key]=$_POST[$key];
  }
}

$sql = "INSERT INTO dept_series(dept, dept_code) VALUES('$dept_name', $dept_code);";
mysqli_query($conn, $sql);

foreach ($title as $key) {
  if (strpos($key, "eries")) {
    echo $key." ".$_POST[$key]."<br>";
    $st_num = $_POST[$key];
    $sql = "UPDATE dept_series SET $key=$st_num WHERE dept_code=$dept_code;";
    mysqli_query($conn, $sql);

    header("Location: ../admin_page.php?series=added");
  }
}

 ?>
