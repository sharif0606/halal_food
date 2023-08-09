// mobile left nav.
const leftSide = document.querySelector(".left-side");
const rightSide = document.querySelector(".right-side");
const closebtn = document.querySelector(".close-btn");
const startbtn = document.querySelector(".start-btn");

// scroll nav
const navLogo = document.querySelector(".nav-logo");
const nav = document.querySelector("nav");

// mobile left nav.
function leftNavS() {
  leftSide.style.display = "block";
  leftSide.style.width = "100%";
  rightSide.style.display = "none";
  closebtn.style.display = "block";
  startbtn.style.display = "none";
  document.documentElement.scrollTop = 0;
  document.body.scrollTop = 0;
}
function leftNavC() {
  closebtn.style.display = "none";
  startbtn.style.display = "block";
  leftSide.style.display = "none";
  rightSide.style.display = "block";
}

// scroll nav
window.onscroll = function () {
  if (window.pageYOffset >= 150) {
    navLogo.style.display = "block";
  } else {
    navLogo.style.display = "none";
  }
};
