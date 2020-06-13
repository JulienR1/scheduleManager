document.addEventListener("keydown", (e) => {
  if (e.key == "Escape") {
    e.preventDefault();
    e.stopPropagation();
    closeWindow();
  }
});

document.addEventListener("touchstart", handleTouchStart, false);
document.addEventListener("touchmove", handleTouchMove, false);

var xDown = null;
var yDown = null;

function handleTouchStart(e) {
  const firstTouch = e.touches[0];
  xDown = firstTouch.clientX;
  yDown = firstTouch.clientY;
}

function handleTouchMove(e) {
  if (!xDown || !yDown) {
    return;
  }

  var xUp = e.touches[0].clientX;
  var yUp = e.touches[0].clientY;

  var deltaX = xDown - xUp;
  var deltaY = yDown - yUp;

  if (
    Math.abs(deltaX) > Math.abs(deltaY) &&
    !backdrop.hasAttribute(ACTIVE_ATTR)
  ) {
    if (deltaX > 0) {
      openHeader();
    } else {
      closeHeader();
    }
  }

  xDown = null;
  yDown = null;
}

const ACTIVE_ATTR = "active";
const DOCKED_ATTR = "isDocked";

backdrop = document.getElementById("dark-overlay");
signup = document.getElementById("signup");
login = document.getElementById("login");
toggleIcon = document.getElementById("header-toggle");
dateInfo = document.getElementById("calendar-details");

header = document.querySelector("header");
main = document.querySelector("main");

backdrop.addEventListener("click", (e) => {
  e.stopPropagation();
  closeWindow();
});

document.body.addEventListener("click", (e) => {
  e.stopPropagation();
  closeHeader();
});

function toggleHeader(e) {
  e.stopPropagation();

  if (header.hasAttribute(DOCKED_ATTR)) {
    openHeader();
  } else {
    closeHeader();
  }
}

function openHeader() {
  header.removeAttribute(DOCKED_ATTR);
  main.setAttribute(DOCKED_ATTR, "");
  toggleIcon.setAttribute(DOCKED_ATTR, "");
}

function closeHeader() {
  header.setAttribute(DOCKED_ATTR, "");
  main.removeAttribute(DOCKED_ATTR);
  if (toggleIcon != undefined) toggleIcon.removeAttribute(DOCKED_ATTR);
}

function openLogin() {
  backdrop.setAttribute(ACTIVE_ATTR, "");
  login.setAttribute(ACTIVE_ATTR, "");
  signup.removeAttribute(ACTIVE_ATTR);
  lockScroll();
}

function openSignup() {
  backdrop.setAttribute(ACTIVE_ATTR, "");
  login.removeAttribute(ACTIVE_ATTR);
  signup.setAttribute(ACTIVE_ATTR, "");
  lockScroll();
}

function openForgotPassword() {
  // TODO
}

function lockScroll() {
  document.body.setAttribute("noscroll", "");
}

function closeWindow() {
  backdrop.removeAttribute(ACTIVE_ATTR);
  login.removeAttribute(ACTIVE_ATTR);
  signup.removeAttribute(ACTIVE_ATTR);
  if (dateInfo != undefined) dateInfo.removeAttribute(ACTIVE_ATTR);
  unlockScroll();
  closeHeader();
  //window.location.search = "";
}

function unlockScroll() {
  document.body.removeAttribute("noscroll");
}
