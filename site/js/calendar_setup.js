const CLOSED_ATTR = "closed";

document.addEventListener("DOMContentLoaded", () => setup());

function setup() {
  addSelectionToInputs();
  addEventsToTime();
  addEventsToQuantity();
}

function addSelectionToInputs() {
  var inputs = document.querySelectorAll("input");
  inputs.forEach((element) => {
    element.addEventListener("click", (e) => SelectAll(e.srcElement));
  });
}

function addEventsToTime() {
  var timeInputs = document.getElementsByClassName("timeInput");
  for (var i = 0; i < timeInputs.length; i++) {
    timeInputs[i].addEventListener("focusout", (e) => FormatTime(e.srcElement));
  }
}

function addEventsToQuantity() {
  var quantities = document.querySelectorAll("#qty input");
  quantities.forEach((element) => {
    element.addEventListener("focusout", (e) => {
      FormatInteger(element);
    });
  });
}

function toggleDayView(btn) {
  btn.parentElement.toggleAttribute(CLOSED_ATTR);
}

function SelectAll(element) {
  element.setSelectionRange(0, element.value.length);
}

function removeTask(task) {}
