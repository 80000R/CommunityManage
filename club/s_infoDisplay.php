<?php
  // http://localhost/s_infoDisplay.php
  
  require_once 'DB.php';
  $conn = DB::connect('mysqli://root:password@localhost/club');
  // $conn = mysqli_connect('localhost','root','19991108','test');
  // *******************
  header("Content-Type:text/html;charset=utf-8");
  $conn->query("set names utf8"); 
  session_start();  
?>

<html>
<head>
    <meta charset="utf-8">
    <title>社团简介</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../club/css/Community.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" href="../club/images/logo220.png" type="image/x-icon"/>
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<!--nav class="navbar navbar-expand-sm bg-purple navbar-dark">
  <a class="navbar-brand" href="#">社团列表</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">登录</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">论坛</a>
      </li>    
    </ul>
  </div>  
</nav-->
<nav class="navbar navbar-expand-sm bg-purple navbar-dark"style="left:620px;">
  
  <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button-->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="s_infoDisplay.php">社团</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="s_main_acti.php">活动</a>
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

<?php
$sql_select_cominfo = $conn->query("SELECT * FROM clubinfo");
  while($r=$sql_select_cominfo->fetchRow()){
?>
<div class="box">
  <form action="#" method="post" enctype="multipart/form-data">
        <h2><?php echo $r[1];?></h2>
        <div class="inputBox">
          
          <label>
            社团编号：
          <?php echo $r[0];echo '<br>';?>
            社团类型：
          <?php echo $r[2];echo '<br>';?>

            成立日期：
          <?php echo $r[3];echo '<br>';?>

            社团简介：
          <?php echo $r[7];echo '<br>';?>

            部门分布：
          <?php echo $r[6];echo '<br>';?>
            社团负责人：
          <?php echo $r[4];echo '<br>';?>
            负责人联系方式：
          <?php echo $r[5];echo '<br>';?>
          </label>
          </div>
    </form>
</div>
<?php }?>
</body>
