<?php
include 'headerfiles.php';

$No = $_GET['No'];



//删除指定数据  
mysqli_query($con,"DELETE FROM clubinfo WHERE  No={$No}") or die('删除数据出错：'.mysqli_error()); 
// 删除完跳转到管理员页面
header("Refresh:5;url = a_orgamanage.php");  
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>删除社团信息结果</title>
        <link href="C2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <div class="box1">
        <h2>删除社团信息成功，稍等几秒自动跳转.</h2>

    </div>
    </body>
    </html>