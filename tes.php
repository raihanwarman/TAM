<?php
  $month = date('d');
  $periode = ceil($month / 10);
  echo "Tanggal = " . date("d").' periode = '.$periode;
  $timezone = date("Y-m-d H:i:s");
  echo "<br> The current server timezone is: " . $timezone;
?>
