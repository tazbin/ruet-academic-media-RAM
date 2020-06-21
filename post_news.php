<?php
  include 'header.php';

  if ( $_SESSION['status']!="admin"  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | News</title>
  </head>
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }
  </style>
  <body style="background-color:rgb(244, 245, 245);">
    <div style="min-height:500px; padding-bottom:50px">
      <div class="container">
        <p class="lead text-center" style="margin-top: 30px;"><i class="far fa-newspaper" style="padding-right: 5px;"></i> Posting news</p>
        <hr>
      </div>

        <div class="container">
          <form class="mx-auto pb-3 pt-2" action="includes/news.post.inc.php" method="post" style="max-width:400px;">
            <div class="form-group">
              <input type="text" class="form-control shadow" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" placeholder="News title">
            </div>

            <textarea class="form-control shadow" id="exampleFormControlTextarea1" name="text" rows="8" placeholder="Write news here"></textarea>
            <button type="submit" class="shadow btn btn-sm btn-block btn-success" name="post_news" style="margin-top:20px">
              <i class="fas fa-location-arrow" style="padding-right:5px"></i>
              Post news</button>
          </form>
          <?php
          $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if (strpos($fullURL, "empty")) {
              echo '<p class="text-danger text-center">Fill up all fields!</p>';
            }

            else if (strpos($fullURL, "sent")) {
              echo '<p class="text-success text-center">Notice posted!</p>';
            }
           ?>
           <br>
        </div>

        </div>

        </div>
      </div>
    </div>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
