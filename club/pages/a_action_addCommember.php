<?php  //添加社团人员信息至数据库
include 'headerfiles.php';
$comNumber = $_POST['comNumber'];
$comName = $_POST['comName'];
$depName = $_POST['depName'];
$stuid = $_POST['stuid'];
$sname = $_POST['sname'];
$memPosition = $_POST['memPosition'];
$memPower = $_POST['memPower'];
$memScore = $_POST['memScore'];
//插入数据
mysqli_query($con,"insert into commember(comNumber,comName,depName,stuID,stuName,memPosition,memPower,memScore) 
             values('$comNumber','$comName','$depName','$stuid','$sname','$memPosition','$memPower','$memScore')") or die('添加数据出错：'.mysqli_error()); 
header("Refresh:5;url = a_personOforga.php");  
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>添加社团人员信息结果</title>
        <link href="C2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <div class="box1">
        <h2>添加社团人员信息成功，稍等几秒自动跳转.</h2>

    </div>
    </body>
    </html>