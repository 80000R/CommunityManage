<!DOCTYPE html>
<html>
<head>
  <title>社团个人中心</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../club/css/bootstrap.min.css">
  <link rel="icon" href="../club/images/logo220.png" type="image/x-icon"/>
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  td{
  width:160px;
  overflow: hidden;
  text-overflow:ellipsis;
  text-align: center;
  }
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
  </div> 
</nav>
<?php
  require_once 'DB.php';
  $conn = DB::connect('mysqli://root:password@localhost/club');
  $conn->query("set names utf8"); 

  // session_start();
  $post_comCode = $_GET['comNumber'];
  $post_stuID = $_GET['studentID'];
  $sql_select_comName = $conn->query("SELECT clubName FROM clubinfo WHERE No='$post_comCode'");
  $r = $sql_select_comName->fetchRow();
  $comName = $r[0];
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-3">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#menu1">待完成日程</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#menu2">社团成员</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#menu3">信用积分</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>  

    <div class="col-sm-6 offset-md-1">
      <div class="tab-content">
        <!-- 显示未完成日程 -->
        <div id="menu1"  class="tab-pane active">                 
          <?php
            $sql_select_dnum = $conn->query("SELECT DISTINCT DM.dnum FROM datmember DM, date D WHERE DM.snum='$post_stuID' AND D.cnum='$post_comCode'");
            $res_select_dnum = [];
            $count_select_dnum = 0;
            while($r=$sql_select_dnum->fetchRow()){
              $count_select_dnum++;      
              $res_select_dnum[] = $r; 
            }

            $card = "";
            for($dnum_i=0;$dnum_i<$count_select_dnum;$dnum_i++){
              // 根据日程编号在日程表中找到对应的日程
              $this_dnum = $res_select_dnum[$dnum_i][0];
              $sql_select_date = $conn->query("SELECT * FROM date WHERE dnum='$this_dnum'");
              $this_date = $sql_select_date->fetchRow();

              $dname = $this_date[2];
              $dtime = $this_date[3];
              $dplac = $this_date[4];
              $ps = $this_date[5];
              $pid = $this_date[6];
              $phone = $this_date[7];

              $date_row = $res_select_dnum[$dnum_i];
              $card.= "<div class='card bg-light text-dark'>";
              $card.= "<div class='card-body'>";
              $card.= "<h4 class='card-title'>$dname</h4>";
              $card.= "<p  class='text-info'>$ps</p>";
              $card.= "<p class='text-right'>时间: $dtime</p>";
              $card.= "<p class='text-right'>地点: $dplac</p>";
              $card.= "<p  class='text-right'>日程发起人: $pid (如有问题请联系$phone)</p>";
              $card.= "</div></div><br>";
            }
            echo $card;
          ?>
        </div>

        <!-- 显示社团成员 -->
        <div id="menu2" class="tab-pane fade"><br>
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

        <!-- 显示积分 -->
        <div id="menu3" class="tab-pane fade"><br>
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
  </div>
</div>
    
</body>
</html>