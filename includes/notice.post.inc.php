<?php

include 'login.inc.php';

date_default_timezone_set('Asia/Dhaka');

$time = date('h').":".date('i')." ".date('a');

$date = date('D').", ".date('d')." ".date('M')." ".date('Y');

$fulldate = $date." - ".$time;

$subject = $_POST['subject'];
$notice = $_POST['notice'];
$sender = $_SESSION['user_mail'];
$receiver = $_POST['receiver'];

if (isset($_POST['post_notice'])) {
  if (empty($subject) || empty($notice) || strpos($receiver, "ne")) {
    // header("Location: ../post_notice.php?notice=empty");
    ?>
<script type="text/javascript">
  window.location.href = "../post_notice.php?notice=empty"
</script>
<?php
    exit();
  }

  else{

      $file = $_FILES['file'];

      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = array( 'jpg', 'jpeg', 'png', 'pdf', 'pptx', 'zip', 'txt' );

      if ( in_array($fileActualExt, $allowed) ) {
        if ( $fileError === 0 ) {
          $newFilename = uniqid('',true).".".$fileActualExt;
          $fileDestination = '../uploads/'.$fileName;

          move_uploaded_file($fileTmpName, $fileDestination);
          echo "uploaded";

          $sql = "INSERT INTO notice(notice_date, notice_subject, notice_text, sender, receiver, is_file, file_name) VALUES( '$fulldate','$subject','$notice','$sender','$receiver', 1, '$fileName');";
          mysqli_query($conn, $sql);

        // header("Location: ../teacher_profile.php?notice=sent");
            ?>
        <script type="text/javascript">
          window.location.href = "../teacher_profile.php?notice=sent"
        </script>
        <?php
        exit();

        } else{
          echo "error file uploading";
        }
      } else{
        echo "no file";
      }

      $sql = "INSERT INTO notice(notice_date, notice_subject, notice_text, sender, receiver) VALUES('$fulldate','$subject','$notice','$sender','$receiver');";
      mysqli_query($conn, $sql);

    // header("Location: ../teacher_profile.php?notice=sent");
    ?>
        <script type="text/javascript">
          window.location.href = "../teacher_profile.php?notice=sent"
        </script>
        <?php
    exit();
  }
}

if (isset($_POST['delete'])) {
  $notice_id = $_POST['id'];

  $sql = "SELECT is_file, file_name FROM notice WHERE notice_id=$notice_id";
  $result = mysqli_query($conn, $sql);
  $check_result = mysqli_num_rows($result);

  if ($check_result>0) {
    while ($row = mysqli_fetch_assoc($result)) {

      if ($row['is_file'] == 1) {
        $path = "../uploads/".$row['file_name'];
        unlink($path);
      }
    }
  }

  $sql = "DELETE FROM notice WHERE notice_id=$notice_id;";
  mysqli_query($conn, $sql);

//   header("Location: ../manage_notice.php?notice=deleted");
?>
        <script type="text/javascript">
          window.location.href = "../manage_notice.php?notice=deleted"
        </script>
        <?php
  exit();

}


 ?>
