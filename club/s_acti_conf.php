<?php
  //结束活动之后的处理
  header("content-type: text/html; charset=utf-8");
  require_once 'DB.php';

  //session服务
  session_start();
  $id = $_SESSION['stuID'];
  $cnum = $_SESSION['cnum'];
  //$id = '3017216083';
  //$cnum = '0005';

  //连接数据库
  $d = DB::connect('mysqli://root:password@localhost/club');
  $d->setErrorHandling(PEAR_ERROR_DIE);
  $d->query("SET NAMES utf8");

  //获取活动编号
  $anum = $_POST['anum'];

  //删除活动信息
  $records = $d->query('DELETE FROM Activity WHERE actID = ?',array($anum));

  //完成，跳转
  header("location:s_acti_mana.php");
?>