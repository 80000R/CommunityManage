<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改社团成人员信息</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    include 'headerfiles.php';
    
    $stuID = $_GET['stuID'];
	$comNumber = $_GET['comNumber'];
    $sql = mysqli_query($con,"SELECT * FROM commember WHERE comNumber=$comNumber and stuID=$stuID");
    $sql_arr = mysqli_fetch_assoc($sql); 

?>
<div class="container">
  <h2>修改社团人员信息</h2>
   <form action="a_action_editCommember.php" method="post">
      <div class="form-group">
        <label for="comNumber">社团编号:</label>
	    <input type="text" class="form-control" name="comNumber" value="<?php echo $sql_arr['comNumber']?>">
      </div>
	  <div class="form-group">
         <label for="comName">社团名称:</label>
	    <input type="text" class="form-control" name="comName" value="<?php echo $sql_arr['comName']?>">
	  </div>
	  <div class="form-group">
	    <label for="depName">部门名称:</label>
	    <input type="text" class="form-control" name="depName" value="<?php echo $sql_arr['depName']?>">
      </div>
	  <div class="form-group">
	    <label for="stuID">社员学号:</label>
	    <input type="text" class="form-control" name="stuID" value="<?php echo $sql_arr['stuID']?>">
      </div>
      <div class="form-group">
        <label for="stuName">社员姓名：</label>
	    <input type="text" class="form-control" name="stuName" value="<?php echo $sql_arr['stuName']?>">
      </div>
	  <div class="form-group">
	    <label for="memPosition">身份:</label>
	    <input type="text" class="form-control" name="memPosition" value="<?php echo $sql_arr['memPosition']?>">
      </div>
	  <div class="form-group">
	    <label for="memPower">管理员权限:</label>
	    <input type="text" class="form-control" name="memPower" value="<?php echo $sql_arr['memPower']?>">
	  </div>
	  <div class="form-group">
	    <label for="memScore">信用积分：</label>
	    <input type="text" class="form-control" name="memScore" value="<?php echo $sql_arr['memScore']?>">
      </div>
	  <div class="form-check">
        <label class="form-check-label">
        <input class="form-check-input" type="checkbox" > Remember me
        </label> 
      </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>