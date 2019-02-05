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
        $id=$row['id'];
        $c_id=$row['c_id'];
        $s_id=$row['s_id'];
        $overview=$conn->query("select c_name from courses where id=".$c_id)->fetch_assoc()['c_name']." in ".$conn->query("select sub_name from subject where id=".$c_id)->fetch_assoc()['sub_name'].", gives students a customized, industry-centered system which cooperates with organizations known for store network brilliance. We give understudies an excellent interdisciplinary instruction that expands on basic information and joins the most recent in inventory  network considering. The vital, cross-useful educational modules takes a coordinated business process perspective of supply chains, including showcasing, sourcing, logistics, operations, and client administration. Understudies associate with and gain from true inventory network pioneers and are a piece of a solid, affectionate group.";
        $structure="";
        for($i=0;$i<$row['duration'];$i++){
            $structure=$structure."Networking and Marketing <br>Supply Chain Basics | Marketing Strategies <br>Internet of Things Basics |";
        }
        
        $sql_1="INSERT INTO about_course (id, overview, structure) VALUES (".$id.",'".$overview."','".$structure."')";
        if($conn->query($sql_1)){
            echo "success";
        }else{
            echo "fail ";
            echo $conn->error;
            echo " NNNNNNNNN  ";
        }
    }
    
?>