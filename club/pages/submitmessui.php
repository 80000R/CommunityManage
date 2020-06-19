<?php
header("Content-Type:text/html;charset=utf-8");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>下发通知</title>
    <link href="C.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="box">
    <h2>下发通知</h2>
    <form action="submitmess.php" method="post" enctype="multipart/form-data">
        <div class="inputBox"><input type="text" name="iid" value="" required="required"placeholder=   "                Id"><label>针对的疾病</label></div>
        <div class="inputBox"><input type="text" name="mess" value="" required="required"placeholder=   "                 Name"><label>补充说明</label></div>
        <input type="submit" name="submit" value="YES  ">
    </form>

    <form action="admin.html" method="post" enctype="multipart/form-data">
        <input type="submit" name="submit" value="BACK">
    </form>
</div>
</body>
</html>


