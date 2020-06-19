<!--日程管理：人员修改-->
<?php
  header("content-type: text/html; charset=utf-8");
  require_once 'DB.php';

  //session服务
  session_start();
  $id = $_SESSION['stuID'];
  $cnum = $_SESSION['cnum'];
  //$id = '3017216083';
  //$cnum = '0005';

  //传值数据
  $dname = $_POST['main'];
  $dtime = $_POST['stime'];
  $dplac = $_POST['where'];
  $ps = $_POST['ps'];
  $phone = $_POST['phone'];
  $dnum = $_POST['dnum'];

  //连接数据库
  $d = DB::connect('mysqli://root:password@localhost/club');
  $d->setErrorHandling(PEAR_ERROR_DIE);
  $d->query("SET NAMES utf8");
  //插入之前新的日程表
  $records = $d->query('UPDATE date SET dname = ?,dtime=?,dplac=?,ps=?,phone=? WHERE dnum=? AND cnum=?',array($dname,$dtime,$dplac,$ps,$phone,$dnum,$cnum));
  //$records = $d->query('SELECT date.dname,date.dtime,date.dplac,date.ps,datMember.snum FROM date,datMember WHERE datMember.snum = ? AND datMember.dnum=date.dnum',array($id));

  //筛选可选学生名单
  $records = $d->query('SELECT snum,sname FROM datMember WHERE dnum = ?',array($dnum));
  $rows = 0;
  $temp = array();
  while($r = $records->fetchRow()){
      $rows++;
      $temp[] = $r;   // 将查询出来的结果赋给数组$arr
  }
  $res = json_encode($temp);  // 将数组转化为json格式的字符串

  //筛选可选学生名单
  $records = $d->query('(SELECT stuID,stuName FROM comMember WHERE comNumber=?)EXCEPT(SELECT snum,sname FROM datMember WHERE dnum = ?)',array($cnum,$dnum));
  $rows1 = 0;
  $temp1 = array();
  while($r = $records->fetchRow()){
      $rows1++;
      $temp1[] = $r;   // 将查询出来的结果赋给数组$arr
  }
  $res1 = json_encode($temp1);  // 将数组转化为json格式的字符串
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
      <h2>人员修改</h2>
      <p>请对需要参加该日程的成员进行修改</p>
      <form method='post' action="s_date_modi_ren_deal.php">
        <input type="hidden" name="dnum" value=<?php echo $dnum?>>
        <script>
          var rows = "<?=$rows?>";    //传递php中的数据给js
          var jsonString = '<?php echo $res;?>';  //传递php中的数据给js
          //var jsonString = eval('('+jsonString1+')');
          var jsonObject = JSON.parse(jsonString);     //将json字符串转化为js中的json对象
          for(i = 0;i<rows;i++){
            document.write("<div class='form-check'>");
            document.write("<label class='form-check-label'>");
            document.write("<input type='checkbox' class='form-check-input' checked='checked' name = renyuan[] value='"+jsonObject[i][0]+"'>"+jsonObject[i][1]+" "+jsonObject[i][0]);
            document.write("</label>");
            document.write("</div>");
          }
          var rows = "<?=$rows1?>";    //传递php中的数据给js
          var jsonString = '<?php echo $res1;?>';  //传递php中的数据给js
          //var jsonString = eval('('+jsonString1+')');
          var jsonObject = JSON.parse(jsonString);     //将json字符串转化为js中的json对象
          for(i = 0;i<rows;i++){
            document.write("<div class='form-check'>");
            document.write("<label class='form-check-label'>");
            document.write("<input type='checkbox' class='form-check-input' name = renyuan[] value='"+jsonObject[i][0]+"'>"+jsonObject[i][1]+" "+jsonObject[i][0]);
            document.write("</label>");
            document.write("</div>");
          }
        </script>
        <!--div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" value="">欧梦玲
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" checked="checked" value="">任艺丹
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" value="">童跃凡
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" checked="checked" value="">王一婷
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" value="">郑逸楠
          </label>
        </div-->
        <br>
        <button type="submit" class="btn btn-primary">提交</button>
      </form>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p></p>
</div>

</body>
</html>