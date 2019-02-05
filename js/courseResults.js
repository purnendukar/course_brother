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