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
  <title>社团信息管理</title>
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
          <a class="dropdown-item" href="a_select_cominfoid.html">按社团ID查找</a>
          <a class="dropdown-item" href="a_select_cominfoname.html">按社团名称查找</a>
          <a class="dropdown-item" href="a_select_cominfoprincipal.html">按社团负责人查找</a>
		  <a class="dropdown-item" href="a_personOforga.php">查看全部</a>
         </div>
        </div>
         <input type="text" class="form-control" placeholder="输入社团ID/社团名称/社团负责人">
      </div>
    </form>
 <a href="a_add_clubinfo.html" class="btn btn-info" role="button">+添加</a>
 </div>      
 
  <div class="box3">
         <table width="1115" border="1">
	          <tr>
			    <td>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">社团编号</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">社团名称</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">社团类别</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">成立日期</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">社团负责人</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">负责人联系方式</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">社团部门</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">社团简介</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">操作</th>
				</td>
			</tr>
			
			<?php
			//导入数据库
			include 'headerfiles.php';
			$No = $_POST['No'];
			$sql = "select * from clubinfo where No = '$No' order by No asc";//从数据库中查询到clubinfo数据库，返回数据库结果集，并按照学号升序排列
	         //结果集
	        @$result = mysqli_query($con,$sql);
	        //解析结果集，$row为社团所有数据，
	        @$newsNum=mysqli_num_rows($result);	
			for($i=0; $i<$newsNum; $i++){
					@$row = mysqli_fetch_assoc($result);
					echo "<tr>";
					echo "<td style=\" font-size:16px; color:#fff;\"></td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['No']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['clubName']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['clubType']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['establishDate']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['principal']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['contact']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['deparment']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['introduction']}</td>";
					echo "<td>
						    <a href='a_editclubinfo.php?No={$row['No']}'class=\"btn btn-info\" role=\"button\">修改</a>
							<a href='javascript:del({$row['No']})'class=\"btn btn-danger\" role=\"button\">删除</a>
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
		function del (No) {
			if (confirm("确定将这行信息从表中删除吗？")){
				window.location = "a_action_deleteclubinfo.php?No="+No;
			}
		}
	</script>
</body>
</html>
   
</body>
</html>

  
