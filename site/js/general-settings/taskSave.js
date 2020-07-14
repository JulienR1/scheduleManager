var saveTaskButton = document.getElementsByName("save-tasks")[0];
var originalTasks = [];
var originalTaskNames = [];

const taskContainer = document.querySelector("#task-list tbody");
const addInputBoxParent = document.querySelector("#task-list tr:last-child");

document.addEventListener("DOMContentLoaded", setupTask());

function setupTask() {
  originalTasks = document.querySelectorAll("#task-list tr input");
  originalTasks.forEach((input) => {
    originalTaskNames.push(input.value);
    input.addEventListener("input", function () {
      updateSaveTaskButton();
    });
  });

  updateSaveTaskButton();
}

function updateSaveTaskButton() {
  var currentTaskCount = document.querySelectorAll("#task-list tr input")
    .length;

  saveTaskButton.removeAttribute("isDirty");
  saveTaskButton.disabled = true;

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

function addNewTask(button) {
  var currentValue = button.value;
  if (currentValue.length > 0) {
    var newTask = document.createElement("TR");
    var taskValue = addInputBoxParent.querySelector("input").value;
    newTask.innerHTML =
      '<td><input type="text" name="taskNames[]" value="' +
      taskValue +
      '"></td>';
    taskContainer.insertBefore(newTask, addInputBoxParent);
    addInputBoxParent.querySelector("input").value = "";
  }
}
