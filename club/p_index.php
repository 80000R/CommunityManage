<?php
$stuID = $_GET['studentID'];
?>
<html>
  <head>
    <title>Student</title>
  </head>
  <frameset rows="8%,*">
    <frame src="p_topFrame.html" name="topFrame" scrolling="No" id="topFrame" />
  <frameset rows="*" cols="16%,*" framespacing="0" frameborder="no" border="0">
    <frame src="p_leftFrame.php?studentID=<?php echo $stuID;?>" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" />
    <frame src="p_clubJoined.php?studentID=<?php echo $stuID;?>" name="mainFrame" id="mainFrame" />
  </frameset>
  </frameset>
</html>