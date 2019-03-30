$(document).ready(function() {
  
  // For Filter Options Dropdown 
  const filterSectionsButtons = document.querySelectorAll('.filter_results__item__head i');
  const filterSections = document.querySelectorAll('.filter_results__item__content');
  
  filterSectionsButtons.forEach((item, index) => {
    item.addEventListener('click', () => {
      filterSections[index].classList.toggle('section-active');
      setTimeout(() => {
        filterSections[index].classList.toggle('section-no-display');
      }, 300);
      item.classList.toggle('arrow-active');
    });
  });

});

// For filter sidebar in mobile view
const filterButton = document.querySelector('.course_results__mob__filter');
const filterSidebar = document.querySelector('.filter_results');
const filterCloser = document.querySelector('.filter_results__finisher__close');
const filterapply = document.querySelector('.filter_results__finisher__apply');

filterButton.addEventListener('click', () => {
  filterSidebar.style.left = '0';
});

filterCloser.addEventListener('click', () => {
  filterSidebar.style.left = '-101vw';
  reset_filter();
});
filterapply.addEventListener('click', () => {
  filterSidebar.style.left = '-101vw';
});