document.addEventListener("DOMContentLoaded", () => {
  getWrappers();
  setOptions();
  setTasks();
});

wrappers = [];
allTaskOptions = [];
allUserOptions = [];

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
    createDay(weekData[i], wrappers[i]);
  }
}

function createDay(dayData, wrapper) {
  dayData.forEach((day) => {
    addTask(day, wrapper);
  });
  appendEmptyTask(wrapper);
}

function addTask(data, wrapper) {
  var task = document.createElement("DIV");
  task.classList.add("task");
  task.innerHTML = getDefaultTaskHTML();

  if (data != null) {
    task.querySelector(".startTime").value = FormatTime(data["startTime"]);
    task.querySelector(".endTime").value = FormatTime(data["endTime"]);
    task.querySelector("#qty input").value = FormatInteger(
      data["targetQuantity"]
    );

    task.querySelectorAll("#taskName option").forEach((taskOption) => {
      taskOption.removeAttribute("selected");
      if (taskOption.value == data["taskId"]) {
        taskOption.setAttribute("selected", "");
      }
    });

    selectorHtml = "";
    data["users"].forEach((user) => {
      var tempDiv = document.createElement("DIV");
      tempDiv.innerHTML = getEmptyUserDropdown();
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

  wrapper.appendChild(task);
}

function appendEmptyTask(wrapper) {
  var emptyTask = document.createElement("DIV");
  emptyTask.classList.add("task");
  emptyTask.innerHTML = getDefaultTaskHTML();
  wrapper.appendChild(emptyTask);
}

function getDefaultTaskHTML() {
  return (
    `<button onclick="removeTask(this)" type="button" class="cancel"><i class="fas fa-times"></i></button>
    <div class="time">
        <input type="text" class="timeInput startTime" placeholder="Début">
        <p>-</p>
        <input type="text" class="timeInput endTime" placeholder="Fin">
    </div>
    <div class="title">` +
    getEmptyTaskDropdown() +
    `<div id="qty">
            <span>(</span>
            <input type="text" placeholder="Qté">
            <span>)</span>
        </div>
    </div>
    <ul>` +
    getEmptyUserDropdown() +
    `</ul>`
  );
}

function getEmptyUserDropdown() {
  userData = "";
  allUserOptions.forEach((user) => {
    userData += user;
  });
  return (
    `<li>
            <select name="user-selection-0" class="userSelection">
                <option value="-1" selected>Sélectionner..</option>` +
    userData +
    `</select>
          </li>`
  );
}

function getEmptyTaskDropdown() {
  taskData = "";
  allTaskOptions.forEach((option) => {
    taskData += option;
  });
  return (
    `<select name="taskName" id="taskName">
  <option value="-1" selected>Sélectionner..</option>` +
    taskData +
    `</select>`
  );
}
