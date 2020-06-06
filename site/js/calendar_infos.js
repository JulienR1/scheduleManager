overlay = document.getElementById("dark-overlay");
calendarDetail = document.getElementById("calendar-details");

function openDateInfos(month, day) {
  overlay.setAttribute(ACTIVE_ATTR, "");
  calendarDetail.setAttribute(ACTIVE_ATTR, "");

  loadDateInfos(null);
}

function loadDateInfos(dateInfo) {}
