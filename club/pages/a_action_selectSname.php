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
	<title>查找学生信息</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
               <a class="dropdown-item" href="a_select_stuID.html">按ID查找</a>
               <a class="dropdown-item" href="a_select_sname.html">按学生姓名查找</a>
               <a class="dropdown-item" href="a_select_cominfo.html">按学院查找</a>
			   <a class="dropdown-item" href="a_studentManage.php">查看全部</a>
             </div>
            </div>
           <input type="text" class="form-control" name ="selectway" value= "" required="required" placeholder="输入ID/学生姓名/学院">
         </div
     </form>
	
         <a href="a_add_student.html" class="btn btn-info" role="button">+添加</a>
       
    
   
    </div>
   <div class="box3">
         <table width="1115" border="1">
	          <tr>
			    <td>
				<th style=" font-size:20px; font-size:20px;color:#fff; fongt-weight:bold;">学号</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">姓名</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">性别</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">学院</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">专业</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">邮箱</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">电话</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">已加社团</th>
				<th style=" font-size:20px; color:#fff; fongt-weight:bold;">操作</th>
				</td>
			</tr>
			
			<?php
			//导入数据库
			include 'headerfiles.php';
			$sname = $_POST['sname'];//ID
			$sql = "select * from student where stuName = '$sname' order by stuID asc";//从数据库中查询到student数据库，返回数据库结果集，并按照学号升序排列
	     
			 //结果
	        @$result = mysqli_query($con,$sql);
		
	        //解析结果集，$row为学生所有数据，$newsNum为所有学生数目
	        @$newsNum=mysqli_num_rows($result);	
			for($i=0; $i<$newsNum; $i++){
					@$row = mysqli_fetch_assoc($result);
					echo "<tr>";
					echo "<td style=\" font-size:16px; color:#fff;\"></td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['stuID']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['stuName']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['gender']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['institute']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['major']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['email']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['phone']}</td>";
					echo "<td style=\" font-size:16px; color:#fff;\">{$row['community']}</td>";
					echo "<td>
						    <a href='a_editstudent.php?stuID={$row['stuID']}'class=\"btn btn-info\" role=\"button\">修改</a>
							<a href='javascript:del({$row['stuID']})'class=\"btn btn-danger\" role=\"button\">删除</a>
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
		function del (stuID) {
			if (confirm("确定将这位学生从学生表中删除吗？")){
				window.location = "a_action_deletestudent.php?stuID="+stuID;
			}
		}
	</script>
</body>
</html>
