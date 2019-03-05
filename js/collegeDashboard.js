// Toggling the sidebar
const sidebarToggleButton = document.querySelector('.college_dashboard__navbar__left__toggle');
const sidebar = document.querySelector('.college_dashboard__body__sidebar');

const dashboardMainContainer = document.querySelector('.college_dashboard__container');

sidebarToggleButton.addEventListener('click', () => {
  sidebar.classList.toggle('college_dashboard__body__sidebar--inactive');
  dashboardMainContainer.classList.toggle('college_dashboard__container--nopad');
});

// Toggling account info
const accountButton = document.querySelector('.college_dashboard__navbar__right__title .fa-angle-down');
const accountInfo = document.querySelector('.college_dashboard__navbar__right__account');

accountButton.addEventListener('click', (e) => {
	accountInfo.classList.toggle('college_dashboard__navbar__right__account--active');
	e.stopPropagation();
}, false);

