<?php
  // http://localhost/s_infoDisplay.php
  echo "<script>
      document.cookie='alteritem= -1';
      document.cookie='alter= -1';
      </script>";
  
  require_once 'DB.php';
  $conn = DB::connect('mysqli://root:password@localhost/club');
  // $conn = mysqli_connect('localhost','root','19991108','test');
  // *******************
  header("Content-Type:text/html;charset=utf-8");
  $conn->query("set names utf8");
  //$comNo = $_GET['comNo']; 
  $comNo='0001';
  session_start();  
?><!DOCTYPE html>
<html lang="en">
<head>
  <title>社团信息管理</title>
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
  </div> 
</nav>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-3">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="s_infoManage.php">管理社团信息</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="s_manager2_memManage.php">管理社团人员</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <?php
      $q = $conn->query("SELECT * FROM clubinfo where No =".$comNo);
      if (DB::isError($q)) { die("查询失败！ − " . $q->getMessage() . "<br>"); }
      $r = $q->fetchRow();

    ?>
    <div class="col-sm-8">      
      <table class="table table-striped" id="table" cellspacing="0">
        <thead>
          <tr>
            <th>项</th>
            <th>内容</th>
            <th></th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>社团编号</td>
            <td><?php echo $r[0]; ?></td>
            <td>  </td>
          </tr>
          <tr>
            <td>社团名称</td>
            <td><?php echo $r[1]; ?></td>
            <td><button class="btn btn-light" onclick="update(this,2)">修改</button></td>
          </tr>
          <tr>
            <td>社团类型</td>
            <td><?php echo $r[2]; ?></td>
            <td><button class="btn btn-light" onclick="update(this,3)">修改</button></td>
          </tr>
          <tr>
            <td>创建日期</td>
            <td><?php echo $r[3]; ?></td>
            <td><button class="btn btn-light" onclick="update(this,4)">修改</button></td>
          </tr>
          <tr>
            <td>社团负责人</td>
            <td><?php echo $r[4]; ?></td>
            <td><button class="btn btn-light" onclick="update(this,5)">修改</button></td>
          </tr>
          <tr>
            <td>负责人联系方式</td>
            <td><?php echo $r[5]; ?></td>
            <td><button class="btn btn-light" onclick="update(this,6)">修改</button></td>
          </tr>
          <tr>
            <td>部门</td>
            <td><?php echo $r[6]; ?></td>
            <td><button class="btn btn-light" onclick="update(this,7)">修改</button></td>
          </tr>
          <tr>
            <td>社团介绍</td>
            <td><?php echo $r[7]; ?></td>
            <td><button class="btn btn-light" onclick="update(this,8)">修改</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>



<script>
    var item = ['No','clubName','clubType','establishDate','principal','contact','deparment','introduction'];
    var alteritem = "";
    var alter="";
    var sql="";
    function update(obj,x){

      var table = document.getElementById("table");
        var text = table.rows[x].cells[1].innerHTML;
        table.rows[x].cells[1].innerHTML = '<input class="form-control" name="input'+ x + '" type="text" value=""/>';
        var input = document.getElementsByName("input" + x);        
        input[0].value = text;
      
      obj.innerHTML = "确定";
      obj.onclick = function onclick(event) {
                    update_success(this,x);
                      };

   }   

    function update_success(obj,x){
        var arr = [];
        var table = document.getElementById("table");
        var input = document.getElementsByName("input" + x);
        var text = input[0].value;
        arr.push(text);
        alter=text;
        alteritem=item[x-1];          

        //把值赋值给表格，不能在取值的时候给，会打乱input的个数
        table.rows[x].cells[1].innerHTML=alter;
        //回到原来状态

        obj.innerHTML = "修改";
        obj.onclick = function onclick(event) {
                    update(this,x);
                    
                    };
        document.cookie="alteritem="+alteritem;
        document.cookie="alter="+alter;
      }      
        
        // 设置cookie   
    function delcookie(c_name) {                   
        var exdate = new Date();
        exdate.setTime(-1000);  
        document.cookie=c_name + "= -1; expires="+exdate.toUTCString();          
    }
    function getCookie() {
      var cookies = document.cookie;
      var list = cookies.split("; ");          // 解析出名/值对列表
          
      for(var i = 0; i < list.length; i++) {
        var arr = list[i].split("=");          // 解析出名和值
        console.log(arr);
      }
    }
    
</script>
<?php
  $item= '';
  $text= '';
  if(isset($_COOKIE["alteritem"])&& isset($_COOKIE["alter"])){
    if($_COOKIE["alteritem"] !="-1" && $_COOKIE["alter"]!="-1" ){
      $item = $_COOKIE["alteritem"];
      $text = $_COOKIE["alter"];
      $sql="Update clubinfo set ". $item ." = '". $text ."'where No =".$comNo;
      $alter = $conn->query($sql);
      if (DB::isError($alter)) { die("修改失败！ − " . $alter->getMessage() . "<br>");}
    }
  }
   echo "<script>
        delcookie('alteritem'); 
        delcookie('alter'); 
        </script>";

?>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>读万卷书，行万里路</p>
</div>

</body>
</html>
