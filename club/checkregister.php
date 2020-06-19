<!doctype html> 
<html> 
<head> 
<meta charset="UTF-8"> 
  <title>注册用户</title> 
</head> 
<body> 
  <?php 
    session_start(); 
	$person=$_POST['person'];
    $name=$_POST['name'];
    $pass=$_POST['pass'];
    $confirm=$_POST['confirm'];
    include 'headerfiles.php';
    $dbuserid=null; 
    $dbpassword=null; 
    $result=mysql_query("select * from student where stuID ='$person' ;"); 
    while ($row=mysql_fetch_array($result)) { 
      $dbusername=$row["person"]; 
      $dbpassword=$row["pass"]; 
    } 
    if(!is_null($dbusername)){ 
  ?> 
  <script type="text/javascript"> 
    alert("用户ID已存在"); 
    window.location.href="register.php"; 
  </script>  
  <?php 
    } 
    mysql_query("insert into student(stuID,stuName,gender,institute,major,email,phone,community,password,status) values('$person','$name','?','?','?','?','?','?','$pass','?')";
    mysql_close($con); 
  ?> 
  <script type="text/javascript"> 
    alert("注册成功"); 
    window.location.href="index.html"; 
  </script> 
    
    
        
      
      
</body> 
</html>