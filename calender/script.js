document.addEventListener("DOMContentLoaded", function() {
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const monthYear = document.getElementById("monthYear");
    const calendarDays = document.getElementById("calendarDays");
    const selectedDateDisplay = document.getElementById("selectedDate");
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    let selectedDate = currentDate.getDate();

    function showCalendar(month, year) {
        monthYear.textContent = `${monthNames[month]} ${year}`;
        calendarDays.innerHTML = "";

        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);

        for (let i = 0; i < firstDay.getDay(); i++) {
            const emptyDay = document.createElement("div");
            calendarDays.appendChild(emptyDay);
        }

        for (let i = 1; i <= lastDay.getDate(); i++) {
            const day = document.createElement("div");
            day.textContent = i;
            if (i === selectedDate && currentMonth === month && currentYear === year) {
                day.classList.add("selected");
            }
            calendarDays.appendChild(day);
        }

        const days = document.querySelectorAll("#calendarDays > div");
        days.forEach(day => {
            day.addEventListener("click", function() {
                days.forEach(d => d.classList.remove("selected"));
                day.classList.add("selected");
                selectedDate = parseInt(day.textContent);
                showSelectedDate();
            });
        });
    }
var curr_date;
    function showSelectedDate() {
        curr_date= ` ${monthNames[currentMonth]} ${selectedDate}, ${currentYear}`
        selectedDateDisplay.textContent =curr_date;
    }

    showCalendar(currentMonth, currentYear);
    showSelectedDate();

    prevBtn.addEventListener("click", function() {
        currentYear = currentMonth === 0 ? currentYear - 1 : currentYear;
        currentMonth = currentMonth === 0 ? 11 : currentMonth - 1;
        showCalendar(currentMonth, currentYear);
    });

    nextBtn.addEventListener("click", function() {
        currentYear = currentMonth === 11 ? currentYear + 1 : currentYear;
        currentMonth = currentMonth === 11 ? 0 : currentMonth + 1;
        showCalendar(currentMonth, currentYear);
    });


});
