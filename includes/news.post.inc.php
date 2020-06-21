<?php

include 'dbh.inc.php';

date_default_timezone_set('Asia/Dhaka');

$time = date('h').":".date('i')." ".date('a');

$date = date('D').", ".date('d')." ".date('M')." ".date('Y');

$fulldate = $date." - ".$time;


if (isset($_POST['post_news'])) {

  $title = $_POST['title'];
  $text = $_POST['text'];

  if ( empty($title) || empty($text) ) {
    header("Location: ../post_news.php?news=empty");
    exit();
  }

  else{

    $sql = "INSERT INTO news( title, text, date ) VALUES( '$title', '$text', '$fulldate' );";
    mysqli_query($conn, $sql);

    header("Location: ../news.php?success");
    exit();

  }
}

if ( isset($_POST['delete']) ) {
    $id = $_POST['id'];

    $sql = "DELETE FROM news WHERE id=$id;";
    mysqli_query($conn, $sql);

    header("Location: ../news.php");
    exit();

}


 ?>
