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
// 1:丹 s_infoManage.php;2:婷 s_date_main.php3:玲 s_member.php;
$hr1 = 's_infoManage.php';//test4.php
$hr2 = 's_date_main.php';//
$hr3 = 's_member.php';
$comNo = array();
$comName = array();
$memPower = array();
$sql = "select * from comMember where stuID=$stuID;";
$q = $d->query($sql);
while($r=$q->fetchRow()){
    array_push($comNo,$r[0]);
    array_push($comName,$r[1]);
    array_push($memPower,$r[6]);
}
$arrlength=count($comNo);
// for($x=0;$x<$arrlength;$x++)
// {
    // echo $comNo[$x],$comName[$x];
    // echo "<br>";
// }
?>
<html>
<head>
  <title>社团申请表</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<style type=text/css>
    body{overflow-x:hidden; background:#f2f0f5;}
</style>
<body>
	<div class="container">
		<div class="row">
        <?php for($x=0;$x<$arrlength;$x++){
                if($memPower[$x]==1){
                    $hr = $hr1;
                }
                else if($memPower[$x]==2){
                    $hr = $hr2;
                }
                else if($memPower[$x]==3){
                    $hr = $hr3;
                }
        ?>
			<div class="col-lg-6 col-md-6">
				<div class="card">
					<div class="row">
						<div class="col-sm-6 col-xs-6">
							<div class="card-body">
								<h4><a href="<?php echo $hr;?>?studentID=<?php echo $stuID;?>&comNumber=<?php echo $comNo[$x];?>" target="_blank"><?php echo $comName[$x];?></a></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
        <?php }?>
        </div>
	</div>
</body>
</html>