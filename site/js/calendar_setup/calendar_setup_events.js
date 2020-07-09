const CLOSED_ATTR = "closed";

document.addEventListener("DOMContentLoaded", () => setup());

function setup() {
  addSelectionToInputs();
  addEventsToTime();
  addEventsToQuantity();
  RegisterAddTask();
  addEventsToUserLists();
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
    timeInputs[i].addEventListener("focusout", (e) => {
      e.srcElement.value = FormatTime(e.srcElement.value);
    });
  }
}

function addEventsToQuantity() {
  var quantities = document.querySelectorAll("#qty input");
  quantities.forEach((element) => {
    element.addEventListener("focusout", (e) => {
      element.value = FormatInteger(element.value);
    });
  });
}

function toggleDayView(btn) {
  btn.parentElement.toggleAttribute(CLOSED_ATTR);
}

function SelectAll(element) {
  element.setSelectionRange(0, element.value.length);
}

function removeTask(button) {
  var task = button.parentNode;
  var wrapper = task.parentNode;
  if (task != wrapper.querySelector(".task:last-child")) {
    task.remove();
    if (wrapper.childElementCount == 1) {
      appendEmptyTask(wrapper);
    }
  }
}

function addEventsToUserLists() {
  document.querySelectorAll(".task ul").forEach((list) => {
    list.addEventListener("change", () => {
      updateUserList(list);
    });
  });
}

function RegisterAddTask() {
  document.querySelectorAll(".day .wrapper").forEach((wrapper) => {
    var button = wrapper.children[wrapper.children.length - 1];
    button.addEventListener("click", () => {
      appendEmptyTask(wrapper);
    });
  });
}

function updateUserList(userList) {
  if (userList.lastChild.children[0].value != -1) {
    var child = document.createElement("LI");
    child.innerHTML = userList.lastChild.innerHTML;
    userList.appendChild(child);
    userList.lastChild.children[0].value = -1;
  }
  for (var i = 0; i < userList.childElementCount - 1; i++) {
    if (userList.children[i].children[0].value == -1) {
      userList.children[i].remove();
    }
  }
}
