<?php //注册信息验证
include 'headerfiles.php';
$person=$_POST['person'];
$name=$_POST['name'];
$pass=$_POST['pass'];
$confirm=$_POST['confirm'];
/*@$select_result= mysqli_query("select * from student where stuID ='$person' ;");
while (@$row=mysqli_fetch_array(@$select_result)) { 
      @$dbusername=@$row["person"]; 
    } 
if(!is_null(@$dbusername))
{   
    echo"<script>alert('用户ID已存在'); history.go(-1); </script>  ";
}*/
if($pass!=$confirm)
{   
    
    echo "<script>alert('两次输入密码不一致，请重新确认！'); history.go(-1);</script>";

}
else
{
    $sql = "insert into student(stuID,stuName,gender,institute,major,email,phone,community,password,status) values('$person','$name',null,null,null,null,null,null,'$pass',null)";
    @$result = mysqli_query($con,$sql);
    header("Refresh:5;url = index.php");


}
?>
    <html>
    <head>
        <meta charset="utf-8">
        <title>注册结果</title>
        <link href="C.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <div class="box">
        <h2>注册成功，5s后自动跳转.</h2>

    </div>
    </body>
    </html>
