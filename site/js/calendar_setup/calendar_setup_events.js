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
  var inputs = document.querySelectorAll("main input");
  inputs.forEach((element) => {
    addSelectionToSingleInput(element);
  });
}

function addSelectionToSingleInput(input) {
  input.addEventListener("click", (e) => SelectAll(e.srcElement));
}

function addEventsToTime() {
  var timeInputs = document.getElementsByClassName("timeInput");
  for (var i = 0; i < timeInputs.length; i++) {
    addEventToSingleTime(timeInputs[i]);
  }
}

function addEventToSingleTime(time) {
  time.addEventListener("focusout", (e) => {
    e.srcElement.value = FormatTime(e.srcElement.value);
  });
}

function addEventsToQuantity() {
  var quantities = document.querySelectorAll("#qty input");
  quantities.forEach((element) => {
    addEventToSingleQuantity(element);
  });
}

function addEventToSingleQuantity(qty) {
  qty.addEventListener("focusout", (e) => {
    qty.value = FormatInteger(qty.value);
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
    if (wrapper.childElementCount == 2) {
      task.querySelector(".startTime").value = "00:00";
      task.querySelector(".endTime").value = "00:00";
      task.querySelector(".taskName").value = -1;
      task.querySelector("#qty input").value = "0";
      task.querySelector("ul").innerHTML =
        "<li>" + getEmptyTaskDropdown() + "</li>";
    } else {
      task.remove();
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
      var cloneTask = cloneAndClearTask(wrapper, wrapper.getAttribute("dayId"));
      wrapper.insertBefore(cloneTask, button);
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
