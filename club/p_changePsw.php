<?php 
// session_start();
// $stuID = $_SESSION['stuID'];
$stuID = $_GET['studentID'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>更改密码</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/studentInfo.css">
</head>
<body>
<!--main_top-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <div id="topgray">
        <h2 id="top-title">更改密码</h2>
    </div>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form method="post" action="p_changePsw_sub.php">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">账号（学号）：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="studentID" value="<?php echo $stuID ?>" readonly='readonly' class="text-word">
        </td>
        </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">请输入旧密码：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="password" name="oldpass" value="" class="text-word">
        </td>
        </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">请输入新密码：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="password" name="newpass" value="" class="text-word">
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">再次输入新密码：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="password" name="newpass2" value="" class="text-word">
        </td>
      </tr>
       
      <tr>
      	<td>
      		 <input name="ope" type="hidden" value="mupdate"/>
      	</td>
      </tr>
      
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="提交" class="text-but">
        <input name="" type="reset" value="重置" class="text-but"></td>
        </tr>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>