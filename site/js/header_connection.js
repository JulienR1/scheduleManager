document.addEventListener("keydown", (e) => {
  if (e.key == "Escape") {
    e.preventDefault();
    e.stopPropagation();
    closeWindow();
  }
});

const ACTIVE_ATTR = "active";

backdrop = document.getElementById("dark-overlay");
signup = document.getElementById("signup");
login = document.getElementById("login");

backdrop.addEventListener("click", (e) => {
  e.preventDefault();
  e.stopPropagation();
  closeWindow();
});

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
  unlockScroll();
  window.location.search = "";

  console.log("call");
}

function unlockScroll() {
  document.body.removeAttribute("noscroll");
}
