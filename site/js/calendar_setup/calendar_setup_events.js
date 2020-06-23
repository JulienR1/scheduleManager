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
  });
}

function toggleDayView(btn) {
  btn.parentElement.toggleAttribute(CLOSED_ATTR);
}

function SelectAll(element) {
  element.setSelectionRange(0, element.value.length);
}

function UpdateUserSelectContent(select) {
  /*while (select.options.length > 0) {
    select.options[0] = null;
  }
  select.add(new Option("Sélectionner..", "-1", true));
  validUsers.forEach((user) => {
    select.add(
      new Option(user["firstname"] + " " + user["lastname"], user["id"])
    );
  });*/
}

function removeTask(task) {}
