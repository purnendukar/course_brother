<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
  ob_start("ob_gzhandler");
else
  ob_start();

require_once './dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

include "../includes/mysql_connect.php";
$conn=connect_mysql();
$user_info=$conn->query("select * from register_user where email='".urldecode($_COOKIE['email'])."'")->fetch_assoc();
$str='<div><h1 style="font-size:30px;">'.$user_info['f_name'].' '.$user_info['l_name'].'</h1><p style="font-size:18px;">'.$user_info['email'].'</p><p style="font-size:18px;">'.$user_info['phn_no'].'</p></div>';
$user_info=$conn->query("select * from user_education where email='".urldecode($_COOKIE['email'])."'");
if($row=$user_info->fetch_assoc()){
    $str.='<hr style="border-color:#9A9A9A;"><table><tr><td style="color:#0387B0;font-size:25px;width:210px;vertical-align:top;"><p>Education</p></td><td><div style="color:#6C6C6C;"><p style="font-size:20px;color:black">'.urldecode($row['degree']).' ('.$row['join_year'].' - '.$row['complete_year'].')</p>'.urldecode($row['organisation']).'</div>';
    while($row=$user_info->fetch_assoc()){
        $str.='<div style="color:#6C6C6C;"><p style="font-size:20px;color:black;">'.urldecode($row['degree']).' ('.$row['join_year'].' - '.$row['complete_year'].')</p>'.urldecode($row['organisation']).'</div>';
    }
    $str.='</td></tr></table>';
}
$user_info=$conn->query("SELECT * FROM `user_work_exp` where email='".urldecode($_COOKIE['email'])."'");
if($row=$user_info->fetch_assoc()){
    $str.='<hr style="border-color:#9A9A9A;"><table><tr><td style="color:#0387B0;font-size:25px;width:210px;vertical-align:top;"><p>Work Experience</p></td><td><div style="color:#6C6C6C;"><p style="font-size:20px;color:black">'.urldecode($row['position']).' ('.$row['start_date'].' - '.$row['end_date'].')</p>'.urldecode($row['company_name']).'</div>';
    while($row=$user_info->fetch_assoc()){
        $str.='<div style="color:#6C6C6C;"><p style="font-size:20px;color:black;">'.urldecode($row['position']).' ('.$row['start_date'].' - '.$row['end_date'].')</p>'.urldecode($row['company_name']).'</div>';
    }
    $str.='</td></tr></table>';
}
$user_info=$conn->query("select * from user_info where email='".$_COOKIE['email']."'");
if($row=$user_info->fetch_assoc()){
    $skill=explode(",",urldecode($row['skills']));
    $str.='<hr style="border-color:#9A9A9A;"><table><tr><td style="color:#0387B0;font-size:25px;width:210px;vertical-align:top;"><p>Professional Skills</p></td><td style="width:200px;vertical-align:top;">';
    $td=true;
    for($i=0;$i<count($skill);$i++){
        if($i<(count($skill)+1)/2){
            $str.='<p style="font-size:20px;color:black">'.$skill[$i].'</p>';
        }else{
            if($td==true){
                $td=false;
                $str.='</td><td style="width:200px;vertical-align:top;" ><p style="font-size:20px;color:black">'.$skill[$i++].'</p>';
            }else{
                $str.='<p style="font-size:20px;color:black">'.$skill[$i++].'</p>';
            }
        }
    }
    $str.='</td></tr></table>';
}
$user_info=$conn->query("SELECT * FROM `user_award` where email='".urldecode($_COOKIE['email'])."'");
if($row=$user_info->fetch_assoc()){
    $str.='<hr style="border-color:#9A9A9A;"><table><tr><td style="color:#0387B0;font-size:25px;width:210px;vertical-align:top;"><p>Awards </p></td><td><p style="font-size:20px;color:black">'.urldecode($row['award']).' ( '.$row['award_date'].' )</p>';
    while($row=$user_info->fetch_assoc()){
        $str.='<p style="font-size:20px;color:black">'.urldecode($row['award']).' ( '.$row['award_date'].' )</p>';
    }
    $str.='</td></tr></table>';
}

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($str);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4','vertical');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Resume", array("Attachment"=>1));
?>