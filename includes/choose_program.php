<?php
$condition="";
if(isset($_POST['prog'])){
    if($condition==""){
        $condition.="prg_id=".$_POST['prog'];
    }else{
        $condition.=" and prg_id=".$_POST['prog'];
    }
}
// if(isset($_POST['spec'])){
//     if($condition==""){
//         $condition.="s_id=".$_POST['spec'];
//     }else{
//         $condition.=" and s_id=".$_POST['spec'];
//     }
// }
// if(isset($_POST['course'])){
//     if($condition==""){
//         $condition.="c_id=".$_POST['course'];
//     }else{
//         $condition.=" and c_id=".$_POST['course'];
//     }
// }
// if(isset($_POST['coll'])){
//     if($condition==""){
//         $condition.="u_id=".$_POST['coll'];
//     }else{
//         $condition.=" and u_id=".$_POST['coll'];
//     }
// }
// if(isset($_POST['del_m'])){
//     if($condition==""){
//         $condition.="d_mode_id=".$_POST['del_m'];
//     }else{
//         $condition.=" and d_mode_id=".$_POST['del_m'];
//     }
// }
include "./mysql_connect.php";
$conn=connect_mysql();
if($res=$conn->query("select distinct(c_id) as c_id from full_detail where ".$condition)){
    $i=0;
    echo "success";
    while($row=$res->fetch_assoc()){
        $t=$conn->query("select * from courses where id=".$row['c_id'])->fetch_assoc();
        if($i>0){
            echo "|";
        }
        echo $t['c_name'].",".$t['id'];
        $i++;
    }
}
?>