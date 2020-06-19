<?php
  //结束日程之后的处理
  //删除相应记录，会员加分
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

  //删除日程信息
  $records = $d->query('DELETE FROM date WHERE dnum = ?',array($dnum));
  //被选择的未完成人员，直接删除，不加分
  foreach( $_POST['renyuan'] as $i)
  {
    $records = $d->query('DELETE FROM datMember WHERE dnum = ? AND snum = ?',array($dnum,$i));
  }

  //剩下的人员，完成了该日程，先进行加分,再删除
  $records = $d->query('SELECT snum FROM datMember WHERE dnum = ?',array($dnum));
  $temp = '';
  while($r = $records->fetchRow()){
    $temp = implode(",", $r);
    $records1 = $d->query('UPDATE comMember SET memScore = memScore+1 WHERE stuID = ? AND comNumber = ?',array($temp,$cnum));
    $records1 = $d->query('DELETE FROM datMember WHERE dnum = ? AND snum = ?',array($dnum,$temp));
  }

  header("location:s_date_mana.php");
?>