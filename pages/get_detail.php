<?php 
        $c_id="";
        $u_id="";
        $s_id="";
        $a_id="";
        $d_id="";
        $str="";
        
        $k=0;

        if($_GET['c_id']!=""){
            $c_id = rtrim($_GET['c_id'],',');
            $c_id="c_id=".str_replace(","," or c_id=",$c_id);
            $str=$c_id;
            $k++;
        }
        $course=strtoupper($_GET['course']);
        include "../includes/mysql_connect.php";
        $conn=connect_mysql();

        $sql_1="select * from courses where c_name='".$course."'";
        if(($c_id1=$conn->query($sql_1)->fetch_assoc()['id']) || $course=='ALL'){
        if($course!='ALL'){
            if($c_id!=""){
                $str=" (".$c_id.")";
            }else{
                $str=" ( c_id=".$c_id1.")";
            }
                if($_GET['u_id']!=""){
                    $u_id = rtrim($_GET['u_id'],',');
                    $u_id="u_id=".str_replace(","," or u_id=",$u_id);
                    $str=$str." and (".$u_id.")";
                }
                if($_GET['s_id']!=""){
                    $s_id = rtrim($_GET['s_id'],',');
                    $s_id="s_id=".str_replace(","," or s_id=",$s_id);
                    $str=$str." and (".$s_id.")";
                }
                if($_GET['a_id']!=""){
                    $a_id = rtrim($_GET['a_id'],',');
                    $a_id="a_id=".str_replace(","," or a_id=",$a_id);
                    $str=$str." and (".$a_id.")";
                }
                if($_GET['d_id']!=""){
                    $d_id = rtrim($_GET['d_id'],',');
                    $d_id="d_mode_id=".str_replace(","," or d_mode_id=",$d_id);
                    $str=$str." and (".$d_id.")";
                }
            $sql_2="select * from full_detail where ".$str;
        }else{
            if($c_id!=""){
                $str=" (".$c_id.")";
            }
                if($_GET['u_id']!=""){
                    $u_id = rtrim($_GET['u_id'],',');
                    $u_id="u_id=".str_replace(","," or u_id=",$u_id);
                    if($k!=0)
                        $str=$str." and (".$u_id.")";
                    else
                        $str=$str." (".$u_id.")";
                    $k++;
                }
                if($_GET['s_id']!=""){
                    $s_id = rtrim($_GET['s_id'],',');
                    $s_id="s_id=".str_replace(","," or s_id=",$s_id);
                    if($k!=0)
                        $str=$str." and (".$s_id.")";
                    else
                        $str=$str." (".$s_id.")";
                    $k++;
                }
                if($_GET['a_id']!=""){
                    $a_id = rtrim($_GET['a_id'],',');
                    $a_id="a_id like '%".str_replace(",","%' or a_id like '%",$a_id)."%'";
                    if($k!=0)
                        $str=$str." and (".$a_id.")";
                    else
                        $str=$str." (".$a_id.")";
                }
                if($_GET['d_id']!=""){
                    $d_id = rtrim($_GET['d_id'],',');
                    $d_id="d_mode_id=".str_replace(","," or d_mode_id=",$d_id);
                    if($k!=0)
                        $str=$str." and (".$d_id.")";
                    else
                        $str=$str." (".$d_id.")";
                    $k++;
                }
            if($str==""){
                $sql_2="select * from full_detail ";
            }else{
                $sql_2="select * from full_detail where ".$str;
            }
        }
        $res_2=$conn->query($sql_2);
      ?>
        <div class="course_results__head">
            <h3>FOUND <b id="num_res"><?php  echo $conn->query("select count(c_id) as c from (".$sql_2.") as t")->fetch_assoc()['c']; ?></b> RESULT(S) <?php if( count(explode(',',$_GET['c_id']))<=1 && $course!='ALL'){?> FOR <b id="course"><?php echo strtoupper($course);?></b><?php }?> </h3>

        </div>

        <div class="course_results__container" >
            <?php
                while($row_2=$res_2->fetch_assoc()){
                    $res_u=$conn->query("select * from universities where u_id=".$row_2['u_id'])->fetch_assoc();
            ?>
          <div class="course_results__item">
            <div class="course_results__item__img">
              <img src="<?php echo ".".$res_u['img_src'];?>" />
            </div>
            <div class="course_results__item__content">
              <div class="course_results__item__content__head">
                <h4><a href=""><?php echo $conn->query("select * from courses where id=".$row_2['c_id'])->fetch_assoc()['c_name'];?> IN <?php echo $conn->query("select * from subject where id=".$row_2['s_id'])->fetch_assoc()['sub_name']; ?></a></h4>
                <h5><?php echo $res_u['u_name']?></h5>
              </div>
              <div class="course_results__item__content__info">
                <div class="course_results__item__content__info__dur">
                  <img src="../assets/svg/Icons/red/stopwatch.svg" />
                  <h5><?php echo $row_2['duration']?> years</h5>
                </div>
                <div class="course_results__item__content__info__dm">
                  <h5>delivery mode</h5>
                  <h6><?php echo $conn->query("select * from delivery_mode where id=".$row_2['d_mode_id'])->fetch_assoc()['d_mode'];?></h6>
                </div>
              </div>
              <div class="course_results__item__content__price">
                <h3>Rs <?php echo $row_2['fees']?> <span>(annual)</span></h3>
              </div>
            </div>
            <div class="course_results__item__buttons">
              <button onclick=<?php echo "\"window.location.href='./course-detail.php?id=".$row_2['id']."'\""; ?>  >go to course</button>
              <button>add to compare</button>
            </div>
          </div>
            <?php } ?>

        </div>
        <?php } ?>