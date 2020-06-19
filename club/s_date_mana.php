<!--日程管理：所有日程展示，修改，确认-->
<?php
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
  //$d->mysql_set_charset('utf-8');  
  $records = $d->query('SELECT dname,dnum,ps FROM date WHERE pid = ? AND cnum = ?',array($id,$cnum));
  //$records = $d->query('SELECT date.dname,date.dtime,date.dplac,date.ps,datMember.snum FROM date,datMember WHERE datMember.snum = ? AND datMember.dnum=date.dnum',array($id));
  $rows = 0;
  $temp = array();
  while($r = $records->fetchRow()){
      $rows++;
      $temp[] = $r;   // 将查询出来的结果赋给数组$arr
  }
  $res = json_encode($temp);  // 将数组转化为json格式的字符串
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>学生社团管理系统</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../club/css/bootstrap.min.css">
  <link rel="icon" href="../club/images/logo220.png" type="image/x-icon"/>
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
  .fakeimg {
      height: 200px;
      background: #aaa;
  }
  .img {
    background: url("../club/images/logo.jpeg");
    background-size: 100% auto;
    height: 150px;
  }
  </style>
</head>
<body>

<div class="img"></div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">导航</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="HomePage.html">首页</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="s_date_main1.php">个人中心</a>
      </li>
    </ul>
  </div> 
</nav>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-4">
      <h3>个人中心</h3>
      <p></p>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="s_date_main1.php">待完成日程</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="s_date_pub.php">发布日程</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="s_date_mana.php">日程管理</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="s_mem_show.php">社团成员</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="s_acti_pub.php">发布活动</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="s_acti_mana.php">活动管理</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="s_apply_deal.php">申请审批</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="s_jifen_show.php">信用积分</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
      <script>
        var rows = "<?=$rows?>";    //传递php中的数据给js
        var jsonString = '<?php echo $res;?>';  //传递php中的数据给js
    //var jsonString = eval('('+jsonString1+')');
        var jsonObject = JSON.parse(jsonString);     //将json字符串转化为js中的json对象
        for(i = 0;i<rows;i++){
          document.write("<h2>"+jsonObject[i][0]+"</h2>");
          document.write("<p>"+jsonObject[i][2]+"</p>");
          document.write("<div class='btn-group'>");
          document.write("<form method='post' action='s_date_modi.php'>");
          document.write("<input type='hidden' name='dnum'value="+jsonObject[i][1]+">");
          document.write("<input type='submit' class='btn btn-primary' value='修改'/>");
          document.write("</form>");
          document.write("<form method='post' action='s_date_conf.php'>");
          document.write("<input type='hidden' name='dnum'value="+jsonObject[i][1]+">");
          document.write("<input type='submit' class='btn btn-primary' value='结束'/>");
          document.write("</form>");
          document.write("</div>");
          document.write("<br>");
          document.write("<br>");
        }
      </script>
      <br>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p></p>
</div>

</body>
</html>