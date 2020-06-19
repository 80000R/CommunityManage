<?php
$stuID = $_GET['studentID'];
?>
<html lang="en">
  <head>
    <title>Student</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style type=text/css>
    .fakeimg {
      height: 200px;
      background: #aaa;
    }
    </style>
  </head>
 <body>
  <div class="list-group">
    <a href="p_clubApply.php?studentID=<?php echo $stuID;?>" target="mainFrame" class="list-group-item list-group-item-action 
       text-center" style="font-size:120%">社团申请</a>
    <a href="p_apply_state.php?studentID=<?php echo $stuID;?>" target="mainFrame" class="list-group-item list-group-item-action 
       text-center" style="font-size:120%">申请状态</a>
    <a href="p_clubJoined.php?studentID=<?php echo $stuID;?>" target="mainFrame" class="list-group-item list-group-item-action 
       text-center" style="font-size:120%">已加社团</a>
    <a href="p_studentInfo.php?studentID=<?php echo $stuID;?>" target="mainFrame" class="list-group-item list-group-item-action 
       text-center" style="font-size:120%">个人信息</a>
    <a href="p_changePsw.php?studentID=<?php echo $stuID;?>" target="mainFrame" class="list-group-item list-group-item-action 
       text-center" style="font-size:120%">修改密码</a>
  </div>
 </body>
</html>