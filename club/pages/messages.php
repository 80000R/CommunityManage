<?php  //登陆信息验证
include 'headerfiles.php';
header("Content-Type:text/html;charset=utf-8");

//获取数据
$user=$_COOKIE['person'];
$answer1="";//年龄
$answer2="";//名称
$location = "";  //地区

$sql1 = "SELECT age,name,address FROM users WHERE id = ?";
$stmt = $con->stmt_init();
if ($stmt->prepare($sql1)) {
    $stmt->bind_param("s", $user);
    $stmt->execute();	
	$stmt->bind_result($answer1,$answer2,$location);
	$stmt->fetch();//!!
	$stmt->close();
}

//百度天气接口API
header("Content-Type: text/html; charset=UTF-8");
//$weatherURL = "http://api.map.baidu.com/telematics/v3/weather?location=$location&output=json&ak=$ak";  
$weatherURL = "http://api.map.baidu.com/telematics/v3/weather?location=$location&output=json&ak=3p49MVra6urFRGOT9s8UBWr2";  
$ch = curl_init($weatherURL) ;
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
$result = curl_exec($ch);
//echo $result;
//解析json数据
$object = json_decode($result);

//正式界面语句
//输出欢迎语句
print"<div style=\"text-align: center;\" ><h3>尊敬的".$answer2."您好，欢迎使用本系统！<br></h3></div>";
//输出当前日期
//检测季节
$tmp_date=date("Ym");
//切割出月份  
$tmp_mon =substr($tmp_date,4,2);
print"<div style=\"text-align:center;\" ><h3>当前的日期为:".date("Y-m-d",time())."  您所在的地区为:".$location."<br></h3></div>";
//输出有关天气的关心语句
$mess_Of_weather =$object->results[0]->index[0]->des;
print"<div style=\"text-align:center;\" ><h3>".$mess_Of_weather."<br></h3></div>";


//查询信息表，看最近是否有通知单下发的医院
$sql_mess = mysqli_query($con,"SELECT A.mess,A.iid
			 FROM adminmessage A
		     WHERE A.ridi = '$location';");
if($r = mysqli_fetch_array($sql_mess)){
	echo '<br>'; 
		print"<div style=\"text-align:\" ><h3>尊敬的用户您好！您所在的地区有如下通知：<br></h3></div>";
		echo "<p>";
		print"<div style=\"text-align:\" ><h3>有关疾病：$r[1]<br></h3></div>";
		print "通知：$r[0]";
		echo '<br>'; 
		while($r = mysqli_fetch_array($sql_mess)){
			print"<div style=\"text-align:\" ><h3>有关疾病：$r[1]<br></h3></div>";
			print "通知：$r[0]";
			echo '<br>';  
		}
}
echo '<br>';
//综合输出概率最大的流行病


//根据季节和气温判断
//从api获得气温信息
$temp = $object->results[0]->weather_data[0]->temperature;
echo '<br>';
if($tmp_mon >= 3 && $tmp_mon <= 5){
	$sql2 = mysqli_query($con,"SELECT I.iname,I.disadvantage,I.prevent,I.feature,I.treatment
			 FROM Illmessage I
		     WHERE I.reasonid = 10;");
	if($sql2){
		print"<div style=\"text-align:\" ><h3>春暖花开，生机盎然。此时正值春季，您应该注意传染病：<br></h3></div>";
		echo "<p>";
		while($r = mysqli_fetch_array($sql2)){
			print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>";
			print "介绍：$r[3]";
			echo '<br>'; 
			print "具体症状：$r[1]";
			echo '<br>'; 
			print "预防方式：$r[2]";
			echo '<br>'; 
			print "治疗方式：$r[4]";
			echo '<br>'; 
		}
		echo '<br>';
	}
}else if($tmp_mon >= 6 && $tmp_mon <= 8){
	$sql2 = mysqli_query($con,"SELECT I.iname,I.disadvantage,I.prevent,I.feature,I.treatment
			 FROM Illmessage I
		     WHERE I.reasonid = 11;");
	if($sql2){
		print"<div style=\"text-align:\" ><h3>骄阳似火，万木葱茏。此时正值夏季，您应该注意传染病：<br></h3></div>";
		echo "<p>";
		while($r = mysqli_fetch_array($sql2)){
			print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>";
			print "介绍：$r[3]";
			echo '<br>'; 
			print "具体症状：$r[1]";
			echo '<br>'; 
			print "预防方式：$r[2]";
			echo '<br>'; 
			print "治疗方式：$r[4]";
			echo '<br>'; 
		}
		echo '<br>';
	}
}else if($tmp_mon >= 9 && $tmp_mon <= 11){
	$sql2 = mysqli_query($con,"SELECT I.iname,I.disadvantage,I.prevent,I.feature,I.treatment
			 FROM Illmessage I
		     WHERE I.reasonid = 12;");
	if($sql2){
		print"<div style=\"text-align:\" ><h3>秋高气爽，北雁南飞。此时正值秋季，您应该注意传染病：<br></h3></div>";
		echo "<p>";
		while($r = mysqli_fetch_array($sql2)){
			print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>";
			print "介绍：$r[3]";
			echo '<br>'; 
			print "具体症状：$r[1]";
			echo '<br>'; 
			print "预防方式：$r[2]";
			echo '<br>'; 
			print "治疗方式：$r[4]";
			echo '<br>'; 
		}
		echo '<br>';
	}
}else{
	$sql2 = mysqli_query($con,"SELECT I.iname,I.disadvantage,I.prevent,I.feature,I.treatment
			 FROM Illmessage I
		     WHERE I.reasonid = 13;");
	if($sql2){
		print"<div style=\"text-align:\" ><h3>冰封大地，瑞雪纷飞。此时正值冬季，您应该注意传染病：<br></h3></div>";
		echo "<p>";
		while($r = mysqli_fetch_array($sql2)){
			print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>";
			print "介绍：$r[3]";
			echo '<br>'; 
			print "具体症状：$r[1]";
			echo '<br>'; 
			print "预防方式：$r[2]";
			echo '<br>'; 
			print "治疗方式：$r[4]";
			echo '<br>'; 
		}
		echo '<br>';
	}
}

//根据地区特征判断
//获取信息
$region_plant = "-1"; //植被覆盖率
$region_population = "-1"; //人口数量
$region_ridi = "-1"; //城市编号

$sql_region = "SELECT plant,population,ridi FROM regiondata WHERE rname = ?";
$stmt1 = $con->stmt_init();
if ($stmt1->prepare($sql_region)) {
    $stmt1->bind_param("s", $location);
    $stmt1->execute();	
	$stmt1->bind_result($region_plant,$region_population,$region_ridi);
	$stmt1->fetch();//!!
	$stmt1->close();
}



//植被特征
if((int)$region_plant > 34){
$sqlplant = mysqli_query($con,"SELECT I.iname,I.disadvantage,I.prevent,I.feature,I.treatment
			 FROM Illmessage I
		     WHERE I.reasonid = 20;");
if($sqlplant){
	echo '<br>';
	print"<div style=\"text-align:\" ><h3>您所在的地区植被较为茂盛，应注意流行病：<br></h3></div>";
	echo "<p>";
	while($r = mysqli_fetch_array($sqlplant)){
		print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>";
		print "介绍：$r[3]";
		echo '<br>'; 
		print "具体症状：$r[1]";
		echo '<br>'; 
		print "预防方式：$r[2]";
		echo '<br>'; 
		print "治疗方式：$r[4]";
		echo '<br>'; 
	}
	echo '<br>';
}
}
//人口密度
if((int)$region_population > 25000000){
$sqldesity = mysqli_query($con,"SELECT I.iname,I.disadvantage,I.prevent,I.feature,I.treatment
			 FROM Illmessage I
		     WHERE I.reasonid = 19;");
if($sqldesity){
	echo '<br>';
	print"<div style=\"text-align:\" ><h3>您所在的地区人口较为密集，应注意流行病：<br></h3></div>";
	echo "<p>";
	while($r = mysqli_fetch_array($sqldesity)){
		print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>";
		print "介绍：$r[3]";
		echo '<br>'; 
		print "具体症状：$r[1]";
		echo '<br>'; 
		print "预防方式：$r[2]";
		echo '<br>'; 
		print "治疗方式：$r[4]";
		echo '<br>'; 
	}
	echo '<br>';
}
}
//输出根据当地历史数据整理得到的常发疾病
echo '<br>';
$sql_history = mysqli_query($con,"SELECT I.iname,I.disadvantage,I.prevent,I.feature,I.treatment
			 FROM Illmessage I
		     WHERE I.reasonid = '{$region_ridi}';");
if($r = mysqli_fetch_array($sql_history)){
	print"<div style=\"text-align:\" ><h3>根据当地历史数据表明，应该注意以下传染病：<br></h3></div>";
	echo "<p>";
	print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>";
	print "介绍：$r[3]";
	echo '<br>'; 
	print "具体症状：$r[1]";
	echo '<br>'; 
	print "预防方式：$r[2]";
	echo '<br>'; 
	print "治疗方式：$r[4]";
	echo '<br>';
	
	while($r = mysqli_fetch_array($sql_history)){
		print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>";
		print "介绍：$r[3]";
		echo '<br>'; 
		print "具体症状：$r[1]";
		echo '<br>'; 
		print "预防方式：$r[2]";
		echo '<br>'; 
		print "治疗方式：$r[4]";
		echo '<br>'; 
	}
	echo '<br>';
}



//根据年龄判断
if((int)$answer1 > 50){
	$sql2 = mysqli_query($con,"SELECT I.iname,I.disadvantage,I.prevent,I.feature,I.treatment
			 FROM Illmessage I
		     WHERE I.reasonid = 16;");
	if($sql2){
		print"<div style=\"text-align:\" ><h3>您的年龄较大，应注意流行病：<br></h3></div>";
		echo "<p>";
		while($r = mysqli_fetch_array($sql2)){
			print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>";
			//print "病名：$r[0]";
			print "介绍：$r[3]";
			echo '<br>'; 
			print "具体症状：$r[1]";
			echo '<br>'; 
			print "预防方式：$r[2]";
			echo '<br>'; 
			print "治疗方式：$r[4]";
			echo '<br>'; 
		}
		echo '<br>';
	}
}
else if((int)$answer1 > 15){
	$sql2 = mysqli_query($con,"SELECT I.iname,I.disadvantage,I.prevent,I.feature,I.treatment
			 FROM Illmessage I
		     WHERE I.reasonid = 15;");
	if($sql2){
		print"<div style=\"text-align:\" ><h3>您正值青年，应注意流行病：<br></h3></div>";
		echo "<p>";
		while($r = mysqli_fetch_array($sql2)){
			print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>";
			print "介绍：$r[3]";
			echo '<br>'; 
			print "具体症状：$r[1]";
			echo '<br>'; 
			print "预防方式：$r[2]";
			echo '<br>'; 
			print "治疗方式：$r[4]";
			echo '<br>'; 
		}
		echo '<br>';
	}
}
else{
	$sql2 = mysqli_query($con,"SELECT I.iname,I.disadvantage,I.prevent,I.feature,I.treatment
			 FROM Illmessage I
		     WHERE I.reasonid = 14;");
	if($sql2){
		print"<div style=\"text-align:\" ><h3>您年纪尚小，应注意流行病：<br></h3></div>";
		echo "<p>";
		while($r = mysqli_fetch_array($sql2)){
			print"<div style=\"text-align:\" ><h3>病名：$r[0]<br></h3></div>"; 
			print "介绍：$r[3]";
			echo '<br>'; 
			print "具体症状：$r[1]";
			echo '<br>'; 
			print "预防方式：$r[2]";
			echo '<br>'; 
			print "治疗方式：$r[4]";
			echo '<br>'; 
		}
		echo '<br>';
	}
}

print"<div style=\"text-align: center;\" ><h3>祝您生活愉快！<br></h3></div>";

?>

<html>
<head>
    <meta charset="utf-8">
    <title>温馨提示</title>
    <link href="C.css" rel="stylesheet" type="text/css" />
</head>
</html>