<!--发布活动处理：将所填信息插入活动表中-->
<?php
  header("content-type: text/html; charset=utf-8");
  require_once 'DB.php';

  //session服务
  session_start();
  $id = $_SESSION['stuID'];
  $cnum = $_SESSION['cnum'];
  //$id = '3017216083';
  //$cnum = '0005';

  //生成活动id
  $anum = md5(time().mt_rand(1,1000000));

  //传值数据
  $aname = $_POST['main'];
  $atime = $_POST['stime'];
  $aplac = $_POST['where'];
  $ps = $_POST['ps'];
  $phone = $_POST['phone'];
  $pname = $_POST['name'];

  //连接数据库
  $d = DB::connect('mysqli://root:password@localhost/club');
  $d->setErrorHandling(PEAR_ERROR_DIE);
  $d->query("SET NAMES utf8");
  //插入之前新的活动表
  $records = $d->query('INSERT INTO Activity VALUES(?,?,?,?,?,?,?,?,?) ',array($anum,$cnum,$aname,$atime,$aplac,$ps,$id,$pname,$phone));

  //完成后跳转
  header("location:s_acti_pub.php");
?>