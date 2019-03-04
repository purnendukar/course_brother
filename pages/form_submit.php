<?php
    include "../includes/mysql_connect.php";
    $conn=connect_mysql();

    $s_name=$_POST['s_name'];
    $f_name=$_POST['f_name'];
    $m_name=$_POST['m_name'];
    $phn_no=$_POST['phn_no'];
    $a_phn_no=$_POST['a_phn_no'];
    $p_addr=$_POST['p_addr'];
    $c_addr=$_POST['c_addr'];
    $email=$_POST['email'];
    $a_email=$_POST['a_email'];
    $prg=$_POST['prg'];
    $college=$_POST['college'];
    $spec=$_POST['spec'];
    $d_mode=$_POST['d_mode'];
    $course=$_POST['course'];
    $inst_10=$_POST['10_inst'];
    $_board_10=$_POST['10_board'];
    $c_year_10=$_POST['10_c_year'];
    $percent_10=$_POST['10_percent'];

    $f_id=$conn->query("select * from full_detail where u_id=".$college." and c_id=".$course." and prg_id=".$prg." and d_mode_id=".$d_mode." and s_id=".$spec)->fetch_assoc()['id'];
    $path="";
    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $t=explode('.',$_FILES['image']['name']);
        $file_ext=strtolower(end($t));

        $file_path="../admin/assets/images/student_identity/";

        $extensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        if(empty($errors)==true){
          $path=$file_path.rand().$file_name;
            if(move_uploaded_file($file_tmp,$path)){
                if($res=$conn->query("INSERT INTO `admission_form`(`stud_name`, `father_name`, `mother_name`, `email`, `phn_no`, `p_addr`, `c_addr`, `a_email`, `a_phn_no`, `indentity`, `f_d_id`) VALUES ('".urlencode($s_name)."','".urlencode($f_name)."','".urlencode($m_name)."','".urlencode($email)."','".urlencode($phn_no)."','".urlencode($p_addr)."','".urlencode($c_addr)."','".urlencode($a_email)."','".urlencode($a_phn_no)."','".$path."','".$f_id."')")){
                    $a_id=$conn->query("SELECT max(id) as id from `admission_form` where email='".urlencode($email)."'")->fetch_assoc()['id'];
                    if($conn->query("INSERT INTO `10th_education`(`a_id`, `school_name`, `percentage`, `board`, `c_year`) VALUES ('".$a_id."','".urlencode($inst_10)."','".urlencode($percent_10)."','".urlencode($_board_10)."','".urlencode($c_year_10)."')")){
                        echo "1";
                    }else{
                        echo "0";
                    }
                    if(isset($_POST['12_inst'])){
                        $inst_12=$_POST['12_inst'];
                        $_board_12=$_POST['12_board'];
                        $c_year_12=$_POST['12_c_year'];
                        $percent_12=$_POST['12_percent'];
                        $degree=$_POST['12_degree'];
                        $spec_t=$_POST['12_spec'];
                        if($conn->query("INSERT INTO `12th_diploma`(`a_id`, `institute`, `degree`, `specialisation`, `percentage`, `board`,`c_year`) VALUES ('".$a_id."','".urlencode($inst_12)."','".urlencode($degree)."','".urlencode($spec_t)."','".urlencode($percent_12)."','".urlencode($_board_12)."','".urlencode($c_year_12)."')")){
                            echo "1";
                        }else{
                            echo "0";
                        }
                    }
                    if(isset($_POST['g_inst'])){
                        $inst_g=$_POST['g_inst'];
                        $board_g=$_POST['g_board'];
                        $c_year_g=$_POST['g_c_year'];
                        $percent_g=$_POST['g_percent'];
                        $degree=$_POST['g_degree'];
                        $spec_t=$_POST['g_spec'];
                        if($conn->query("INSERT INTO `graduation`(`a_id`, `institute`, `degree`, `specialisation`, `percentage`, `board`,`c_year`) VALUES ('".$a_id."','".urlencode($inst_g)."','".urlencode($degree)."','".urlencode($spec_t)."','".urlencode($percent_g)."','".urlencode($board_g)."','".urlencode($c_year_g)."')")){
                            echo "1";
                        }else{
                            echo "0";
                        }
                    }
                    $conn->query("INSERT INTO `user_cart`(`email`, `a_id`) VALUES ('".urldecode($_COOKIE['email'])."','".$a_id."')");
                }
            }
        }else{
            print_r($errors);
        }
    }else{
        echo "0";
    }
?>