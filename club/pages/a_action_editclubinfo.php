<?php
include 'headerfiles.php';

// 获取修改的社团信息
$No = $_POST['No'];
$clubName = $_POST['clubName'];
$clubType = $_POST['clubType'];
$establishDate = $_POST['establishDate'];
$principal = $_POST['principal'];
$contact = $_POST['contact'];
$deparment = $_POST['deparment'];
$introduction = $_POST['introduction'];
echo $clubName;
// 更新数据
mysqli_query($con,"UPDATE clubinfo SET No='$No',clubName='$clubName',clubType='$clubType',establishDate='$establishDate',principal='$principal',contact='$contact',deparment='$deparment',introduction='$introduction' WHERE No=$No") or die('修改数据出错：'.mysqli_error());
header("Refresh:5;url = a_orgamanage.php");  
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>修改社团信息结果</title>
        <link href="C2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <div class="box1">
        <h2>修改社团信息成功，稍等几秒自动跳转.</h2>'

    </div>
    </body>
    </html>