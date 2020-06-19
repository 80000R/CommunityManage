<?php
include 'headerfiles.php';

// 获取修改的学生信息
$stuID = $_POST['stuID'];
$stuName = $_POST['stuName'];
$gender = $_POST['gender'];
$institute = $_POST['institute'];
$major = $_POST['major'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$community = $_POST['community'];
// 更新数据
mysqli_query($con,"UPDATE student SET stuID='$stuID',stuName='$stuName',gender='$gender',institute='$institute',major='$major',email='$email',phone='$phone',community='$community'  WHERE stuID=$stuID") or die('修改数据出错：'.mysqli_error()); 
header("Refresh:5;url = a_studentManage.php");  
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>修改学生信息结果</title>
        <link href="C2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <div class="box1">
        <h2>修改学生信息成功，稍等几秒自动跳转.</h2>

    </div>
    </body>
    </html>