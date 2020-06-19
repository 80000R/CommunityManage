<?php
  //人员之后的处理
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

  //获取日程编号
  $dnum = $_POST['dnum'];
  //插入日程人员表
  foreach( $_POST['renyuan'] as $i)
  {
    $records = $d->query('SELECT DISTINCT stuName FROM comMember WHERE stuID = ?',array($i));
    $temp = '';
    while($r = $records->fetchRow()){
      $temp = $r;   // 将查询出来的结果赋给数组$arr
    }
    $temp1 = implode(",", $temp);
    $records = $d->query('INSERT INTO datMember VALUES(?,?,?) ',array($dnum,$i,$temp1));
  }

  header("location:s_date_pub.php");
?>