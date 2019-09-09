const hamburgerButton = document.getElementById("hamburger");
const $navItems = $('.link-container');
const header = document.getElementsByTagName("header")[0];
const barTop = document.querySelector(".bar-top");
const barMid = document.querySelector(".bar-mid");
const barBot = document.querySelector(".bar-bot");

hamburgerButton.addEventListener("click",(e)=> {
  console.log('stop');
  e.preventDefault();
  barTop.classList.toggle("transition-bar-top");
  barMid.classList.toggle("transition-bar-mid");
  barBot.classList.toggle("transition-bar-bot");

  if (barTop.classList.contains('transition-bar-top')) {
    $navItems.slideDown();
  } else {
    $navItems.slideUp();
  }
});
