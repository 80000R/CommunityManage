<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <style type="text/css">
    body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
  </style>
  <link rel="stylesheet" href="../static/css/font.css">
  <link rel="stylesheet" href="../static/css/weadmin.css">
  <link href="C2.css" rel="stylesheet" type="text/css" />
  <link href="../static/style.css" rel="stylesheet">
  <title>社团人员信息管理</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
  /* Make the image fully responsive */
  *.carousel-inner img {
      width: 100%;
      height: 100%;
  }
  </style>
   <style>
  /* Make the image fully responsive */
  .fakeimg {
      height: 200px;
      background: #aaa;
  }
  </style>
</head>


<body>
  	<div class="box1">
      <form>
         <div class="input-group mt-3 mb-3">
            <div class="input-group-prepend">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
            查询方式
            </button>
             <div class="dropdown-menu">
               <a class="dropdown-item" href="a_select_commemberid.html">按ID查找</a>
               <a class="dropdown-item" href="a_select_commemberstuid.html">按学号查找</a>
               <a class="dropdown-item" href="a_select_commembername.html">按社团名称查找</a>
			   <a class="dropdown-item" href="a_personOforga.php">查看全部</a>
             </div>
            </div>
           <input type="text" class="form-control" name ="selectway" placeholder="输入社团ID/学号/社团名称">
         </div
     </form>
	
         <a href="a_add_Commember.html" class="btn btn-info" role="button">+添加</a>
       
    
   
    </div>
    <div class="box3">
         <table width="1115" border="1">
	          <tr>
			    <td>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">社团编号</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">社团名字</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">部门名称</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">社员学号</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">社员姓名</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">身份</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">管理员权限</th>
								<th style=" font-size:20px; color:#fff; fongt-weight:bold;">信用积分</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">操作</th>
				</td>
			</tr>
			
			<?php
			//导入数据库
			include 'headerfiles.php';
			$comName = $_POST['comName'];
			$sql = "select * from commember where comName = '$comName' order by comNumber asc";//从数据库中查询到commember数据库，返回数据库结果集，并按照社团编号升序排列
	         //结果集
	        @$result = mysqli_query($con,$sql);
	        //解析结果集，$row为所有社团成员的数据，$newsNum为其数目
	        @$newsNum=mysqli_num_rows($result);	
			for($i=0; $i<$newsNum; $i++){
					@$row = mysqli_fetch_assoc($result);
					echo "<tr>";
					echo "<td style=\" font-size:16px; color:#fff;\"></td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['comNumber']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['comName']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['depName']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['stuID']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['stuName']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['memPosition']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['memPower']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['memScore']}</td>";
					echo "<td>
						    <a href='a_editCommember.php?comNumber={$row['comNumber']}&stuID={$row['stuID']}'class=\"btn btn-info\" role=\"button\">修改</a>
							<a href='javascript:del({$row['comNumber']},{$row['stuID']})'class=\"btn btn-danger\" role=\"button\">删除</a>
						  </td>";
					echo "</tr>";
			}
			//释放结果集
			mysqli_free_result($result);
			mysqli_close($con);
			?>
	   </table>
    </div> 

    <script type="text/javascript">
		function del (comNumber,stuID) {
			if (confirm("确定将这位成员从社团人员信息表中删除吗？")){
				window.location = "a_action_deleteCommember.php?comNumber="+comNumber+"&stuID="+stuID;
			}
		}
	</script>
</body>
</html>

	


    


  
