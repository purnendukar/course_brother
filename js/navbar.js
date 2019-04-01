// ------------------------------
$(document).ready(function(){
    
// For getting newsletter popups every 10 seconds
  let newsInterval = null;

    function check_cookie(){
        var c=document.cookie;
        var c_array=c.split(';');
        for(var i=0;i<c_array.length;i++){
            var c_name=c_array[i].split('=')[0].trim();
            if(c_name=="e_id"){
                return false;
            }
        }
        return true;
    }
    
 function showNewsletter() {
     if(check_cookie()){
   $('.newsletter_popup__backdrop').addClass('newsletter_popup__backdrop--active');
   $('.newsletter_popup').css({
     'transform': 'scale(1) translate(-50%, -50%)',
     'opacity': '1',
     'display': 'relative',
     'z-index': '8'
   });
     }
 };
 function hideNewsletter() {
     $('.newsletter_popup__backdrop').removeClass('newsletter_popup__backdrop--active');
     $('.newsletter_popup').css({
           'transform': 'scale(0) translate(-50%, -50%)',
           'opacity': '0',
           'z-index': '1'
         });
       }

       newsInterval = setInterval(() => {
         showNewsletter();
       }, 10000);

       $('.newsletter_popup__main__close').click(function() {
         hideNewsletter();
         clearInterval(newsInterval);
         newsInterval = setInterval(() => {
           showNewsletter();
         }, 10000);
       });

       $(".newsletter_popup__main__form div").click(function() {
         hideNewsletter();
         clearInterval(newsInterval);
       });
});
 

// For the top courses modal
let topCourseItems = document.querySelectorAll('.top_courses__item');
let topCoursesItemsSections = document.querySelectorAll('.top_courses__item__section');
let topCoursesItemsSectionsButtons = document.querySelectorAll('.top_courses__item__section__button');

function sectionShow(sectionNum) {
  topCoursesItemsSections[sectionNum].style.zIndex = '5';
  topCoursesItemsSections[sectionNum].style.opacity = '1';
};

function sectionHide(sectionNum) {
  topCoursesItemsSections[sectionNum].style.zIndex = '-5';
  topCoursesItemsSections[sectionNum].style.opacity = '0';
};

for(let i = 0; i < topCourseItems.length; i++) {
  topCourseItems[i].addEventListener('click', () => {
    sectionShow(i);
  });
  topCoursesItemsSectionsButtons[i].addEventListener('click', (e) => {
    e.stopPropagation();
    sectionHide(i);
  });
}


// Parallax for featured courses
$(window).on('scroll', () => {
  $('.featured_courses').css({
    'background-position': `100% ${($(document).scrollTop() / 7)}%`
  });
});



// Back to top
$(window).scroll(function() {
  if ($(this).scrollTop() >= 1000) {
    $('.back-to-top').css('bottom', '8rem');
  } else {
    $('.back-to-top').css('bottom', '-10rem');
  }
});

$('.back-to-top').click(() => {
  $('html, body').animate({ scrollTop: 0 }, 800);
});


try{
// For Login Modal Display
const loginButton = document.querySelector('.navbar_main__appendix__login');
const loginModal = document.querySelector('.login_modal');
const loginModalBackdrop = document.querySelector('.login_modal__backdrop');
const loginModalClose = document.querySelector('.login_modal__close');

loginButton.addEventListener('click', function() {
  loginModalBackdrop.classList.add('login_modal__backdrop--active');
  loginModal.classList.add('login_modal--active');
});

loginModalClose.addEventListener('click', function() {
  loginModalBackdrop.classList.remove('login_modal__backdrop--active');
  loginModal.classList.remove('login_modal--active');
});



// For Register Modal Display
const registerButton = document.querySelector('.navbar_main__appendix__register');
const registerModal = document.querySelector('.register_modal');
const registerModalBackdrop = loginModalBackdrop;
const registerModalClose = document.querySelector('.register_modal__close');

registerButton.addEventListener('click', () => {
  registerModalBackdrop.classList.add('login_modal__backdrop--active');
  registerModal.classList.add('register_modal--active');
});

registerModalClose.addEventListener('click', () => {
  registerModalBackdrop.classList.remove('login_modal__backdrop--active');
  registerModal.classList.remove('register_modal--active');
});

// For Register Modal Submit Fix
const replacedRegisterSubmit = document.querySelector('.register_modal__submit');
const registerFormButton = document.querySelector('.register_modal__main__form button');

replacedRegisterSubmit.addEventListener('click', () => {
  registerFormButton.click();
});


// Interchanging Register and Login Modals
const registerHereButton = document.querySelector('.login_modal__appendix__register');
const loginHereButton = document.querySelector('.register_modal__appendix__login');

registerHereButton.addEventListener('click', () => {
  registerModal.classList.add('register_modal--active');
  loginModal.classList.remove('login_modal--active');
});
loginHereButton.addEventListener('click', () => {
  loginModal.classList.add('login_modal--active');
  registerModal.classList.remove('register_modal--active');
});
}catch(err){
  
}

// For Navbar Item Dropdown
const navbarList = document.querySelectorAll('.navbar_main__courses__item');
const navbarItems = document.querySelectorAll('.navbar_main__courses__item__dropdown');

navbarList.forEach((item, index) => {
  item.addEventListener('mouseover', (e) => {
    navbarItems[index].classList.add('navbar_main__courses__item__dropdown--active');
    e.stopPropagation();
  });
  item.addEventListener('mouseleave', (e) => {
    navbarItems[index].classList.remove('navbar_main__courses__item__dropdown--active');
    e.stopPropagation();
  });
}); 

// -------------------------------
// For Dynamic width of navlist items
const navListDropdowns = document.querySelectorAll('.navbar_main__courses__item__dropdown');
const navListItems = document.querySelectorAll('.navbar_main__courses__item__dropdown__content');

const baseNavlistWidth = 26;
const navlistHeightLimit = 13;

navListItems.forEach((navListItem, index) => {
  if (navListItem.children.length >= navlistHeightLimit * 3) {
    changeNavlistWidth(index, 4);
  } else if (navListItem.children.length >= navlistHeightLimit * 2) {
    changeNavlistWidth(index, 3);
  } else if (navListItem.children.length >= navlistHeightLimit) {
    changeNavlistWidth(index, 2);
  } else {
    changeNavlistWidth(index);
  }
});

function changeNavlistWidth(index, multiplier = 1) {
  navListDropdowns[index].style.width = `${baseNavlistWidth * multiplier}rem`;
  navListItems[index].style.width = `${baseNavlistWidth * multiplier}rem`;
}; 




// -------------------------------
// For Random Student Popups
const studentPopup = document.querySelector('.student_popup');
const studentPopupChildren = studentPopup.children;
const studentPhrase = document.querySelector('.student_popup__text p');
const studentPopupAudio = document.querySelector('.student_popup audio');

// const randomCities = ['Kolkata', 'Mumbai', 'Allahabad', 'Delhi', 'Sikkim', 'Patna', 'Kerala', 'Bangalore', 'Chennai', 'Pune', 'Jaipur', 'Agra'];
// const randomNames = ['Rahul', 'Noor', 'Suman', 'Rajni', 'Brian', 'Shyam', 'Komal', 'Hemant', 'Aarav', 'Vivan', 'Aditya', 'Vihaan', 'Arjun', 'Ansh'];
// const formNames = [
//                   'Global Family Managed Business (GFMB)', 
//                   'Luxury Brand Management', 
//                   'Masters of Global Business (MGB)', 
//                   'Global MBA (GMBA)', 
//                   'Executive MBA (EMBA)', 
//                   'Bachelor of Business Administration (BBA)', 
//                   'Bachelor of Business Communication (BBC)', 
//                   'Bachelor of Data Science (BDS)', 
//                   'Bachelor of Economics'
//                   ];

function showStudentPopup() {

  let randomName = Math.floor(Math.random() * randomNames.length);
  let randomCity = Math.floor(Math.random() * randomCities.length);
  let randomForm = Math.floor(Math.random() * formNames.length);
  let randomsentence = Math.floor(Math.random() * sentence.length);
  studentPopupAudio.play();

  studentPopupChildren[2].textContent = randomNames[randomName];
  studentPopupChildren[3].textContent = randomCities[randomCity];
  studentPhrase.textContent = `${sentence[randomsentence]} ${formNames[randomForm]} form`;

  studentPopup.classList.add('student_popup--active');
  setTimeout(() => {
    studentPopup.classList.remove('student_popup--active');
  }, 5000);

};

(function studentPopupLoop () {
  let rand = Math.floor(Math.random() * 150000);
  setTimeout(() => {
    showStudentPopup();
    studentPopupLoop();
  }, rand);
}());


// For toggling sidebar in mobile version
const hambToggler = document.querySelector('.navbar_main__appendix__hamburger');
const sidebarMenu = document.querySelector('.mob__sidebar');
const sidebarMenuCloser = document.querySelector('.mob__sidebar__closer');

hambToggler.addEventListener('click', () => {
  sidebarMenu.style.left = '0';
});

sidebarMenuCloser.addEventListener('click', () => {
  sidebarMenu.style.left = '-30rem';
});


// -------------------------------
// For show password in login modal
const loginModalPasswordBox = document.querySelector('.login_modal__main__form input[type="password"]');
const loginModalEye = document.querySelector('.login_modal__main__form__showpw');

let eyeOfAgamotto = 0;

loginModalEye.addEventListener('click', () => {
  if (eyeOfAgamotto === 0) {
    loginModalPasswordBox.type = 'text';
    eyeOfAgamotto = 1;
  } else if (eyeOfAgamotto === 1) {
    loginModalPasswordBox.type = 'password';
    eyeOfAgamotto = 0;
  }
});

// -------------------------------
// For show password in login modal
const registerModalPasswordBoxes = document.querySelectorAll('.register_modal__main__form input[type="password"]');
const registerModalEye1 = document.querySelector('.register_modal__main__form__showpw1');
const registerModalEye2 = document.querySelector('.register_modal__main__form__showpw2');
const registerModalEyes = [registerModalEye1, registerModalEye2];

let eyeOfAgamotto2 = 0;

registerModalEyes.forEach((eye, index) => {
  eye.addEventListener('click', () => {
    if (eyeOfAgamotto2 === 0) {
      registerModalPasswordBoxes[index].type = 'text';
      eyeOfAgamotto2 = 1;
    } else if (eyeOfAgamotto2 === 1) {
      registerModalPasswordBoxes[index].type = 'password';
      eyeOfAgamotto2 = 0;
    }
  });
});
