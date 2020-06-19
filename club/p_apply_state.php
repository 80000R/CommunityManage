<?php 
// session_start();
// $stuID = $_SESSION['stuID'];
$stuID = $_GET['studentID'];
require_once 'DB.php';
$d = DB::connect('mysqli://root:password@localhost/club');
$d->query("SET NAMES 'utf8'");
if(DB::isError($d)){
die("cannot connect - " . $d->getMessage() . "<br>");
}
$deptName = array();
$comName = array();
$status = array();
$sql = "select * from comApply where stuID=$stuID;";
$q = $d->query($sql);
while($r=$q->fetchRow()){
    array_push($comName,$r[6]);
    array_push($deptName,$r[7]);
    if($r[8]=='Y'){
        array_push($status,'申请已通过');
    }
    else if($r[8]=='R'){
        array_push($status,'申请未通过');
    }
    else if($r[8]=='N'){
        array_push($status,'尚未审核');
    }
}
$arrlength=count($comName);

// for($x=0;$x<$arrlength;$x++)
// {
    // echo $comName[$x],$deptName[$x],$status[$x];
    // echo "<br>";
// }
?>
<html>
<head>
	<meta charset="UTF-8">
  	<title>申请状态</title>
    <link rel="stylesheet" href="../static/CSS/shetuanshenqing.css">
</head>
<style type=text/css>
    body{overflow-x:hidden; background:#f2f0f5;}
</style>
<body>

    <div id="topgray">
        <h2 id="top-title">申请状态</h2>
    </div> 
	<div>
	<table id='table' border="1">
	  <div>
	  <tr>
		<th>申请社团</th>
		<th>申请部门</th>
		<th>审核状态</th>
	  </tr>
	  </div>
      <?php for($x=0;$x<$arrlength;$x++){?>
	  <div>
	  <tr class='white-row'>
		<td><strong><?php echo $comName[$x]?></strong></td>
		<td><strong><?php echo $deptName[$x]?></strong></td>
        <td><strong><?php echo $status[$x]?></strong></td>
	  </tr>
	  </div>
      <?php }?>
	</table>
    <a href="p_apply_state_sub.php?studentID=<?php echo $stuID;?>"> 
        <div>
            <input value="      已读并删除" id="button2">
        </div>
    </a>
    </div>
</body>
</html>

