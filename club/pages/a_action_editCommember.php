<?php
include 'headerfiles.php';

// 获取修改的社团人员信息
$comNumber = $_POST['comNumber'];
$comName = $_POST['comName'];
$depName = $_POST['depName'];
$stuID = $_POST['stuID'];
$stuName = $_POST['stuName'];
$memPosition = $_POST['memPosition'];
$memPower = $_POST['memPower'];
$memScore = $_POST['memScore'];
// 更新数据
mysqli_query($con,"UPDATE commember SET comNumber='$comNumber',comName='$comName',depName='$depName',stuID='$stuID',stuName='$stuName',memPosition='$memPosition',memPower='$memPower',memScore='$memScore' WHERE comNumber=$comNumber and stuID=$stuID") or die('修改数据出错：'.mysqli_error());
header("Refresh:5;url = a_personOforga.php");  
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>修改社团人员信息结果</title>
        <link href="C2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <div class="box1">
        <h2>修改社团人员信息成功，稍等几秒自动跳转.</h2>'

    </div>
    </body>
    </html>