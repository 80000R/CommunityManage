<?php
include 'headerfiles.php';
$stuID = $_GET['stuID'];

//删除指定数据  
mysqli_query($con,"DELETE FROM student WHERE stuID={$stuID}") or die('删除数据出错：'.mysql_error()); 

// 删除完跳转到管理员页面
header("Refresh:5;url = a_studentManage.php");  
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>删除学生信息结果</title>
        <link href="C2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <div class="box1">
        <h2>删除学生信息成功，稍等几秒自动跳转.</h2>

    </div>
    </body>
    </html>