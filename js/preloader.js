
// ALL ANIMATION VARIABLES
const course_ = document.querySelector('#course');
const brother = document.querySelector('#brother');
const com = document.querySelector('#com');
const container = document.querySelector('.preloader__main_container');
const tagline = document.querySelector('.preloader__tagline');

const logoAnimation = () => {

  const logoAnimTl = new TimelineMax({ repeat: -1, repeatDelay: 1, yoyo: true });
  logoAnimTl
    .fromTo(course_, 2, { y: -1000 }, { y: -6, ease: Power3.easeInOut })
    .fromTo(brother, 2, { y: 1000 }, { y: 27, ease: Power3.easeInOut }, '-=1')
    .fromTo(com, 2, { x: -1000 }, { x: 20, ease: Power3.easeInOut }, '-=1')
    .fromTo(tagline, 2, {x:-2000},{x:-1,ease:Elastic.easeInOut},'-=0.4')
    ;

  return logoAnimTl;

};

// GSAP start function
const start = () => {
  console.log('----- GSAP STARTS ------');
  const masterTl = new TimelineMax();
  masterTl.add(logoAnimation(), 'logo-anim');
};

// Starting off the animation(s)
start();

// Removing Preloader on Page Load
const preloader = document.querySelector('.preloader');
const bodyForOverflow = document.querySelector('body');

// Setting body to not overflow while preloader is present
bodyForOverflow.style.overflowY = 'hidden';

window.addEventListener('load', () => {
        bodyForOverflow.style.overflowY = 'scroll';
        preloader.classList.add('preloader--fadeOut');
  
});
// setTimeout(function(){bodyForOverflow.style.overflowY = 'scroll';preloader.classList.add('preloader--fadeOut');},'10000');