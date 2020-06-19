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

<?php 
  require_once 'DB.php';
  $conn = DB::connect('mysqli://root:password@localhost/club');
  $conn->query("set names utf8"); 

  // 不知道阿凡现在是怎么传值的，这里先写成固定的，之后改这里就可以了
  session_start();
  // $post_comCode = $_SESSION['comCode'];
  $post_comCode = $_SESSION['cnum'];

  $sql_select_comName = $conn->query("SELECT clubName FROM clubinfo WHERE No='$post_comCode'");
  $r = $sql_select_comName->fetchRow();
  $comName = $r[0];

  // 这是最开始那种不加图片的顶部的代码
  // $div = "<div class='jumbotron text-center' style='margin-bottom:0'>
  //           <h1>$comName</h1>
  //         </div>";
  // echo $div;
?>

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
          <a class="nav-link active" href="s_apply_deal.php">申请审批</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="s_jifen_show.php">信用积分</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    
    <div class="col-sm-8">
      <nav class="navbar bg-light">
        <ul class="navbar-nav">
          <?php
            $sql_select_applyinfo = $conn->query("SELECT * FROM comApply WHERE community='$comName' AND status='N'");

            if (!$sql_select_applyinfo) {
              $div = "<div>暂无人申请</div>";
              echo $div;
            }
            else{
              $res_select_applyinfo = [];
              $count_select_applyinfo = 0;
              while($r=$sql_select_applyinfo->fetchRow()){
                $count_select_applyinfo++;      
                $res_select_applyinfo[] = $r; 
              }

              $table = "<table id='table' class='table table-hover table-sm'>";
              $table .= "<tr><td>学号</td><td>姓名</td><td>性别</td><td>联系方式</td><td>学院</td><td>专业</td><td>申请部门</td><td></td><td></td></tr>";
              for($applyinfo_i=0;$applyinfo_i<$count_select_applyinfo;$applyinfo_i++){
                $row = $res_select_applyinfo[$applyinfo_i];               
                $stuID = $row[2];   
                $stuName = $row[0]; 
                $gender = $row[1];
                $phone = $row[3];
                $institute = $row[4];
                $major = $row[5];
                $dept = $row[7];
                $table.="<tr>";
                $table.="<td>$stuID</td>";
                $table.="<td>$stuName</td>";
                $table.="<td>$gender</td>";
                $table.="<td>$phone</td>";
                $table.="<td>$institute</td>";
                $table.="<td>$major</td>";
                $table.="<td>$dept</td>";
                $table.="<td><button onclick='agree()' class='btn btn-success'>同意</button></td>";
                $table.="<td><button onclick='reject()' class='btn btn-danger'>拒绝</button></td>";
                $table.="</tr>";                     
              }
              $table.="</table>";
              echo $table;
              ob_start(); 
            }  
          ?>

          <script>
              function agree() {
                  var tab = document.getElementById("table");
                  var tr = tab.getElementsByTagName("tr");
                  for (var i = 0; i < tr.length; i++)tr[i].onclick = function () {
                      var thisTR = this.innerHTML;                //所点击的一行内容
                      var apply_stuID = $(this).children().eq(0).text();  
                      var apply_stuName = $(this).children().eq(1).text();  
                      var apply_dept = $(this).children().eq(6).text();
          
                      document.cookie="apply_stuID="+apply_stuID;
                      document.cookie="apply_stuName="+apply_stuName;
                      document.cookie="apply_dept="+apply_dept;
                      document.cookie="apply_status=Y";
                      window.location.reload();
                  }
              }
              function reject() {
                  var tab = document.getElementById("table");
                  var tr = tab.getElementsByTagName("tr");
                  for (var i = 0; i < tr.length; i++)tr[i].onclick = function () {
                      var thisTR = this.innerHTML;                //所点击的一行内容
                      var apply_stuID = $(this).children().eq(0).text();  
                      var apply_stuName = $(this).children().eq(1).text();  
                      var apply_dept = $(this).children().eq(6).text();
                     
                      document.cookie="apply_stuID="+apply_stuID;
                      document.cookie="apply_stuName="+apply_stuName;
                      document.cookie="apply_dept="+apply_dept;
                      document.cookie="apply_status=R";
                      window.location.reload();
                  }
              }              
          </script>

          <?php
            $apply_stuID = '';
            $apply_dept = '';
            $apply_community = '';
            $apply_status = '';
            if (isset($_COOKIE["apply_stuID"]) && isset($_COOKIE["apply_dept"]) && isset($_COOKIE["apply_status"])){
              $apply_stuID = $_COOKIE["apply_stuID"];
              $apply_stuName = $_COOKIE["apply_stuName"];
              $apply_dept = $_COOKIE["apply_dept"];
              $apply_status = $_COOKIE["apply_status"];

              // 更新学生的申请状态
              $sql_update_apply_status = $conn->query("UPDATE comApply SET status='$apply_status' WHERE stuID='$apply_stuID' AND community='$comName' AND dept='$apply_dept'");
              if ($apply_status=='Y') {
                echo"<script>alert('已同意 $apply_stuName 加入社团');window.location.reload();</script>";
              }
              else{
                echo"<script>alert('已拒绝 $apply_stuName 加入社团');window.location.reload();</script>";
              }
              setcookie("apply_stuID");
              setcookie("apply_stuName");
              setcookie("apply_dept");
              setcookie("apply_status");
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