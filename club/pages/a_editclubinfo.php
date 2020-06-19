<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改社团信息</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    include 'headerfiles.php';
    
    $No = $_GET['No'];
    $sql = mysqli_query($con,"SELECT * FROM clubinfo WHERE No=$No");
    $sql_arr = mysqli_fetch_assoc($sql); 

?>
<div class="container">
  <h2>修改社团信息</h2>
   <form action="a_action_editclubinfo.php" method="post">
      <div class="form-group">
        <label for="No">社团编号:</label>
	    <input type="text" class="form-control" name="No" value="<?php echo $sql_arr['No']?>">
      </div>
	  <div class="form-group">
         <label for="clubName">社团名称:</label>
	    <input type="text" class="form-control" name="clubName" value="<?php echo $sql_arr['clubName']?>">
	  </div>
	  <div class="form-group">
	    <label for="clubType">社团类别:</label>
	    <input type="text" class="form-control" name="clubType" value="<?php echo $sql_arr['clubType']?>">
      </div>
	  <div class="form-group">
	    <label for="establishDate">成立日期:</label>
	    <input type="text" class="form-control" name="establishDate" value="<?php echo $sql_arr['establishDate']?>">
      </div>
      <div class="form-group">
        <label for="principal">社团负责人:</label>
	    <input type="text" class="form-control" name="principal" value="<?php echo $sql_arr['principal']?>">
      </div>
	  <div class="form-group">
	    <label for="contact">负责人联系方式:</label>
	    <input type="text" class="form-control" name="contact" value="<?php echo $sql_arr['contact']?>">
      </div>
	  <div class="form-group">
	    <label for="deparment">社团部门:</label>
	    <input type="text" class="form-control" name="deparment" value="<?php echo $sql_arr['deparment']?>">
	  </div>
	  <div class="form-group">
	    <label for="introduction">社团简介：</label>
	    <input type="text" class="form-control" name="introduction" value="<?php echo $sql_arr['introduction']?>">
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