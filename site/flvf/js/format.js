function FormatTime(inputStr) {
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

  return hours + ":" + minutes;
}

function FormatInteger(inputStr) {
  var integer = parseInt(inputStr);
  if (isNaN(integer)) integer = 0;
  if (integer < 0) integer = Math.abs(integer);
  return integer;
}
