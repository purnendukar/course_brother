const modal = document.getElementsByClassName('modal')[0];

// Get the button that opens the modal
const btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
const span = document.getElementsByClassName("close")[0];

const compare__bg =document.getElementsByClassName("compare_bg")[0];

var fill=['not','not','not','not'];
var f_id=[0,0,0,0];

var add_remove_=document.getElementsByName("add_remove_");
var _course_=document.getElementsByName("course_");
var fees_=document.getElementsByName("fees_");
var desc_=document.getElementsByName("desc_");
var sub_=document.getElementsByName("sub_");
var pay_type=document.getElementsByName("pay_type");
var duration_=document.getElementsByName("duration_");
var eligibility_=document.getElementsByName("eligibility_");
var univ_=document.getElementsByName("univ_");
var d_mode_=document.getElementsByName("d_mode_");
var apply_=document.getElementsByName("apply_");
var j_temp=0;

function add_compare(a){
  j_temp=a;
  modal.style.display = "none";
  compare__bg.style.display="none";
}

function compare_(a) {
  modal.style.display = "block";
  compare__bg.style.display="block";
  for(var i=0;i<4;i++){
    if(i==j_temp){
      fill[i]='fill';
      var f=new FormData();
      f.append('id',a);
      var info="";
      $.ajax({
        url: "./comparePage/get_info.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: f,
        complete: function (data) {
            if(data.responseText.indexOf("`")){
              info=data.responseText.split("`");
              add_remove_[i].innerHTML='<button class="modal--content__comparisontable__row__remove" onclick="remove_compare(\''+i+'\')" ><i class="far fa-trash-alt"></i>REMOVE</button><img class="c_univ" src=".'+info[0].toString()+'" />';
              _course_[i].classList.add("modal--content__comparisontable__row__tag_");
              _course_[i].innerHTML=info[1];
              fees_[i].innerHTML="Rs "+info[6];
              fees_[i].classList.add("modal--content__comparisontable__row__tag_");
              desc_[i].innerHTML=info[4];
              desc_[i].classList.add("modal--content__comparisontable__row__tag_");
              sub_[i].innerHTML=info[3];
              sub_[i].classList.add("modal--content__comparisontable__row__tag_");
              univ_[i].innerHTML=info[2];
              univ_[i].classList.add("modal--content__comparisontable__row__tag_");
              if(info[5]>1){
                duration_[i].innerHTML=info[5]+" Years";
                duration_[i].classList.add("modal--content__comparisontable__row__tag_");
              }else{
                duration_[i].innerHTML=info[5]+"Year";
                duration_[i].classList.add("modal--content__comparisontable__row__tag_");
              }
              d_mode_[i].innerHTML=info[7];
              d_mode_[i].classList.add("modal--content__comparisontable__row__tag_");
              apply_[i].innerHTML="<button onclick=\"window.location.href='./course-detail?id="+a+"'\">APPLY NOW</button>";
            }else{
                alert("Something went wrong try again again");
            }
        }
      });
      break;
    }
  }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  j_temp=0;
  modal.style.display = "none";
  compare__bg.style.display="none";
  for(var i=0;i<4;i++){
    fill[i]='not';
    add_remove_[i].innerHTML='<div class="add"  onclick="add_compare('+i+')"><i class="fas fa-plus"></i>';
    _course_[i].innerHTML="";
    fees_[i].innerHTML="";
    desc_[i].innerHTML="";
    sub_[i].innerHTML="";
    univ_[i].innerHTML='';
    duration_[i].innerHTML="";
    d_mode_[i].innerHTML="";
    _course_[i].classList.remove("modal--content__comparisontable__row__tag_");
    fees_[i].classList.remove("modal--content__comparisontable__row__tag_");
    desc_[i].classList.remove("modal--content__comparisontable__row__tag_");
    sub_[i].classList.remove("modal--content__comparisontable__row__tag_");
    univ_[i].classList.remove("modal--content__comparisontable__row__tag_");
    duration_[i].classList.remove("modal--content__comparisontable__row__tag_");
    d_mode_[i].classList.remove("modal--content__comparisontable__row__tag_");
    apply_[i].innnerHTML="";
  }
}



// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == compare__bg) {
//     j_temp=0;
//     modal.style.display = "none";
//     compare__bg.style.display="none";
//     for(var i=0;i<4;i++){
//       fill[i]='not';
//       add_remove_[i].innerHTML='<div class="add" onclick="add_compare('+i+')"><i class="fas fa-plus"></i>';
//       _course_[i].innerHTML="";
//       fees_[i].innerHTML="";
//       desc_[i].innerHTML="";
//       sub_[i].innerHTML="";
//       univ_[i].innerHTML='';
//       duration_[i].innerHTML="";
//       d_mode_[i].innerHTML="";
      
//       _course_[i].classList.remove("modal--content__comparisontable__row__tag_");
//       fees_[i].classList.remove("modal--content__comparisontable__row__tag_");
//       desc_[i].classList.remove("modal--content__comparisontable__row__tag_");
//       sub_[i].classList.remove("modal--content__comparisontable__row__tag_");
//       univ_[i].classList.remove("modal--content__comparisontable__row__tag_");
//       duration_[i].classList.remove("modal--content__comparisontable__row__tag_");
//       d_mode_[i].classList.remove("modal--content__comparisontable__row__tag_");
//       apply_[i].innnerHTML="";
//     }
//   }
// }

function remove_compare(a){
  i=a;
  add_remove_[i].innerHTML='<div class="add" onclick="add_compare('+i+')"><i class="fas fa-plus"></i>';
  _course_[i].innerHTML="";
  fees_[i].innerHTML="";
  desc_[i].innerHTML="";
  sub_[i].innerHTML="";
  univ_[i].innerHTML='';
  duration_[i].innerHTML="";
  d_mode_[i].innerHTML="";
  
  _course_[i].classList.remove("modal--content__comparisontable__row__tag_");
  fees_[i].classList.remove("modal--content__comparisontable__row__tag_");
  desc_[i].classList.remove("modal--content__comparisontable__row__tag_");
  sub_[i].classList.remove("modal--content__comparisontable__row__tag_");
  univ_[i].classList.remove("modal--content__comparisontable__row__tag_");
  duration_[i].classList.remove("modal--content__comparisontable__row__tag_");
  d_mode_[i].classList.remove("modal--content__comparisontable__row__tag_");
  apply_[i].innnerHTML="";
}
function send_enquire(){
  var input_=getElementsByName("help_");
  var f=new FormData();
  f.append("uname",input_[0]);
  f.append("email",input_[1]);
  f.append("phn",input_[2]);
  $.ajax({
    url: "./help_enquire.php",
    type: 'POST',
    cache: false,
    contentType: false,
    processData: false,
    data: f,
    complete: function (data) {
      if(data.responseText=='1'){
        alert("Enquiry send.")
        for(var i=0;i<input_.length;i++){
          input_[i].value="";
        }
      }else{
        console.log(data.responseText);
        alert("Something went Wrong");
      }
    }
  });
}