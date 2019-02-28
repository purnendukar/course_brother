function remove_c_addr(a){
    var c_addr=document.getElementsByName('c_addr')[0];
    if(a.checked){
        c_addr.required=false;
        c_addr.disabled=true;
    }else{
        c_addr.required=true;
        c_addr.disabled=false;
    }
}
var page=0;
function next_form(id){
    var s=document.getElementsByClassName("form");
    s[id-1].style.display="none";
    s[id].style.display="block";
    step_select(id);
    page=id;
}
function page_(id){
    var s=document.getElementsByClassName("form");
    if(id<=page){
        for(var i=0;i<s.length;i++){
            s[i].style.display="none";
        }
        s[id].style.display="block";
        step_select(id);
    }
}
function step_select(i){
    var s=document.getElementsByClassName("stepnum");
    for(var j=0;j<s.length;j++){
        if(s[j].style.height=="56px"){
            s[j].style.height="60px";
            s[j].style.borderBottom="none";
        }
    }
    s[i].style.height="56px";
    s[i].style.borderBottom="4px solid white";
}
var program="";
var course="";
var college="";
var delivery_mode="";
var spec="";
function program_select(a){
    program=a;
    var formData=new FormData();
    formData.append("prog",a);
    $.ajax({
        url: "../includes/choose_program.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        complete: function (data) {
            console.log(data.responseText);
            if(data.responseText.includes("success")){
                var t=data.responseText.replace("success","");
                t=t.split("|");
                var course=document.getElementById('_course_');
                while(course.options.length){
                    course.options.remove(i);
                }
                var opt=new Option('Course', '');
                course.options.add(opt);
                for(var i=0;i<t.length;i++){
                    var temp=t[i].split(",");
                    opt= new Option(temp[0], temp[1]);
                    course.options.add(opt);
                }
            }else{
                alert("something went wrong");
            }
        }
    });
}
function _course(a){
    course=a.value;
    var formData=new FormData();
    formData.append("prog",program);
    formData.append("course",course);
    $.ajax({
        url: "../includes/choose_course.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        complete: function (data) {
            console.log(data.responseText);
            if(data.responseText.includes("success")){
                var t=data.responseText.replace("success","");
                t=t.split("|");
                var sub=document.getElementById('specialization');
                while(sub.options.length){
                    sub.options.remove(i);
                }
                var opt=new Option('Specialization', '');
                sub.options.add(opt);
                for(var i=0;i<t.length;i++){
                    var temp=t[i].split(",");
                    opt= new Option(temp[0], temp[1]);
                    sub.options.add(opt);
                }
            }else{
                alert("something went wrong");
            }
        }
    });
}
function _sub(a){
    spec=a.value;
    var formData=new FormData();
    formData.append("prog",program);
    formData.append("course",course);
    formData.append("spec",spec);
    $.ajax({
        url: "../includes/choose_univ.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        complete: function (data) {
            console.log(data.responseText);
            if(data.responseText.includes("success")){
                var t=data.responseText.replace("success","");
                t=t.split("|");
                var college=document.getElementById('college');
                while(college.options.length){
                    college.options.remove(i);
                }
                var opt=new Option('College', '');
                college.options.add(opt);
                for(var i=0;i<t.length;i++){
                    var temp=t[i].split(",");
                    opt= new Option(temp[0], temp[1]);
                    college.options.add(opt);
                }
            }else{
                alert("something went wrong");
            }
        }
    });
}
function _univ(a){
    college=a.value;
    var formData=new FormData();
    formData.append("prog",program);
    formData.append("course",course);
    formData.append("spec",spec);
    formData.append("coll",college);
    $.ajax({
        url: "../includes/choose_dmode.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        complete: function (data) {
            console.log(data.responseText);
            if(data.responseText.includes("success")){
                var t=data.responseText.replace("success","");
                t=t.split("|");
                var delivery_mode=document.getElementById('delivery_mode');
                while(delivery_mode.options.length){
                    delivery_mode.options.remove(i);
                }
                var opt=new Option('Delivery mode', '');
                delivery_mode.options.add(opt);
                for(var i=0;i<t.length;i++){
                    var temp=t[i].split(",");
                    opt= new Option(temp[0], temp[1]);
                    delivery_mode.options.add(opt);
                }
            }else{
                alert("something went wrong");
            }
        }
    });
}
$(document).ready(function(){
    var s=document.getElementsByClassName("stepnum");
    s[0].style.height="56px";
    s[0].style.borderBottom="4px solid white";
});