// For Changing active links on click for dashboard navbar
const dashboardNavbarItems = document.querySelectorAll('.dashboard__header__main__navbar ul li');

dashboardNavbarItems.forEach((item, index) => {
  item.addEventListener('click', function(e) {
    e.preventDefault();
    dashboardNavbarItems.forEach((item) => {
      item.classList.remove('dashboard__navbar--active');
    });
    item.classList.toggle('dashboard__navbar--active');
  });
});


// For fixing the navbar on scroll
const navbar = document.querySelector('.dashboard__header__main__navbar');

window.addEventListener('scroll', function() {
  if (this.scrollY >= 560) {
    navbar.classList.add('dashboard__header__main__navbar--fixed');
    navbar.style.transition = '0.5s ease-in-out';
  } else {
    navbar.classList.remove('dashboard__header__main__navbar--fixed');
    navbar.style.transition = '0.1s ease-in';
  }
});


// For smooth scroll to div
const idArray = ['#CandidateAbout', '#Education', '#WorkExperience', '#ProfessionalSkills', '#Awards'];
dashboardNavbarItems.forEach((item, index) => {
  item.addEventListener('click', function(e) {
    e.preventDefault();
    $('html, body').animate({
      scrollTop: ($(idArray[index]).offset().top - 170)
    }, 1000);
  });
});