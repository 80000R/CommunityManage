<?php
header("Content-Type:text/html;charset=utf-8");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>撤销通知</title>
    <link href="C.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="box">
    <h2>撤销通知</h2>
    <form action="backmess.php" method="post" enctype="multipart/form-data">
        <div class="inputBox"><input type="text" name="iid" value="" required="required"placeholder=   "                Id"><label>针对的疾病</label></div>
		<input type="submit" name="submit" value="YES  ">
	</form>
</div>
</body>
</html>


