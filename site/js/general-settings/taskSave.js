var saveTaskButton = document.getElementsByName("save-tasks")[0];
var originalTasks = [];
var originalTaskNames = [];

document.addEventListener("DOMContentLoaded", setupTask());

function setupTask() {
  originalTasks = document.querySelectorAll("#task-list tr input");
  originalTasks.forEach((input) => {
    originalTaskNames.push(input.value);
    input.addEventListener("change", function () {
      updateSaveTaskButton();
    });
  });

  updateSaveTaskButton();
}

function updateSaveTaskButton() {
  var currentTaskCount = document.querySelectorAll("#task-list tr input")
    .length;

  saveTaskButton.removeAttribute("isDirty");
  saveTaskButton.disable = true;

  if (currentTaskCount != originalTaskNames.length) {
    disableTaskButton();
    return;
  }

  for (var i = 0; i < originalTasks.length; i++) {
    if (originalTasks[i].value != originalTaskNames[i]) {
      disableTaskButton();
      return;
    }
  }
}

function disableTaskButton() {
  saveTaskButton.setAttribute("isDirty", "");
  saveTaskButton.disabled = false;
}
