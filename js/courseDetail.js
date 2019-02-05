$(document).ready(function() {
  $("#tab-container").easytabs();

  function clickNav(item) {
    $(`.course_detail__body__nav ul li:nth-child(${item})`).click(function() {
      $(`.etabs li .a${item}`).click();
    });
  }

  for (let i = 0; i <= 4; i++) {
    clickNav(i);
  }

  // For the Apply Button shake animation
  window.addEventListener("load", () => {

    setInterval(() => {
      $('.course_detail__body__nav button').addClass('animateButton');
      setTimeout(() => {
        $('.course_detail__body__nav button').removeClass('animateButton');
      }, 600);
    }, 10000);
    
  });

});
