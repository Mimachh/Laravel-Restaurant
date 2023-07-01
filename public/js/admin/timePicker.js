const timepicker = document.querySelectorAll('.timepicker-creneau-horaire');
flatpickr(timepicker, {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
});


flatpickr("#date-range", {
    mode: "range",
    dateFormat: "d-m-Y",
  });