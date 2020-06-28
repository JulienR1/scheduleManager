document.addEventListener("DOMContentLoaded", () => {
  getWrappers();
  setSavedTasks();
});

wrappers = [];

function getWrappers() {
  var container = document.getElementById("day-container");
  wrappers = container.querySelectorAll(".wrapper");
}

function setSavedTasks() {
  for (var i = 0; i < 7; i++) {
    createDay(weekData[i], wrappers[i]);
  }
}

function createDay(dayData, wrapper) {
  console.log(dayData);
}

function addTask($data) {
  var task = document.createElement("DIV");
  task.classList.add("task");
  task.innerHTML = getDefaultTaskHTML();
  wrapper.appendChild(task);
}

// MODIFIER LES VALEURS DES CHAMPS PAR LES TABLEAUX DANS FOOTER
function getDefaultTaskHTML() {
  return `<button onclick="removeTask(this)" type="button" class="cancel"><i class="fas fa-times"></i></button>
    <div class="time">
        <input type="text" class="timeInput startTime" placeholder="Début">
        <p>-</p>
        <input type="text" class="timeInput endTime" placeholder="Fin">
    </div>
    <div class="title">
        <select name="taskName" id="taskName">
            <option value="Asperges">Asperges</option>
            <option value="Fleur de fraises">Fleurs de fraises</option>
        </select>
        <div id="qty">
            <span>(</span>
            <input type="text" placeholder="Qté">
            <span>)</span>
        </div>
    </div>
    <ul>
        <li>
            <select name="user1" class="userSelection">
                <option selected="selected">Sélectionner..</option>
                <option value="user1">Filip</option>
            </select>
        </li>
    </ul>`;
}
