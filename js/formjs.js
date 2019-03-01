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
    if(page==2){
        acadamic_details_needed();
    }
}
function page_(id){
    var s=document.getElementsByClassName("form");
    if(id<=page){
        for(var i=0;i<s.length;i++){
            s[i].style.display="none";
        }
        s[id].style.display="block";
        step_select(id);
        page=id;
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
    try{
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
                        course.options.remove(0);
                    }
                    var opt=new Option('Course', '');
                    course.options.add(opt);
                    for(var i=0;i<t.length;i++){
                        var temp=t[i].split(",");
                        opt= new Option(temp[0], temp[1]);
                        course.options.add(opt);
                    }
                    _course('');
                }else{
                    var course=document.getElementById('_course_');
                    while(course.options.length){
                        course.options.remove(0);
                    }
                    _course('');
                }
            }
        });
    }catch(err){
        var course=document.getElementById('_course_');
        while(course.options.length){
            course.options.remove(0);
        }
        _course('');
    }
}
function _course(a){
    try{
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
                        sub.options.remove(0);
                    }
                    var opt=new Option('Specialization', '');
                    sub.options.add(opt);
                    for(var i=0;i<t.length;i++){
                        var temp=t[i].split(",");
                        opt= new Option(temp[0], temp[1]);
                        sub.options.add(opt);
                    }
                    _sub('');
                }else{
                    var sub=document.getElementById('specialization');
                    while(sub.options.length){
                        sub.options.remove(0);
                    }
                    var opt=new Option('Specialization', '');
                    sub.options.add(opt);
                    _sub('');
                }
            }
        });
    }catch(err){
        var sub=document.getElementById('specialization');
        while(sub.options.length){
            sub.options.remove(0);
        }
        var opt=new Option('Specialization', '');
        sub.options.add(opt);
        _sub('');
    }
}
function _sub(a){
    try{
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
                        college.options.remove(0);
                    }
                    var opt=new Option('College', '');
                    college.options.add(opt);
                    for(var i=0;i<t.length;i++){
                        var temp=t[i].split(",");
                        opt= new Option(temp[0], temp[1]);
                        college.options.add(opt);
                    }
                    _univ('');
                }else{
                    var college=document.getElementById('college');
                    while(college.options.length){
                        college.options.remove(i);
                    }
                    var opt=new Option('College', '');
                    college.options.add(opt);
                    _univ('');
                }
            }
        });
    }catch(err){
        var college=document.getElementById('college');
        while(college.options.length){
            college.options.remove(i);
        }
        var opt=new Option('College', '');
        college.options.add(opt);
        _univ('');
    }
}
function _univ(a){
    try{
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
                        delivery_mode.options.remove(0);
                    }
                    var opt=new Option('Delivery mode', '');
                    delivery_mode.options.add(opt);
                    for(var i=0;i<t.length;i++){
                        var temp=t[i].split(",");
                        opt= new Option(temp[0], temp[1]);
                        delivery_mode.options.add(opt);
                    }
                }else{
                    var delivery_mode=document.getElementById('delivery_mode');
                    while(delivery_mode.options.length){
                        delivery_mode.options.remove(i);
                    }
                    var opt=new Option('Delivery mode', '');
                    delivery_mode.options.add(opt);
                }
            }
        });
    }catch(err){
        var delivery_mode=document.getElementById('delivery_mode');
        while(delivery_mode.options.length){
            delivery_mode.options.remove(i);
        }
        var opt=new Option('Delivery mode', '');
        delivery_mode.options.add(opt);
    }
}
$(document).ready(function(){
    var s=document.getElementsByClassName("stepnum");
    s[0].style.height="56px";
    s[0].style.borderBottom="4px solid white";
});
function hs_diploma(a){
    var t=a.value;
    var univ=document.getElementsByName("univ")[0];
    var d_spec=document.getElementsByName("d_spec")[0];
    if(t=="Diploma"){
        univ.placeholder="Name of College";
        d_spec.placeholder="Specialisation";
    }else{
        univ.placeholder="Name of School";
        d_spec.placeholder="Stream";
    }
}
function acadamic_details_needed(){
    var g=document.getElementById("graduation");
    var d=document.getElementById("12th_diploma");
    if(program=='1' || program=='5'){
        g.style.display="block";
        d.style.display="block";
    }else if(program=='3' || program=="4"){
        g.style.display="none";
        d.style.display="none";
    }else{
        g.style.display="none";
        d.style.display="block";
    }
}
function add_to_cart(){
    var salutation=document.getElementsByName("salutation");
    var s_name=salutation[0].value+" "+document.getElementsByName("f_name")[0].value+" "+document.getElementsByName("l_name")[0].value;
    var f_name=salutation[1].value+" "+document.getElementsByName("f_f_name")[0].value+" "+document.getElementsByName("f_l_name")[0].value;
    var m_name=salutation[3].value+" "+document.getElementsByName("m_f_name")[0].value+" "+document.getElementsByName("m_l_name")[0].value;
    var t=document.getElementsByName("phn_no");
    var phn_no=t[0].value;
    var a_phn_no="";
    if(t[1].value!=""){
        a_phn_no=t[1].value;
    }
    var t=document.getElementsByName("email");
    var email=t[0].value;
    var a_email
    if(t[1].value!=""){
        a_email=t[1].value;
    }
    var p_addr=document.getElementsByName("p_addr");
    var c_addr="";
    if(document.getElementById("same_addr").checked){
        c_addr=document.getElementsByName("c_addr");
    }
    var identity=document.getElementById("identity");
    delivery_mode=document.getElementById("delivery_mode");
    var inst=document.getElementsByClassName("inst");
    var degree=document.getElementsByClassName("degree");
    var univ=document.getElementById("univ");
    
}