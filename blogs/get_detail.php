<?php 
$y=$_GET['y'];
$m=$_GET['m'];
$str="%".$y."-".$m."%";
include "../includes/mysql_connect.php";
$conn=connect_mysql();
$res=$conn->query("SELECT * FROM `blogs` WHERE created like '".$str."'");
while($row=$res->fetch_assoc()){?>
    <div class="main__contents__snippets">
        <img src="<?php echo ".".$row['thumnail']?>" alt="Blog Image">
        <a href=""><h3><?php echo $row['heading']?></h3></a>
        
        <p><?php echo substr(str_replace('<br>','',$row['content']),0,60)."... <a style='color:red;' href='./blog-detail?id=".$row["id"]."'>Read More</a>";?></p>
    
    </div>
<?php }
?>