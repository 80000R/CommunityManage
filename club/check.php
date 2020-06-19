<?php  //登陆信息验证
session_start();

//header("Content-Type:text/html;charset=utf-8");

include 'headerfiles.php';


$person = $_POST['person'];//ID
setcookie('person',$person);
$mess=$_POST["user"];//用户类型

if($mess=="User") {
    $sql = "select * from student where stuID='$_POST[person]' AND password ='$_POST[pass]'";
    if($con->query($sql) == TRUE) {
		$sql = "update student set status='1' where stuID='$person'";
		@$result = mysqli_query($con,$sql);
		header("Refresh:0;url =p_index.php?studentID=".$person);//登录成功跳转到学生页面
		exit;
    }
    else {
		header("Refresh:0;url = failed.php");//登录失败跳转到失败页面
		exit;
    }
}



if($mess=="Administrator"){
    $sql = "select * from administrator where admID='$_POST[person]' AND admPassword ='$_POST[pass]'";
    if($con->query($sql) == TRUE) {
		header("Refresh:0;url = Administrator.html");//登录成功跳转到系统管理员页面
		exit;
    }
    else {
		header("Refresh:0;url = failed.php");//登录失败跳转到失败页面
		exit;
    }

}
else{
	$sql = "select * from commanager where comNo='$_POST[person]' AND password ='$_POST[pass]'";
    if($con->query($sql) == TRUE) {
		header("Refresh:0;url = s_infoManage.php?comNo=".$person);//登录成功跳转到系统管理员页面
		exit;
    }
    else {
		header("Refresh:0;url = failed.php");//登录失败跳转到失败页面
		exit;
    }
}
?>