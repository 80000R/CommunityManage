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
$oldpass = $_POST["oldpass"];//密码password
$newpass = $_POST["newpass"];//新密码
$newpass2 = $_POST["newpass2"];//

if($stuID==null||$oldpass==null||$newpass==null||$newpass2==null){
    echo"<script>alert('提交信息不完整,请重新填写');history.go(-1);</script>";   //-1为后退一页
}
else{
    $sql = "select password from student
            where stuID=$stuID;";
    $q = $d->query($sql);
    $r = $q->fetchRow();
    if($oldpass!=$r[0]){
        echo"<script>alert('旧密码不匹配，请重新输入');history.go(-1);</script>";   //-1为后退一页
    }
    else if($newpass!=$newpass2){
        echo"<script>alert('两次新密码输入不匹配，请重新输入');history.go(-1);</script>";
    }
    else{
        $sql = "update student
                set password=?
                where stuID=?;";
        $q = $d->query($sql,array($newpass,$stuID));
        if(DB::isError($q)){
            die("insert not successful − " . $q->getMessage() . "<br>");
        }
        else{
            //显示提示信息后，返回上一界面
            echo"<script>alert('密码修改成功');history.go(-1);</script>";
        }
    }
}
?>