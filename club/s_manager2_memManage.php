<!DOCTYPE html>
<html lang="en">
<head>
  <title>社团人员管理</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../club/css/bootstrap.min.css">
  <link rel="icon" href="../images/logo220.png" type="image/x-icon"/>
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
  echo "<script>
      document.cookie='comNumber= -1';
      document.cookie='stuID= -1';
      document.cookie='position= -1';
      document.cookie='power= -1';
      </script>";
  require_once 'DB.php';
  $conn = DB::connect('mysqli://root:password@localhost/club');
  $conn->query("set names utf8"); 
  session_start();
  //$post_comCode = $_GET['comNo']; //合并之后用这句传值，下面那一句注释掉 
  $post_comCode='0001';
  $sql_select_comName = $conn->query("SELECT clubName FROM clubinfo WHERE No='$post_comCode'");
  $r = $sql_select_comName->fetchRow();
  $comName = $r[0];
  $sql_select_applyinfo = $conn->query("SELECT * FROM comApply WHERE community='$comName' AND status='Y'");
  if ($sql_select_applyinfo) {
    $res_select_applyinfo = [];
    $count_select_applyinfo = 0;

    while($r=$sql_select_applyinfo->fetchRow()){
      $count_select_applyinfo++;
      $res_select_applyinfo[] = $r;
      
    }
    for($applyinfo_i=0;$applyinfo_i<$count_select_applyinfo;$applyinfo_i++){
      $row = $res_select_applyinfo[$applyinfo_i];               
      $stuNo = $row[2];  
      
      $stuName = $row[0]; 
      
      $gender = $row[1];
      $phone = $row[3];
      $institute = $row[4];
      $major = $row[5];
      $community=$row[6];
      $dept = $row[7];
    
      $post="部员";
      $stat=3;
      $score=0;
      $sql_check=$conn->query("SELECT * FROM comMember where comNumber = '".$post_comCode."' and stuID='".$stuNo."' ");
      $check=$sql_check->fetchRow();

      if(!$check){
        $sql_add_mem = $conn->query("INSERT INTO `commember`(`comNumber`, `comName`, `depName`, `stuID`, `stuName`, `memPosition`, `memPower`, `memScore`) VALUES ('$post_comCode','$community','$dept','$stuNo','$stuName','$post','$stat','$score')");
        if (DB::isError($sql_add_mem)) { die("添加成员失败！ − " . $sql_add_mem->getMessage() . "<br>"); }
      }
      //添加成功后删除该申请
      $sql="DELETE FROM `comapply` WHERE stuID='".$stuNo."' AND community = '".$community."' AND dept= '".$dept."'";
      $sql_del_appl=$conn->query($sql);
      //echo $sql;
      if (DB::isError($sql_del_appl)) { die("删除申请失败！ − " . $sql_del_appl->getMessage() . "<br>"); }

    }
  }
    
  $sql="SELECT * FROM clubinfo WHERE No='$post_comCode'";
  $q = $conn->query("SELECT * FROM clubinfo WHERE No='$post_comCode'");
  //echo $sql;
  if (DB::isError($q)) { die("查询失败！ − " . $q->getMessage() . "<br>"); }
  $r = $q->fetchRow();
  
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
  </div> 
</nav>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-3">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="s_infoManage.php">管理社团信息</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="s_manager2_memManage.php">管理社团人员</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>  
    <div class="col-sm-8">       
      <?php
        $sql_select_dep = $conn->query("SELECT distinct depName FROM comMember WHERE comNumber='$post_comCode'");
              $res_select_dep = [];
              $count_select_dep = 0;
               
                
      ?> 
      <form>
        <div class="form-group">
          <select class="form-control" id="sel" onchange="jump(this.options[this.options.selectedIndex].value)">
            <option value="">请选择部门</option>
            <?php
            while($r=$sql_select_dep->fetchRow()){
                $count_select_dep++;      
                $res_select_dep[] = $r;
            ?>
            <option value="<?php echo $r[0];?>"><?php echo $r[0];?></option>
            <?php }?>
          </select>
          <br>
        </div>
    </form> 
    <?php 
    //有部门选择时
      if(isset($_COOKIE["selDep"] ) && $_COOKIE["selDep"] != -1) {
    ?> 
    <table class="table table-striped" id="table" cellspacing="0">
      <thead>
        <tr>
          <th>社团编号</th>
          <th>社团</th>
          <th>部门</th>
          <th>学号</th>
          <th>姓名</th>
          <th>职位</th>
          <th>权限</th>
          <th>阳光信用积分</th>
          <th></th>
        </tr>
      </thead>
      <tbody> 
        <?php 
            $selDepart=$_COOKIE["selDep"] ;
            $sql_select_mem = $conn->query("SELECT * FROM comMember WHERE comNumber='$post_comCode'   AND depName= '$selDepart'");
            $row=0;
            while($r=$sql_select_mem->fetchRow()){
              $row++;
        ?>
        <tr>
          <?php 
          for($attribute=0; $attribute<8; $attribute++){ ?>
          <td><?php echo $r[$attribute]; ?></td>
          <?php } ?>
          <td><button class="btn btn-light" onclick="update(this,<?php echo $row; ?>)">修改</button></td>
        </tr>
      <?php } ?>
      </tbody>
    </table>

    <?php } else {
    ?>
    <table class="table table-striped" id="table" cellspacing="0">
      <thead>
        <tr>
          <th>社团编号</th>
          <th>社团</th>
          <th>部门</th>
          <th>学号</th>
          <th>姓名</th>
          <th>职位</th>
          <th>权限</th>
          <th>阳光信用积分</th>
          <th></th>
        </tr>
      </thead>
      <tbody> 
        <?php
          //默认显示
          $sql_select_mem = $conn->query("SELECT * FROM comMember WHERE comNumber='$post_comCode'   ORDER BY depName");
          $row=0;
          while($r=$sql_select_mem->fetchRow()){
              $row++;  
        ?>
        <tr>
          <?php 
          for($attribute=0; $attribute<8; $attribute++){ ?>
          <td><?php echo $r[$attribute]; ?></td>
          <?php } ?>
          <td><button class="btn btn-light" onclick="update(this,<?php echo $row ;?>)">修改</button></td>
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
<?php }  ?>
<script>
    var item = [ 'comNumber','comName','depName','stuID','stuName','memPosition','memPower','memScore' ];
    function update(obj,x){
      
      var table = document.getElementById("table");
      console.log("table1"+table.rows[x].cells[5].innerHTML);
      console.log("table1"+table.rows[x].cells[6].innerHTML);
      var comNumber = table.rows[x].cells[0].innerHTML;
      var stuID = table.rows[x].cells[3].innerHTML;
      var position = table.rows[x].cells[5].innerHTML;
      var power = table.rows[x].cells[6].innerHTML;
      table.rows[x].cells[5].innerHTML = '<input class="form-control" name="input'+ x + 5 + '" type="text" value=""/>';
      table.rows[x].cells[6].innerHTML = '<input class="form-control" name="input'+ x + 6 +'" type="text" value=""/>';
      var input1 = document.getElementsByName("input" + x + 5);  
      var input2 = document.getElementsByName("input" + x + 6);    
      input1[0].value = position;
      input2[0].value = power;
      obj.innerHTML = "确定";
      obj.onclick = function onclick(event) {
                    update_success(this,x);
                      };
      document.cookie="comNumber="+comNumber;
      document.cookie="stuID="+stuID;
      }

    function update_success(obj,x){
        var arr=[];
        var table = document.getElementById("table");
        var input1 = document.getElementsByName("input" + x + 5);
        var input2 = document.getElementsByName("input" + x + 6);
        //把值赋值给表格，不能在取值的时候给，会打乱input的个数
        var position = input1[0].value;
        var power = input2[0].value;
         
        document.cookie="position="+position;
        document.cookie="power="+power; 

        table.rows[x].cells[5].innerHTML =position;
        table.rows[x].cells[6].innerHTML =power;
        
        obj.innerHTML = "修改";
        obj.onclick = function onclick(event) {
                    update(this,x);
                      };
        
        console.log("table2"+table.rows[x].cells[5].innerHTML);
        console.log("table2"+table.rows[x].cells[6].innerHTML);
        window.location.reload();

    }
    function jump(s) 
    { 
      document.cookie="selDep="+s;
      //console.log(s);
      window.location.reload();

    }

    // 删除cookie   
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
        console.log(arr[1]);
      }
    }
    
</script>
<?php
  $position= '';
  $power= '';
  $sql='';
  if (isset($_COOKIE['comNumber'])&& isset($_COOKIE["stuID"]) && isset($_COOKIE["position"])&& isset($_COOKIE["power"])){
    if ($_COOKIE['comNumber'] != "-1"&& $_COOKIE["stuID"]!= "-1" &&$_COOKIE["position"]!= "-1"&& $_COOKIE["power"]!= "-1"){
      $comNumber=$_COOKIE["comNumber"];
      $stuID=$_COOKIE["stuID"];
      $position = $_COOKIE["position"];
      $power = $_COOKIE["power"];
      $sql="Update comMember set memPosition = '".$position."' , memPower = ". $power ." where comNumber = '".$comNumber."' and stuID='".$stuID."' ";
      echo $sql;
      $q = $conn->query($sql);
      if (DB::isError($q)) { die("修改失败！ − " . $q->getMessage() . "<br>");}
      echo "<script>
            delcookie('comNumber');
            delcookie('stuID');
            delcookie('position');
            delcookie('power');
      </script>";
      $sql="DELETE FROM `commember` WHERE memPower=4";
      $del=$conn->query($sql);
      if (DB::isError($q)) { die("删除失败！ − " . $q->getMessage() . "<br>");}
      echo "<script>window.location.reload();document.all.sel.options[s].selected=true; </script>";


      }
    }
?>

</div></body>
</html>