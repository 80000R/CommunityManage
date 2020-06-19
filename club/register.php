<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
?>

<html>
<head>
    <meta charset="utf-8">
    <title>注册</title>
    <link href="C.css" rel="stylesheet" type="text/css" />
    <style>
        ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
        color:    #EB7175;
        }
    </style>
</head>
<body>
<?php
session_start();

header("Content-Type:text/html;charset=utf-8");
?>
<div class="box">
    <h2>Register</h2>
    <!--将用户输入的user,和pass提交到login.php-->
    <form action="check2.php" method="post" enctype="multipart/form-data">
        <div class="inputBox"><input type="text" name="person" value="" required="required"placeholder=   "                Enter your ID"><label>ID</label></div>
        <div class="inputBox"><input type="text" name="name" value="" required="required"placeholder=   "                Enter your Name"><label>Name</label></div>
        <div class="inputBox"><Input type="password" name="pass" value=""required="required"placeholder="                Enter your Password"><label>PASSWORD</label></div>
        <div class="inputBox"><input type="password" name="confirm" value=""required="required"placeholder="                Repeat It"><label>CONFIRM</label></div>
        <div class="container4" align="left" ><input type="submit" name="submit" value="Yes"></div>
    </form>

    <form action="index.php" method="post" enctype="multipart/form-data">
        <div class="container3" align="right" ><input type="submit" name="submit" value="Back"></div>
    </form>
</div>
</body>
</html>


