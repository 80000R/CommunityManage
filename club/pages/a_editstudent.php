<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改学生信息</title>
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
    $sql = mysqli_query($con,"SELECT * FROM student WHERE stuID=$stuID");
    $sql_arr = mysqli_fetch_assoc($sql); 

?>
<div class="container">
  <h2>修改学生信息</h2>
   <form action="a_action_editstudent.php" method="post">
      <div class="form-group">
        <label for="stuID">学生学号: </label>
	    <input type="text" class="form-control" name="stuID" value="<?php echo $sql_arr['stuID']?>">
      </div>
	  <div class="form-group">
        <label for="stuName">学生姓名：</label>
	    <input type="text" class="form-control" name="stuName" value="<?php echo $sql_arr['stuName']?>">
	  </div>
	  <div class="form-group">
	    <label for="gender">学生性别：</label>
	    <input type="text" class="form-control" name="gender" value="<?php echo $sql_arr['gender']?>">
      </div>
	  <div class="form-group">
	    <label for="institute">学生学院：</label>
	    <input type="text" class="form-control" name="institute" value="<?php echo $sql_arr['institute']?>">
      </div>
      <div class="form-group">
        <label for="major">学生专业：</label>
	    <input type="text" class="form-control" name="major" value="<?php echo $sql_arr['major']?>">
      </div>
	  <div class="form-group">
	    <label for="email">学生邮箱：</label>
	    <input type="text" class="form-control" name="email" value="<?php echo $sql_arr['email']?>">
      </div>
	  <div class="form-group">
	    <label for="phone">学生手机：</label>
	    <input type="text" class="form-control" name="phone" value="<?php echo $sql_arr['phone']?>">
	  </div>
	  <div class="form-group">
	    <label for="community">学生加入的社团：</label>
	   <input type="text" class="form-control" name="community" value="<?php echo $sql_arr['community']?>">
      </div>
	  <div class="form-check">
        <label class="form-check-label">
        <input class="form-check-input" type="checkbox"> Remember me
        </label>
      </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>