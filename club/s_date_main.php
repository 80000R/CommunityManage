<?php
  //获取传值
  $id = $_GET['studentID'];
  $cnum = $_GET['comNumber'];
  //$id = '3017216083';
  //$cnum = '0005';
  //session服务
  session_start();
  $_SESSION['stuID'] = $id;
  $_SESSION['cnum'] = $cnum;

  header("location:s_date_main1.php");
?>