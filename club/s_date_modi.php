<!--日程管理：具体信息修改-->
<?php
  header("content-type: text/html; charset=utf-8");
  require_once 'DB.php';

  //session服务
  session_start();
  $id = $_SESSION['stuID'];
  $cnum = $_SESSION['cnum'];
  //$id = '3017216083';
  //$cnum = '0005';

  //获取当前处理的日程编号
  $dnum = $_POST['dnum'];

  //连接数据库
  $d = DB::connect('mysqli://root:password@localhost/club');
  $d->setErrorHandling(PEAR_ERROR_DIE);
  $d->query("SET NAMES utf8");
  $records = $d->query('SELECT dname,dtime,dplac,ps,phone FROM date WHERE dnum = ? AND cnum = ?',array($dnum,$cnum));
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
      <h3>日程信息</h3>
      <p>请按提示填写想要发布的日程信息</p>
      <form method='post' action="s_date_modi_ren.php">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">时间</span>
          </div>
          <input type="text" class="form-control" placeholder="Time" id="stime" name="stime" value="">
          <script language="javascript">
            var rows = "<?=$rows?>";    //传递php中的数据给js
            var jsonString = '<?php echo $res;?>';  //传递php中的数据给js
        //var jsonString = eval('('+jsonString1+')');
            var jsonObject = JSON.parse(jsonString);     //将json字符串转化为js中的json对象
            //document.getElementByld("#stime").value = jsonObject[0][1];
            //document.write("<h>"+jsonObject[0][1]+"</h>");
            $('#stime').val(jsonObject[0][1]);
          </script>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">地点</span>
          </div>
          <input type="text" class="form-control" placeholder="Place" id="where" name="where">
          <script language="javascript">
            //document.getElementByld("where").value = "2020-03-24 14:00";
            $('#where').val(jsonObject[0][2]);
          </script>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">主题</span>
          </div>
          <input type="text" class="form-control" placeholder="Theme" id="main" name="main">
          <script language="javascript">
            //document.getElementByld("stime").value = "2020-03-24 14:00";
            $('#main').val(jsonObject[0][0]);
          </script>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">备注</span>
          </div>
          <input type="text" class="form-control" placeholder="Remarks" id="ps" name="ps">
          <script language="javascript">
            //document.getElementByld("stime").value = "2020-03-24 14:00";
            $('#ps').val(jsonObject[0][3]);
          </script>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">联系方式</span>
          </div>
          <input type="text" class="form-control" placeholder="Contact Information" id="phone" name="phone">
          <script language="javascript">
            //document.getElementByld("stime").value = "2020-03-24 14:00";
            $('#phone').val(jsonObject[0][4]);
          </script>
        </div>

        <input type="hidden" name = "dnum" value=<?php echo $dnum?>>

        <input type="submit" class="btn btn-primary" value="修改人员"/>
      </form>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p></p>
</div>

</body>
</html>