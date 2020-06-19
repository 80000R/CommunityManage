<?php  //登陆信息验证
include 'headerfiles.php';

//获取信息
$user=$_COOKIE['person'];
$location = "";  //地区
$iid=$_POST['iid'];

$sql1 = "SELECT address FROM users WHERE id = ?";
$stmt = $con->stmt_init();
if ($stmt->prepare($sql1)) {
    $stmt->bind_param("s", $user);
    $stmt->execute();	
	$stmt->bind_result($location);
	$stmt->fetch();//!!
	$stmt->close();
}

$sql2 = " DELETE FROM adminmessage WHERE iid='$iid'";
@$result = mysqli_query($con,$sql2);
echo "<script>alert('撤销成功！');</script>";
header("Refresh:0;url = backmessui.php");

?>