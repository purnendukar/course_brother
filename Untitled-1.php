<?php 
$e_id="2";
 echo "<script> var now= new Date();
 var now=new Date();
 console.log(now.toUTCString());
 now.setTime(now.getTime()- 30*24*60*60*1000);
 console.log(now.toUTCString());
 var tr=now.toUTCString();
document.cookie=\"e_id=".$e_id.";\expires=\"+tr+\"path=/\"; document.write(document.cookie);</script>"; 

setcookie("e_id",'2',time()-10,"/");

//Thu, 01 Jan 1970 00:00:00 UTC
?>
