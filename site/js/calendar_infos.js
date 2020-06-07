overlay = document.getElementById("dark-overlay");
calendarDetail = document.getElementById("calendar-details");

detailTitle = document.querySelector("#calendar-details h4");
taskScroller = document.getElementById("scroller");

function openDateInfos(dateToOpen) {
  overlay.setAttribute(ACTIVE_ATTR, "");
  calendarDetail.setAttribute(ACTIVE_ATTR, "");

  loadDateInfos(dateToOpen);
}

function loadDateInfos(dateToOpen) {
  ajustedDate = new Date(dateToOpen + " 00:00:00");
  detailTitle.innerHTML = ajustedDate.getDate();

  calendarData.forEach((day) => {
    if (day.date == dateToOpen) {
      if (day.tasks == null) {
        taskScroller.innerHTML =
          '<div class="task"><h5>Aucune tâche assignée</h5></div>';
      } else {
        day.tasks.forEach((task) => addTask(task));
      }
    }
  });
}

function addTask(task) {
  startTime = task.targetStartTime
    .substring(0, task.targetStartTime.length - 3)
    .replace(/^(0+)/g, "");
  endTime = task.targetEndTime
    .substring(0, task.targetEndTime.length - 3)
    .replace(/^(0+)/g, "");

  taskHTML = "";
  taskHTML += '<div class="task">';
  taskHTML += "<h5>" + startTime + " - " + endTime + "</h5>";
  taskHTML += "<h6>" + task.taskName;
  taskHTML +=
    task.targetQuantity != null
      ? " <span>(" + task.targetQuantity + ")</span>"
      : "";
  taskHTML += "</h6>";
  taskHTML += "<ul>";
  taskHTML += "<li>TODO</li>";
  taskHTML += "</ul>";
  taskHTML += "</div>";

  taskScroller.innerHTML += taskHTML;
}
