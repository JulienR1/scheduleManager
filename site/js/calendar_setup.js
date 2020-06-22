const CLOSED_ATTR = "closed";

document.addEventListener("DOMContentLoaded", () => setup());

function setup() {
  addSelectionToInputs();
  addEventsToTime();
  addEventsToQuantity();
  addEventToUserSelects();
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

function addEventToUserSelects() {
  var selects = document.querySelectorAll(".userSelection");
  selects.forEach((element) => {
    element.addEventListener("click", (e) => UpdateUserSelectContent(element));
  })
}

function toggleDayView(btn) {
  btn.parentElement.toggleAttribute(CLOSED_ATTR);
}

function SelectAll(element) {
  element.setSelectionRange(0, element.value.length);
}

function UpdateUserSelectContent(select) {
  // On skip la premiere valeur parce que celle-ci sera toujours la meme:
  // "Selectionner ..."
  while (select.options.length > 1) {
    select.options[1] = null;
  }
  validUsers.foreach((user) => {
    // add tous les users dans le select (var = validUsers)
  })
}

function removeTask(task) { }
