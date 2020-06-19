<?php  //添加社团信息至数据库
include 'headerfiles.php';

$No = $_POST['No'];//ID
$clubName = $_POST['clubName'];
$clubType = $_POST['clubType'];
$establishDate = $_POST['establishDate'];
$principal = $_POST['principal'];
$contact = $_POST['contact'];
$deparment = $_POST['deparment'];
$introduction = $_POST['introduction'];

mysqli_query($con,"insert into clubinfo(No,clubName,clubType,establishDate,principal,contact,deparment,introduction) 
             values('$No','$clubName','$$clubType','$establishDate','$principal','$contact','$deparment','$introduction')") or die('添加数据出错：'.mysqli_error()); 
header("Refresh:5;url = a_orgamanage.php");  
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>添加社团信息结果</title>
        <link href="C2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <div class="box1">
        <h2>添加社团信息成功，稍等几秒自动跳转.</h2>

    </div>
    </body>
    </html>