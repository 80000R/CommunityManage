<?php
session_start();
//header("Content-Type:text/html;charset=utf-8");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>登录</title>
    <link href="C.css" rel="stylesheet" type="text/css" />
    <style>
        ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
        color:    #82A5CE;
        }
    </style>
</head>

<body>
<div class="box">
    <h2>Login</h2>
    <form action="check.php" method="post" enctype="multipart/form-data">
        <div class="inputButton"><input type ="radio" name="user" value="User" checked />User</div>
		<div class="inputButton"><input type ="radio" name="user" value="ClubManager" />ClubManager</div>
        <div class="inputButton"><input type ="radio" name="user" value="Administrator"/>Administrator</div>
        <div class="inputBox"><input type="text" name="person" value="" required="required"placeholder= "                 Enter your ID"><label>ID</label></div>
        <div class="inputBox"><input type="password" name="pass" value= "" required="required"placeholder="                 Enter your password"><label>PASSWORD</label></div> 
        <div class="container1" align="left" ><input type="submit" name="submit" value="Login"></div>
		
    </form>
    <form action="register.php" method="post" enctype="multipart/form-data">
        <div class="container2" align="right" ><input type="submit" name="submit" value="Register"></div> 
    </form>
 
        <div class="button" style="vertical-align:middle"><a href="HomePage.html"><span>随便看看</span></a></div>   

</div>



 
</body>
</html>

