<?php
// connect to mysql
require_once 'DB.php';
$d = DB::connect('mysqli://root:password@localhost/club');
if(DB::isError($d)){
die("cannot connect - " . $d->getMessage() . "<br>");
}
$d->query("SET NAMES 'utf8'");
$d->setErrorHandling(PEAR_ERROR_DIE);
// retrieve all variables
$stuName = $_POST["stuName"];//姓名
$gender = $_POST["gender"];//性别
$phone = $_POST["phone"];//联系电话
$institute = $_POST["institute"];//学院
$major = $_POST["major"];//专业
$stuID = $_POST["studentID"];//学号
$community = $_POST["community"];//社团select
$dept = $_POST["department"];//部门
$status = "N";//未审核
if($stuName==null||$gender==null||$phone==null||$community==null
    ||$institute==null||$major==null||$stuID==null||$dept==null){
    echo"<script>alert('1$stuName,2$gender,3$phone,4$institute,5$major,6$stuID,7$community,8$dept,提交信息不完整,请重新填写');history.go(-1);</script>";   //-1为后退一页
}
else{
    $sql = "select stuName,community,dept from comApply";
    $q = $d->query($sql);
    $tag = 1;
    while($r=$q->fetchRow()){
        if($r[0]==$stuName&&$r[1]==$community&&$r[2]==$dept){
            $tag = 0;
            echo"<script>alert('已提交过申请，请耐心等待结果');history.go(-1);</script>"; //-1为后退一页
            break;
        }
    }
    if($tag == 1){
        $sql = "insert  into comApply(stuName,gender,stuID,phone,institute,major,community,dept,status)
                values(?,?,?,?,?,?,?,?,?);";
        $q = $d->query($sql,array($stuName,$gender,$stuID,$phone,$institute,$major,$community,$dept,$status));
        if(DB::isError($q)){
            die("insert not successful − " . $q->getMessage() . "<br>");
        }
        else{
            //显示提示信息后，返回上一界面
            echo"<script>alert('申请表提交成功');history.go(-1);</script>";
        }
    }
}
?>