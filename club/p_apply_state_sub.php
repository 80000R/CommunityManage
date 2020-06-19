<?php 
    $stuID = $_GET['studentID'];
    require_once 'DB.php';
    $d = DB::connect('mysqli://root:password@localhost/club');
    $d->query("SET NAMES 'utf8'");
    if(DB::isError($d)){
    die("cannot connect - " . $d->getMessage() . "<br>");
    }
    $sql = "delete from comApply
            where stuID = '$stuID' AND status <> 'N';";
    $q = $d->query($sql);
    if(DB::isError($q)){
        die("delete not successful − " . $q->getMessage() . "<br>");
    }
    else{
        echo"<script>alert('已删除已审批申请');history.go(-1);</script>";
    }
?>