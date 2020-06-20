function FormatTime(element) {
  inputStr = element.value;

  inputStr = inputStr.replace("h", ":");
  moments = inputStr.split(":");
  hours = moments[0];
  minutes = moments[1];

  if (hours == "" || hours == "0" || isNaN(hours)) hours = "00";
  if (minutes == "" || minutes == "0" || isNaN(minutes)) minutes = "00";

  if (hours.length == 1) hours = "0" + hours;
  if (minutes.length == 1) minutes += "0";

  if (hours.length > 2) hours = hours.slice(0, 2);
  if (minutes.length > 2) minutes = minutes.slice(0, 2);

  if (hours > 23) hours = "23";
  if (minutes > 59) minutes = "59";

  element.value = hours + ":" + minutes;
}

function FormatInteger(element) {
  var integer = parseInt(element.value);
  if (isNaN(integer)) integer = 0;
  element.value = integer;
}
