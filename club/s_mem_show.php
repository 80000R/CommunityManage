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
          <a class="nav-link active" href="s_mem_show.php">社团成员</a>
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
        <!-- 显示社团成员 -->
        <nav class="navbar bg-light">
          <ul class="navbar-nav">
            <?php            
              // 统计对应社团的部门
              $sql_select_dep = $conn->query("SELECT distinct depName FROM comMember WHERE comNumber='$post_comCode'");
              $res_select_dep = [];
              $count_select_dep = 0;
              while($r=$sql_select_dep->fetchRow()){
                $count_select_dep++;      
                $res_select_dep[] = $r; 
              }

              for($dep_i=0;$dep_i<$count_select_dep;$dep_i++){
                // 循环打印每个部门
                $res_select_mem = []; // 不加这一句每次查询的结果会叠加到上一次的上
                $dep_row = $res_select_dep[$dep_i];
                $department = $dep_row[0];
                $li = "<li class='nav-item dropdown'>";
                $li.= "<a class='nav-link dropdown-toggle' href='#' id='navbardrop' data-toggle='dropdown'>$department</a>";
                $li.= "<div class='dropdown-menu'>";
                
                // 统计每个部门的部员
                $sql_select_mem = $conn->query("SELECT * FROM comMember WHERE comNumber='$post_comCode' AND depName='$department'");
                $count_select_mem = 0;
                // while($r = $sql_select_mem->fetchRow()){
                while($r=$sql_select_mem->fetchRow()){
                  $count_select_mem++;      // 计算对应社团的总人数
                  $res_select_mem[] = $r; // temp中保存查询的结果
                }

                // 循环打印每个部门的部员表
                $table = "<table class='table'>";
                $table .= "<tr><td>学号</td><td>姓名</td><td>职位</td></tr>";
                for($i=0;$i<$count_select_mem;$i++){
                  $row = $res_select_mem[$i];   // 遍历temp的每一行
                  $stuID = $row[3];   // 学号
                  $stuName = $row[4]; // 姓名
                  $position = $row[5];// 职位
                  $table.="<tr'>";
                  $table.="<td>$stuID</td>";
                  $table.="<td>$stuName</td>";
                  $table.="<td>$position</td>";
                  $table.="</tr>";
                }
                $table.="</table>";
                $li.= "$table";
                $li.= "</div></li>";
                echo $li;                     
              }
            ?>
          </ul>
        </nav>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p></p>
</div>

</body>
</html>