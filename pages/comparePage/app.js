const modal = document.getElementsByClassName('modal')[0];

// Get the button that opens the modal
const btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
const span = document.getElementsByClassName("close")[0];

const compare__bg =document.getElementsByClassName("compare_bg")[0];

var fill=['not','not','not','not'];
var f_id=[0,0,0,0];

function compare_(a) {
  modal.style.display = "block";
  compare__bg.style.display="block";
  var add_remove_=document.getElementsByName("add_remove_");
  var course_=document.getElementsByName("course_");
  var fees_=document.getElementsByName("fees_");
  var desc_=document.getElementsByName("desc_");
  var sub_=document.getElementsByName("sub_");
  var pay_type=document.getElementsByName("pay_type");
  var duration_=document.getElementsByName("duration_");
  var eligibility_=document.getElementsByName("eligibility_");
  var univ_=document.getElementsByName("univ_");
  for(var i=0;i<4;i++){
    if(fill[i]=='not'){
      fill[i]='fill';
      var f=new FormData();
      f.append('id',a);
      $.ajax({
        url: "./comparePage/get_info.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: f,
        complete: function (data) {
            console.log(data.responseText);
            if(data.responseText==''){
              
            }else{
                alert("Something went wrong submit again");
            }
        }
      });
      add_remove_[i].innerHTML='<button class="modal--content__comparisontable__row__remove"><i class="far fa-trash-alt"></i>REMOVE</i></button>    <img class="c_univ" src="https://upload.wikimedia.org/wikipedia/en/c/c2/Assam_Down_Town_University_logo.jpg" />';
      
      break;
    }
  }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  compare__bg.style.display="none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    compare__bg.style.display="none";
  }
}