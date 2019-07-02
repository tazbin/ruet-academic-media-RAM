<?php

date_default_timezone_set('Asia/Dhaka');

$time = date('h').":".date('i')." ".date('a');

$date = date('D').", ".date('d')." ".date('M')." ".date('Y');

$fulldatetime = $date." - ".$time;

echo $fulldatetime;

 ?>
