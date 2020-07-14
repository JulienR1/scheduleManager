var users = [];
var saveButton = document.getElementsByName("save-users")[0];

document.addEventListener("DOMContentLoaded", setup());

function setup() {
  var inputs = document.querySelectorAll("#user-list tr input");
  inputs.forEach((input) => {
    if (input.hasAttribute("value")) {
      var data = {
        userId: input.value,
        isChecked: input.checked,
      };
      users.push(data);

      input.addEventListener("change", function (event) {
        updateSaveButton(input, data);
      });
    }
  });
  checkAllCheckboxes();
}

function updateSaveButton(input, data) {
  if (input.value == data["userId"]) {
    if (input.checked != data["isChecked"]) {
      saveButton.setAttribute("isDirty", "");
      saveButton.disabled = false;
    } else {
      checkAllCheckboxes();
    }
  }
}

function checkAllCheckboxes() {
  var fail = false;
  var allInputs = document.querySelectorAll("#user-list tr input");
  for (var i = 0; i < allInputs.length; i++) {
    if (allInputs[i].value == users[i]["userId"]) {
      if (allInputs[i].checked != users[i]["isChecked"]) {
        fail = true;
      }
    }
  }
  if (!fail) {
    saveButton.removeAttribute("isDirty");
    saveButton.disabled = true;
  }
}
