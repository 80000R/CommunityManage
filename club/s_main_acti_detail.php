<?php
  header("content-type: text/html; charset=utf-8");
  require_once 'DB.php';

  //session服务
  session_start();

  //获取活动编号
  $anum = $_POST['anum'];

  //连接数据库
  $d = DB::connect('mysqli://root:password@localhost/club');
  $d->setErrorHandling(PEAR_ERROR_DIE);
  $d->query("SET NAMES utf8");
  //$d->mysql_set_charset('utf-8');  
  $records = $d->query('SELECT clubinfo.clubName,Activity.actName,Activity.actTime,Activity.actPlace,Activity.resStuName,Activity.resContact FROM Activity,clubinfo WHERE Activity.comNumber = clubinfo.No AND Activity.actID=?',array($anum));
  
  //$records = $d->query('SELECT date.dname,date.dtime,date.dplac,date.ps,datMember.snum FROM date,datMember WHERE datMember.snum = ? AND datMember.dnum=date.dnum',array($id));
  $rows = 0;
  $temp = array();
  while($r = $records->fetchRow()){
      $rows++;
      $temp[] = $r;   // 将查询出来的结果赋给数组$arr
  }
  $res = json_encode($temp);  // 将数组转化为json格式的字符串
?>

<html>
<head>
    <meta charset="utf-8">
    <title>社团管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../club/css/Community.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" href="../images/logo220.png" type="image/x-icon"/>
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<style>
    .box{
    left:23%;
    }
</style>

<nav class="navbar navbar-expand-sm bg-purple navbar-dark"style="left:620px;">
  
  <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button-->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="s_main_acti.php">活动</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="s_infoDisplay.php">社团</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="HomePage.html">首页</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">登录</a>
      </li>
    </ul>
  </div>  
</nav>

<!--form action="s_main_acmore.php">
  <h4 class="text-center" >主持人大赛
    <small>
      <span style='white-space:pre;'>    社团：北洋之声    </span>
      <span style='white-space:pre;'>开始时间：2020-03-24    </span-->
      <!--a href="s_main_acmore.php" color:#000 >>></a-->
      <!--button type="submit" class="btn">>></button>
    </small>
  </h4>
</form-->

<div class="box">
  <script>
    var rows = "<?=$rows?>";    //传递php中的数据给js
    var jsonString = '<?php echo $res;?>';  //传递php中的数据给js
    //var jsonString = eval('('+jsonString1+')');
    var jsonObject = JSON.parse(jsonString);     //将json字符串转化为js中的json对象
    for(i = 0;i<rows;i++){
      document.write("<h2>"+jsonObject[i][1]+"</h3>");
      document.write("<h3 class='text-center'>"+"社团："+jsonObject[i][0]+"</h3>");
      document.write("<h6 class='text-center'>");
      document.write("<span class='text-white' style='white-space:pre;'>"+"活动地点："+jsonObject[i][3]+"    "+"</span>");
      document.write("<span class='text-white' style='white-space:pre;'>"+"时间："+jsonObject[i][2]+"    "+"</span>");
      document.write("</h6>");
      document.write("<h6 class='text-center'>");
      document.write("<span class='text-white' style='white-space:pre;'>"+"活动负责人："+jsonObject[i][4]+"    "+"</span>");
      document.write("<span class='text-white' style='white-space:pre;'>"+"联系方式："+jsonObject[i][5]+"    "+"</span>");
      document.write("</h6>");
      //document.write("<p class='text-light'>"+jsonObject[i][4]+"</p>");
      //document.write("<p class='text-light'>"+天津大学+"</p>");
      document.write("<br>");
      //ocument.write("<form method='post' action='s_main_acti.php'>");
      //document.write("<center><input type='submit' class='btn btn-outline-secondary' value='返回'/></center>");
      //document.write("</form>");
    }
  </script>
  <?php
    $records1 = $d->query('SELECT clubinfo.clubName,Activity.actName,Activity.actTime,Activity.actPlace,Activity.actContent,Activity.resStuName,Activity.resContact FROM Activity,clubinfo WHERE Activity.comNumber = clubinfo.No AND Activity.actID=?',array($anum));
  while($r1 = $records1->fetchRow()){
  ?>
  <p class='text-light'><?php echo $r1[4];?></p>
  <form method='post' action='s_main_acti.php'>
  <center><input type='submit' class='btn btn-outline-secondary' value='返回'/></center>"
  </form>
  <?php }?>
  <!--form action="#" method="post" enctype="multipart/form-data">
    <script>
      
    </script>
    <h2>北洋大讲堂</h3>
    <h3 class="text-center"> 社团：青年文化促进协会</h3>
    <h6 class="text-center">
      <span class="text-white" style='white-space:pre;'>活动地点：45b216    </span>
      <span class="text-white" style='white-space:pre;'>开始时间：2020-04-22    </span>
    </h6>
    <h6 class="text-center">
      <span class="text-white" style='white-space:pre;'>活动负责人：任艺丹    </span>
      <span class="text-white" style='white-space:pre;'>联系方式：10086    </span>
    </h6>
    <p class="text-light">天津大学北洋艺术团成立于1985年，是我国成立最早的高校大型综合学生艺术团体。目前已经发展成为全国高校中艺术形式多样且有着丰富参演、组织大型晚会和直播节目经验的优秀学生艺术团体。北洋艺术团下设北洋合唱团、交响乐团、民乐团、军乐团、舞蹈团、曲艺话剧团、越剧艺术研究会、演出中心和艺术爱好者协会9个团队组织。黄飞立、徐新、马革顺、盛中国、永儒布、丁乙留、张培豫等国际知名音乐家30余人曾先后担任艺术团指导教师，使艺术团成为一支体系成熟、制度规范的队伍。</p>
    </form-->
</div>
</body>