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
    <title> RAM | Home</title>
    <style>
    .shadow {
      -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
      -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
      box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    }
    </style>
  </head>
  <body>
    <div style="background-color: rgb(241, 244, 244); min-height:500px; padding-bottom:50px">
      <div class="container">

        <h3 class="display-4 text-center" style="padding-top:30px; font-size: 30px;">
          <?php
            echo $_SESSION['user_name'];
           ?>
        </h3>
        <p class="lead text-muted text-center" style="font-size: 15px">Sir, select your operation!</p>
        <hr>

      </div>
        <br>

        <div class="container">

            <div class="row mx-auto">

              <div class="col text-center mt-3">
                <div class="card mx-auto shadow" style="width: 18rem;">
                  <img src="image/Attendance.jpg" style="height:140px; width:180" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Attendance</h5>
                    <p class="card-text text-muted" style="font-size: 10px">Click to take Attendance & the result will be automatically generated in real time!</p>
                    <a href="att_field.php" class="shadow btn btn-success">
                      <i class="fas fa-edit" style="padding-right:5px"></i>
                      Take Attendance</a>
                  </div>
                </div>
              </div>

              <div class="col text-center mt-3">
                <div class="card mx-auto shadow" style="width: 18rem;">
                  <img src="image/result.jpeg" style="height:140px; width:180" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Result</h5>
                    <p class="card-text text-muted" style="font-size: 10px">Realease exam results here & each students will be notified with their own score!</p>
                    <a href="result_fields.php" class="shadow btn btn-success">
                      <i class="fas fa-poll" style="padding-right:5px"></i>
                      Publish result</a>
                  </div>
                </div>
              </div>

              <div class="col text-center mt-3">
                <div class="card mx-auto shadow" style="width: 18rem;">
                  <img src="image/n.jpg" style="height:140px; width:180" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Notice</h5>
                    <p class="card-text text-muted" style="font-size: 10px">Write a notice as a text, sent it & it will be stored & reached to each student instantly!</p>
                    <a href="post_notice.php" class="shadow btn btn-success">
                      <i class="fas fa-bullhorn" style="padding-right:5px"></i>
                      Post a notice</a>
                  </div>
                </div>
              </div>

            </div>

            <br><br><br><br><br>

        </div>

        </div>
      </div>
    </div>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
