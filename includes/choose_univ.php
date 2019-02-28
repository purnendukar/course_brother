<?php
$condition="";
if(isset($_POST['prog'])){
    if($condition==""){
        $condition.="prg_id=".$_POST['prog'];
    }else{
        $condition.=" and prg_id=".$_POST['prog'];
    }
}
if(isset($_POST['spec'])){
    if($condition==""){
        $condition.="s_id=".$_POST['spec'];
    }else{
        $condition.=" and s_id=".$_POST['spec'];
    }
}
if(isset($_POST['course'])){
    if($condition==""){
        $condition.="c_id=".$_POST['course'];
    }else{
        $condition.=" and c_id=".$_POST['course'];
    }
}
include "./mysql_connect.php";
$conn=connect_mysql();
if($res=$conn->query("select distinct(u_id) as u_id from full_detail where ".$condition)){
    $i=0;
    echo "success";
    while($row=$res->fetch_assoc()){
        $t=$conn->query("select * from universities where u_id=".$row['u_id'])->fetch_assoc();
        if($i>0){
            echo "|";
        }
        echo $t['u_name'].",".$t['u_id'];
        $i++;
    }
}
?>