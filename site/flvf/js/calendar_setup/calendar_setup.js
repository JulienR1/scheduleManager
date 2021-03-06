document.addEventListener("DOMContentLoaded", () => {
  getWrappers();
  setOptions();
  setTasks();
  disableTasks();
});

wrappers = [];
allTaskOptions = [];
allUserOptions = [];

var taskNos = [0, 0, 0, 0, 0, 0, 0];

function getWrappers() {
  var container = document.getElementById("day-container");
  wrappers = container.querySelectorAll(".wrapper");
}

function setOptions() {
  validUsers.forEach((user) => {
    allUserOptions.push(
      '<option value="' +
        user["id"] +
        '">' +
        user["firstname"] +
        " " +
        user["lastname"] +
        "</option>"
    );
  });

  validTasks.forEach((task) => {
    allTaskOptions.push(
      '<option value="' + task["id"] + '">' + task["taskName"] + "</option>"
    );
  });
}

function setTasks() {
  for (var i = 0; i < 7; i++) {
    createDay(i, weekData[i], wrappers[i]);
  }
}

function disableTasks() {
  wrappers.forEach((wrapper) => {
    var isReadOnly = wrapper.hasAttribute("readOnly");
    if (isReadOnly) {
      wrapper
        .querySelectorAll("select, button, input")
        .forEach((interactable) => {
          interactable.setAttribute("disabled", "");
        });
    }
  });
}

function createDay(dayId, dayData, wrapper) {
  dayData.forEach((day) => {
    addTask(dayId, day, wrapper);
    taskNos[dayId]++;
  });

  var emptyTask = document.createElement("DIV");
  emptyTask.classList.add("task");
  emptyTask.innerHTML = getDefaultTaskHTML(dayId);
  var button = wrapper.children[wrapper.children.length - 1];
  wrapper.insertBefore(emptyTask, button);
  taskNos[dayId]++;
}

function addTask(dayId, data, wrapper) {
  var task = document.createElement("DIV");
  task.classList.add("task");
  task.innerHTML = getDefaultTaskHTML(dayId);

  if (data != null) {
    task.querySelector(".startTime").value = FormatTime(data["startTime"]);
    task.querySelector(".endTime").value = FormatTime(data["endTime"]);
    task.querySelector("#qty input").value = FormatInteger(
      data["targetQuantity"]
    );

    task.querySelector(".taskName").value = data["taskId"];

    selectorHtml = "";
    data["users"].forEach((user) => {
      var tempDiv = document.createElement("DIV");
      tempDiv.innerHTML = getEmptyUserDropdown(dayId);
      tempDiv.querySelectorAll("option").forEach((userOption) => {
        userOption.removeAttribute("selected");
        if (userOption.value == user["userId"]) {
          userOption.setAttribute("selected", "");
        }
      });
      selectorHtml += tempDiv.innerHTML;
    });

    task.querySelector("ul").innerHTML =
      selectorHtml + task.querySelector("ul").innerHTML;
  }

  var button = wrapper.querySelector(".addButton");
  wrapper.insertBefore(task, button);
}

function cloneAndClearTask(wrapper, dayId) {
  var cloneTask = wrapper.children[0].cloneNode(true);

  var startTime = cloneTask.querySelector(".startTime");
  startTime.value = "00:00";
  startTime.name = "week[" + dayId + "][startTime][" + taskNos[dayId] + "]";
  addEventToSingleTime(startTime);
  addSelectionToSingleInput(startTime);

  var endTime = cloneTask.querySelector(".endTime");
  endTime.value = "00:00";
  endTime.name = "week[" + dayId + "][endTime][" + taskNos[dayId] + "]";
  addEventToSingleTime(endTime);
  addSelectionToSingleInput(endTime);

  cloneTask.querySelector(".taskName").value = -1;
  cloneTask.querySelector(".taskName").name =
    "week[" + dayId + "][taskName][" + taskNos[dayId] + "]";

  var qty = cloneTask.querySelector("#qty input");
  qty.value = "0";
  qty.name = "week[" + dayId + "][qty][" + taskNos[dayId] + "]";
  addEventToSingleQuantity(qty);
  addSelectionToSingleInput(qty);

  var list = cloneTask.querySelector("ul");
  list.innerHTML = getEmptyUserDropdown(dayId);
  addEventsToSingleUserList(list);

  taskNos[dayId]++;
  return cloneTask;
}

function getDefaultTaskHTML(dayId) {
  return (
    `<button onclick="removeTask(this)" type="button" class="cancel"><i class="fas fa-times"></i></button>
    <div class="time">
        <input type="text" class="timeInput startTime" name="week[` +
    dayId +
    `][startTime][` +
    taskNos[dayId] +
    `]" value="00:00">
        <p>-</p>
        <input type="text" class="timeInput endTime" name="week[` +
    dayId +
    `][endTime][` +
    taskNos[dayId] +
    `]" value="00:00">
    </div>
    <div class="title">` +
    getEmptyTaskDropdown(dayId) +
    `<div id="qty">
            <span>(</span>
            <input type="text" name="week[` +
    dayId +
    `][qty][` +
    taskNos[dayId] +
    `]" value="0">
            <span>)</span>
        </div>
    </div>
    <ul>` +
    getEmptyUserDropdown(dayId) +
    `</ul>`
  );
}

function getEmptyUserDropdown(dayId) {
  userData = "";
  allUserOptions.forEach((user) => {
    userData += user;
  });
  return (
    `<li>
            <select name="week[` +
    dayId +
    `][user-selection][` +
    taskNos[dayId] +
    `][] class="userSelection">
                <option value="-1" selected>Sélectionner..</option>` +
    userData +
    `</select>
          </li>`
  );
}

function getEmptyTaskDropdown(dayId) {
  taskData = "";
  allTaskOptions.forEach((option) => {
    taskData += option;
  });
  return (
    `<select name="week[` +
    dayId +
    `][taskName][` +
    taskNos[dayId] +
    `]" class="taskName">
  <option value="-1" selected>Sélectionner..</option>` +
    taskData +
    `</select>`
  );
}
