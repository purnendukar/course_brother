<?php

$id_l="";
$conn=connect_mysql();
function set_s_cookie($e_id){
            
            try{
                $sql="INSERT INTO `enquire`(`email`, `name`, `city`, `phn_no`) VALUES ( '".$e_id."', '";
                if(isset($_POST['full_name'])){
                    $sql=$sql.$_POST['full_name']."', '";
                }
                if(isset($_POST['c_name'])){
                    $sql=$sql.$_POST['c_name']."', '";
                }
                if(isset($_POST['phn_num'])){
                    $sql=$sql.$_POST['phn_num']."')";
                }
                $conn->query($sql);
            }catch(Exception $e){
                
            }
            $sql="select * from user_session where email='".$e_id."'";
            $id=$conn->query($sql)->fetch_assoc()['id'];
            $sql="INSERT INTO user_session_track (user_id,page) VALUES (".$id.",'".$_SERVER['REQUEST_URI']."')";
            if($conn->query($sql)){echo "<script>alert('Enquiry send');</script>";}
}

    if(isset($_POST['e_id'])){
        if($_POST['e_id']!=''){
            $e_id=$_POST['e_id'];
            set_s_cookie($e_id);
        }
    }
?>
<!-- NEWSlETTER_POPUP -->
<div class="newsletter_popup__backdrop"></div>
<div class="newsletter_popup">
  <div class="newsletter_popup__main">
    <div class="newsletter_popup__main__close"><i class="fa fa-times"></i></div>
    <h2 class='newsletter_popup__main__title'><?php echo $conn->query("select * from lead_popup where id=1")->fetch_assoc()['head'];?></h2>
    <div class="newsletter_popup__main__form">
      <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <input name="full_name" type="text" placeholder='your full name'>
        <input name="c_name" type="text" placeholder='your city name'>
        <input name="phn_num" type="tel" placeholder='your phone number'>
        <input name="e_id" type="email" placeholder='your email address' required>
        <span>
          <input type="submit" value="yes, i'm in">
          <div>no, thanks</div>
        </span>
      </form>
    </div>
  </div>
</div>

<!-- /NEWSlETTER_POPUP -->

?>

