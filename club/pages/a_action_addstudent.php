<?php  //添加学生信息至数据库
include 'headerfiles.php';

$stuid = $_POST['stuid'];//ID
$sname = $_POST['sname'];
$institute = $_POST['institute'];
$major = $_POST['major'];
$password = $_POST['password'];
// 插入数据
    /*$sql = "insert into student(stuID,stuName,gender,institute,major,email,phone,community,password,status) 
             values('$stuid','$sname',null,'$institute','$major',null,null,null,null,null)";
    @$result = mysqli_query($con,$sql);
    header("Refresh:5;url = Administrator.html");*/
mysqli_query($con,"insert into student(stuID,stuName,gender,institute,major,email,phone,community,password,status) 
             values('$stuid','$sname',null,'$institute','$major',null,null,null,'$password',null)") or die('添加数据出错：'.mysqli_error()); 
header("Refresh:5;url = a_studentManage.php");  
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>添加学生信息结果</title>
        <link href="C2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <div class="box1">
        <h2>添加学生信息成功，稍等几秒自动跳转.</h2>

    </div>
    </body>
    </html>