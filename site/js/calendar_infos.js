overlay = document.getElementById("dark-overlay");
calendarDetail = document.getElementById("calendar-details");

detailTitle = document.querySelector("#calendar-details h4");
taskScroller = document.getElementById("scroller");

function openDateInfos(dateToOpen) {
  overlay.setAttribute(ACTIVE_ATTR, "");
  calendarDetail.setAttribute(ACTIVE_ATTR, "");

  loadDateInfos(dateToOpen);
}

function closeDateInfos() {
  overlay.removeAttribute(ACTIVE_ATTR);
  calendarDetail.removeAttribute(ACTIVE_ATTR);
}

function loadDateInfos(dateToOpen) {
  ajustedDate = new Date(dateToOpen + " 00:00:00");
  detailTitle.innerHTML = ajustedDate.getDate();

  if (typeof calendarData === "undefined") {
    return;
  }

  calendarData.forEach((day) => {
    if (day.date == dateToOpen) {
      taskScroller.innerHTML = "";
      if (day.tasks.length == 0) {
        taskScroller.innerHTML =
          '<div class="task"><h5>Aucune tâche assignée</h5></div>';
      } else {
        day.tasks.forEach((task) => addTask(task));
      }
    }
  });
}

function addTask(task) {
  startTime = task.startTime
    .substring(0, task.startTime.length - 3)
    .replace(/^(0+)/g, "");
  endTime = task.endTime
    .substring(0, task.endTime.length - 3)
    .replace(/^(0+)/g, "");

  taskHTML = "";
  taskHTML += '<div class="task">';
  taskHTML += "<h5>" + startTime + " - " + endTime + "</h5>";
  taskHTML += "<h6>" + task.name;
  taskHTML += task.quantity != 0 ? " <span>(" + task.quantity + ")</span>" : "";
  taskHTML += "</h6>";
  taskHTML += "<ul>";
  task.users.forEach((user) => {
    taskHTML += "<li>" + user[0] + " " + user[1] + "</li>";
  });
  taskHTML += "</ul>";
  taskHTML += "</div>";

  taskScroller.innerHTML += taskHTML;
}
