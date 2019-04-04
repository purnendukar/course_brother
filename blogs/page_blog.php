<?php 
$p=$_GET['p'];
include "../includes/mysql_connect.php";
$conn=connect_mysql();
$res=$conn->query("select * from `blogs`");
for($i=0;$i<12*($p-1);$i++){
    $row=$res->fetch_assoc();
}
$j=0;
while($row=$res->fetch_assoc() ){
    if($j==12){
        break;
    }?>
    <div class="main__contents__snippets">
        <img src="<?php echo ".".$row['thumnail']?>" alt="Blog Image">
        <a href=""><h3><?php echo $row['heading']?></h3></a>
        
        <p><?php echo substr(str_replace('<br>','',$row['content']),0,60)."... <a style='color:red;' href='./blog-detail?id=".$row["id"]."'>Read More</a>";?></p>
    
    </div>
<?php 
    $j++;}
?>
<div style="display:block;width:100%;margin:20px;">
					Page: 
					<?php $p=(int)$conn->query("select count(*) as c from blogs")->fetch_assoc()['c']; 
						for($i=1;$i<=(int)($p+5)/5;$i++){
							echo "<a style='text-decoration:none;margin:10px;' href='javascript:select_page(".$i.");'>".$i."</a> ";
						}
					?>
				</div>