<?php 
// session_start();
$stuID = $_GET['studentID'];
require_once 'DB.php';
$d = DB::connect('mysqli://root:password@localhost/club');
$d->query("SET NAMES 'utf8'");
if(DB::isError($d)){
    die("cannot connect - " . $d->getMessage() . "<br>");
}
// $stuID = $_COOKIE['stuID'];
// $stuID = $_SESSION['stuID'];
$sql = "select stuName,gender,institute,major,email,phone
        from student
        where stuID=?;";
$q = $d->query($sql,array($stuID));
$r = $q->fetchRow();
$stuName = $r[0];
$gender = $r[1];
$institute = $r[2];
$major = $r[3];
$email = $r[4];
$phone = $r[5];
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>个人信息</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/studentInfo.css">
</head>
<body>
<!--main_top-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <div id="topgray">
        <h2 id="top-title">个人信息</h2>
    </div>
  </tr>

  <tr>
       <!-- 上传文件时 要改enctype="multipart/from-data-->
    <form action="p_studentInfo_sub.php" method="post" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">

      <tr>
        <td align="right" valign="middle" class="borderright borderbottom bggray">姓名：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for" onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <input type="text" name="stuName" value="<?php echo $stuName ?>" class="text-word">
        </td>

        <td align="right" valign="middle" class="borderright borderbottom bggray">学号：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for" onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <input type="text" name="studentID" value="<?php echo $stuID ?>" class="text-word" readonly='readonly'>
        </td>
      </tr>
        <tr>
        <td align="right" valign="middle" class="borderright borderbottom bggray">性别：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for" onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <input type="text" name="gender" value="<?php echo $gender ?>" class="text-word">

        <td align="right" valign="middle" class="borderright borderbottom bggray">学院：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for" onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <input type="text" name="institute" value="<?php echo $institute ?>" class="text-word">
        </td>
        </tr>
        <tr>
        <td align="right" valign="middle" class="borderright borderbottom bggray">邮箱：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for" onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <input type="text" name="email" value="<?php echo $email ?>" class="text-word">

        <td align="right" valign="middle" class="borderright borderbottom bggray">专业：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for" onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <input type="text" name="major" value="<?php echo $major ?>" class="text-word">
        </td>
        </tr>
        <tr>
        <td align="right" valign="middle" class="borderright borderbottom bggray">联系方式：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for" onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <input type="text" name="phone" value="<?php echo $phone ?>" class="text-word">
        </td>

        <!-- <td align="right" valign="middle" class="borderright borderbottom bggray">加入的社团：</td> -->
        <!-- <td align="left" valign="middle" class="borderright borderbottom main-for" onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'"> -->
        <!-- <input type="text" name="jcom" value="${member.joinCommunity }" class="text-word"> -->
        <!-- </td> -->
        </tr>
      <tr>
      	<td>
      		 <input name="ope" type="hidden" value="minfo"/>
      	</td>
      </tr>
      
      <tr>
        <td align="center" valign="middle" class="borderright borderbottom main-for" colspan="2" style="padding-left:38%; border-right:none;">
          <input name="" type="submit" value="更新" class="text-but" >
        </td>
        <td align="center" valign="middle" class="borderright borderbottom main-for" colspan="2" style="padding-right:38%; border-right:none;">
              <input name="" type="reset" value="取消" class="text-but" >
        </td>
      </tr>

    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>