<?php
  header("content-type: text/html; charset=utf-8");
  require_once 'DB.php';

  //session服务
  session_start();
  $id = $_SESSION['stuID'];
  $cnum = $_SESSION['cnum'];
  //$id = '3017216083';
  //$cnum = '0005';
  
  //传值数据
  $aname = $_POST['main'];
  $atime = $_POST['stime'];
  $aplac = $_POST['where'];
  $ps = $_POST['ps'];
  $phone = $_POST['phone'];
  $anum = $_POST['anum'];
  $pname = $_POST['name'];

  //连接数据库
  $d = DB::connect('mysqli://root:password@localhost/club');
  $d->setErrorHandling(PEAR_ERROR_DIE);
  $d->query("SET NAMES utf8");
  //插入之前新的日程表
  $records = $d->query('UPDATE Activity SET actName = ?,actTime=?,actPlace=?,actContent=?,resStuName=?,resContact=? WHERE actID=? AND comNumber=?',array($aname,$atime,$aplac,$ps,$pname,$phone,$anum,$cnum));

  header("location:s_acti_mana.php");
?>