<?php
session_start();
 
	//$admID = $_SEESION['adID'];
	//echo $_SEESION['adID'];//存储数据
    
//header("Content-Type:text/html;charset=utf-8");
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	</style>
	<link rel="stylesheet" href="./static/css/font.css">
	<link rel="stylesheet" href="./static/css/weadmin.css">
	<link href="./pages/C2.css" rel="stylesheet" >
	<link href="./static/style.css" rel="stylesheet">
	<title>我的桌面</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
</html>

<body>
    <?php
	
	include 'headerfiles.php';

	 echo"
	<div class=\"box1\">
    <h2>欢迎您，系统管理员！ </h2>
    </div>";
	?>
    
	<?php
	 date_default_timezone_set("PRC");
	echo
	'<h4 align="right">
	  <div  id="time"></div>
	    <script type="text/javascript">
		var dayNames = new Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
			function get_obj(time){
				return document.getElementById(time);
			}
			var ts='.(round(microtime(true)*1000)).';
			function getTime(){
				var t=new Date(ts);
				with(t){
					var _time="当前时间为"+"  "+getFullYear()+"-" + (getMonth()+1)+"-"+getDate()+" " + (getHours()<10 ? "0" :"") + getHours() + ":" + (getMinutes()<10 ? "0" :"") + getMinutes() + ":" + (getSeconds()<10 ? "0" :"") + getSeconds() + " " + dayNames[t.getDay()];
				}
				get_obj("time").innerHTML=_time;
				setTimeout("getTime()",1000);
				ts+=1000;
			}
			getTime();
	    </script>
	 </h4>';
	?>
    
</body>


	
