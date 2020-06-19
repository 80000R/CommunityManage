<?php
header("Content-Type:text/html;charset=utf-8");
$con=mysqli_connect("localhost","root","password","club");
mysqli_query($con,"set names utf8");
if(!$con)
{
    echo "连接失败";
    die("error:".mysqli_connect_error());
}
?>


