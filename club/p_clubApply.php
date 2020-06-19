<?php 
require_once 'DB.php';
$d = DB::connect('mysqli://root:password@localhost/club');
$d->query("SET NAMES 'utf8'");
if(DB::isError($d)){
die("cannot connect - " . $d->getMessage() . "<br>");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>社团申请表</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type=text/css>
    .form1{
      width: 350px;
      margin: 0 auto;
    }
    #topgray{
    background: gray;
    width: 100%;
    height: 80px;
    }
    #top-title{
    position: absolute;
    top: 18px;
    left: 40px;
    margin-top: 0px;
    font-size: 30px;
    color: #fff;
    letter-spacing: 4px;
    }
    body{overflow-x:hidden; background:#f2f0f5;}
</style>
</head>

<body>

<!-- <div class="container"> -->
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <div id="topgray">
        <h2 id="top-title">社团申请表</h2>
    </div>
  </tr>
  </table>
  <!-- <h2 class="form1">社团申请表</h2> -->
   <p>&nbsp;</p>
  <form name="clubApplyform" action="p_clubApply_sub.php" method="post" class="form1">
   <table width="60%" border="0" cellpadding="3" cellspacing="12">
    <div class="form-group">
      <label for="stuName">姓名*:</label>
      <input type="text" class="form-control" name="stuName" placeholder="Enter name">
    </div>
    <div class="form-group">
      <label for="gender">性别*:</label>
      <input type="text" class="form-control" name="gender" placeholder="Enter gender">
    </div>
    <div class="form-group">
      <label for="gender">联系电话*:</label>
      <input type="text" class="form-control" name="phone" placeholder="Enter phone">
    </div>
    <div class="form-group">
      <label for="institute">学院*:</label>
      <input type="text" class="form-control" name="institute" placeholder="Enter college">
    </div>
    <div class="form-group">
      <label for="major">专业*:</label>
      <input type="text" class="form-control" name="major" placeholder="Enter major">
    </div>
    <div class="form-group">
      <label for="studentID">学号*:</label>
      <input type="text" class="form-control" name="studentID" placeholder="Enter studentID">
    </div>
    <div class="form-group">
      <label for="community">社团*:</label>
      <select name="community" class="form-control">
        <option value=null>select</option>
        <?php
        $sql= "select clubName from clubinfo";//sql语句
        $q= $d->query($sql);//执行sql语句
        
        if(DB::isError($q)){
        ?>
        <option value="chucuo"><?php echo $q->getMessage(); ?></option>
        <?php
        die("下拉框查询失败！ − " . $q->getMessage() . "<br>");}
        while($row = $q->fetchRow()){
        ?>
        <option value="<?php echo $row[0]; ?>"><?php echo "$row[0]"; ?></option>
        <?php 
        }
        ?>
        <!-- <option value="青年文化促进会">青年文化促进会</option> -->
        <!-- <option value="北洋艺术团">北洋艺术团</option> -->
        <!-- <option value="天津大学学生会">天津大学学生会</option> -->
        <!-- <option value="青年志愿者协会">青年志愿者协会</option> -->
        <!-- <option value="北洋之声">北洋之声</option> -->
      </select>
    </div>
    <div class="form-group">
      <label for="department">部门*:</label>
      <input type="text" class="form-control" name="department" placeholder="Enter department">
    </div>
    <button type="submit" name="Submit" class="btn btn-info btn-lg">Submit</button>
    &nbsp;&nbsp;&nbsp;
    <button type="reset" name="reset" class="btn btn-default btn-lg" active> reset </button>
   </table>
  </form>
<!-- </div> -->

</body>
</html>