document.addEventListener("DOMContentLoaded", () => {
  setSavedTasks();
});

function setSavedTasks() {
  for (var i = 0; i < 7; i++) {
    createDay(weekData[i]);
  }
}

function createDay(dayData) {
  console.log(dayData);
}

function addTask($data) {}
