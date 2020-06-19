<!--展示社团成员-->
<?php
  header("content-type: text/html; charset=utf-8");
  require_once 'DB.php';

  //获取传值
  //$id = $_GET['studentID'];
  //$cnum = $_GET['comNumber'];
  //$id = '3017216083';
  //$cnum = '0005';
  //session服务
  session_start();
  //$_SESSION['stuID'] = $id;
  //$_SESSION['cnum'] = $cnum;
  $post_stuID = $_SESSION['stuID'];
  $post_comCode = $_SESSION['cnum'];
  //$post_comCode = '0005';
  //$post_stuID = '3017216083';

  //连接数据库
  $conn = DB::connect('mysqli://root:password@localhost/club');
  $conn->query("set names utf8"); 

  $sql_select_comName = $conn->query("SELECT clubName FROM clubinfo WHERE No='$post_comCode'");
  $r = $sql_select_comName->fetchRow();
  $comName = $r[0];
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
          <a class="nav-link" href="s_date_mana.php">日程管理</a>
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
          <a class="nav-link active" href="s_apply_deal.php">信用积分</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
    <!-- 显示成员积分 -->
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">你的信用积分</h4>
            <?php
              $records = $conn->query("SELECT * FROM comMember WHERE stuID='$post_stuID' AND comNumber='$post_comCode'");
              $r = $records->fetchRow();
              $h2 = "<h2 class='text-center'>";
              $h2.= $r[7];
              $h2.= "</h2>";
              echo $h2; 
            ?>
          <p class="card-text">再接再厉</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p></p>
</div>

</body>
</html>