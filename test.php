<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql="SELECT * FROM full_detail";
    $res=$conn->query($sql);
    while($row=$res->fetch_assoc()){
       $u_name=$conn->query("SELECT * FROM `universities` where u_id=".$row['u_id'])->fetch_assoc()['u_name'];
       $c_name=$conn->query("SELECT * FROM `courses` where id=".$row['c_id'])->fetch_assoc()['c_name'];
       $path=strtolower($u_name);
       if(!(file_exists($path))){
            mkdir($path);
            
        }
        $path=strtolower($u_name)."/".strtolower($c_name);
        if(!(file_exists($path))){
            mkdir($path);
        }
        $d_mode=$conn->query("SELECT * FROM `delivery_mode` where id=".$row['d_mode_id'])->fetch_assoc()['d_mode'];
        $path=strtolower($u_name)."/".strtolower($c_name)."/".strtolower($d_mode);
        if(!(file_exists($path))){
            mkdir($path);
        }
       $sub=$conn->query("SELECT * FROM `subject` where id=".$row['s_id'])->fetch_assoc()['sub_name'];
       
       $myfile = fopen($path."/".strtolower($sub).".php", "w") or die("Unable to open file!");
        $txt = 
"<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Course Brother | ".ucfirst(strtolower($c_name))." in ".ucfirst(strtolower($sub))." from ".ucfirst(strtolower($u_name))." </title>
        <meta name='description' content='".$row['meta_desc']."'>
        <meta name='keywords' content='course brother, coursebrother,".$row['meta_key']."'>
        <meta name='author' content='course brother'>
        <script>window.location.href='../../../pages/course-detail?id='+".$row['id']."</script>
    </head>
</html>";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
    
?>