<?php

include 'dbh.inc.php';


  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array( 'jpg', 'jpeg', 'png', 'pdf', 'pptx', 'zip' );

  if ( in_array($fileActualExt, $allowed) ) {
    if ( $fileError === 0 ) {
      $newFilename = uniqid('',true).".".$fileActualExt;
      $fileDestination = '../uploads/'.$fileName;

      move_uploaded_file($fileTmpName, $fileDestination);
      echo "uploaded";

    } else{
      echo "error file uploading";
    }
  } else{
    echo "no file";
  }

  //echo $filename;


 ?>
