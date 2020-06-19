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
$stuID = $_POST["studentID"];//学号
$stuName = $_POST["stuName"];//姓名
$gender = $_POST["gender"];//性别
$institute = $_POST["institute"];//学院
$major = $_POST["major"];//专业
$email = $_POST["email"];//邮箱
$phone = $_POST["phone"];//联系电话

if($stuID==null||$stuName==null||$gender==null||$institute==null
    ||$major==null||$email==null||$phone==null){
    echo"<script>alert('姓名：$stuName, 性别：$gender, 联系电话：$phone, 学院：$institute, 专业：$major, 学号：$stuID, 邮箱：$email,提交信息不完整,请重新填写');history.go(-1);</script>";   //-1为后退一页
}
else{
    $sql = "update student
            set stuName=?,gender=?,institute=?,major=?,email=?,phone=?
            where stuID=?;";
    $q = $d->query($sql,array($stuName,$gender,$institute,$major,$email,$phone,$stuID));
    if(DB::isError($q)){
        die("insert not successful − " . $q->getMessage() . "<br>");
    }
    else{
        //显示提示信息后，返回上一界面
        echo"<script>alert('个人信息修改成功');history.go(-1);</script>";
    }
}
?>