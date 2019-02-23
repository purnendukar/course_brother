<?php

require_once 'dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

include "../includes/mysql_connect.php";
$conn=connect_mysql();
$user_info=$conn->query("select * from register_user where email='".urldecode($_COOKIE['email'])."'")->fetch_assoc();
$str='<div><h1 style="font-size:30px;">'.$user_info['f_name'].' '.$user_info['l_name'].'</h1><p style="font-size:18px;">'.$user_info['email'].'</p><p style="font-size:18px;">'.$user_info['phn_no'].'</p></div>';
$user_info=$conn->query("select * from user_education where email='".urldecode($_COOKIE['email'])."'");
if($row=$user_info->fetch_assoc()){
    $str.='<hr style="border-color:#9A9A9A;"><table><tr><td style="color:#0387B0;font-size:25px;width:200px;vertical-align:top;"><p>Education</p></td><td><div style="color:#6C6C6C;"><p style="font-size:20px;color:black">'.urldecode($row['degree']).' ('.$row['join_year'].' - '.$row['complete_year'].')</p>'.urldecode($row['organisation']).'</div>';
    while($row=$user_info->fetch_assoc()){
        $str.='<div style="color:#6C6C6C;"><p style="font-size:20px;color:black;">'.urldecode($row['degree']).' ('.$row['join_year'].' - '.$row['complete_year'].')</p>'.urldecode($row['organisation']).'</div>';
    }
    $str.='</td></tr></table>';

}

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($str);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'horizontal');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>