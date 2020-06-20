const CLOSED_ATTR = "closed";

document.addEventListener("DOMContentLoaded", () => setup());

function setup() {
  var timeInputs = document.getElementsByClassName("timeInput");
  for (var i = 0; i < timeInputs.length; i++) {
    timeInputs[i].addEventListener("click", (e) => {
      SelectAll(e.srcElement);
    });
    timeInputs[i].addEventListener("onfocusout", (e) =>
      FormatTime(timeInputs[i])
    );
  }
}

function toggleDayView(btn) {
  btn.parentElement.toggleAttribute(CLOSED_ATTR);
}

function SelectAll(element) {
  element.setSelectionRange(0, element.value.length);
}
