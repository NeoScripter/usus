document.addEventListener('DOMContentLoaded', function() {
    const calendar = document.getElementById('calendar');
    const eventsDiv = document.getElementById('events');

    let currentDate = new Date();

    function loadCalendar() {
        fetch('../includes/get_event_dates.php')
            .then(response => response.json())
            .then(eventDates => {
                generateCalendar(currentDate.getFullYear(), currentDate.getMonth(), eventDates);
            });
    }


    function generateCalendar(year, month, eventDates) {
        calendar.innerHTML = '';
        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();
        const monthNames = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        const daysOfWeek = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];

        const header = document.createElement('div');
        header.className = 'header-cal';
        const headerContent = document.createElement('div');
        headerContent.textContent = `${monthNames[month]} ${year}`;
        const prevMonthBtn = document.createElement('button');
        prevMonthBtn.className = 'prev-month';
        prevMonthBtn.innerHTML = '&#8592';
        const nextMonthBtn = document.createElement('button');
        nextMonthBtn.className = 'next-month';
        nextMonthBtn.innerHTML = '&#8594';
        header.appendChild(prevMonthBtn);
        header.appendChild(headerContent);
        header.appendChild(nextMonthBtn);
        calendar.appendChild(header);

        const daysRow = document.createElement('div');
        daysRow.className = 'days-row';
        daysOfWeek.forEach(day => {
            const dayCell = document.createElement('div');
            dayCell.className = 'day-cell';
            dayCell.textContent = day;
            daysRow.appendChild(dayCell);
        });
        calendar.appendChild(daysRow);

        const datesGrid = document.createElement('div');
        datesGrid.className = 'dates-grid';

        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'date-cell empty';
            datesGrid.appendChild(emptyCell);
        }

        for (let date = 1; date <= lastDate; date++) {
            const dateCell = document.createElement('div');
            dateCell.className = 'date-cell';
            const currentDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
            
            if (eventDates.includes(currentDate)) {
                dateCell.classList.add('event-date');
            }

            dateCell.textContent = date;
            dateCell.addEventListener('click', function() {
                fetchEvents(currentDate);
            });
            datesGrid.appendChild(dateCell);
        }

        calendar.appendChild(datesGrid);

        const prevMonthButton = document.querySelector('.prev-month');
        const nextMonthButton = document.querySelector('.next-month');
        
        prevMonthButton.addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            loadCalendar();
        });

        nextMonthButton.addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            loadCalendar();
        });
    }

    function fetchEvents(date) {
        fetch('../includes/get_events.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `event_date=${date}`
        })
        .then(response => response.json())
        .then(data => {
            displayEvents(data);
        })
        .catch(error => console.error('Error:', error));
    }

    function displayEvents(events) {
        eventsDiv.innerHTML = '';
        if (events.length > 0) {
                events.forEach(event => {
                    const eventElement = document.createElement('div');
                
                    const eventFrequencyLower = event.event_frequency.toLowerCase();
                
                    const startDateMonth = event.event_start_date.split('-')[1];
                    const startDateDay = event.event_start_date.split('-')[2];
                    const endDateMonth = event.event_end_date.split('-')[1];
                    const endDateDay = event.event_end_date.split('-')[2];

                    eventElement.innerHTML = `${startDateDay}.${startDateMonth} - ${endDateDay}.${endDateMonth} <br> ${event.event_venue} ${eventFrequencyLower} мероприятие "${event.event_name}"`;
                
                    eventsDiv.appendChild(eventElement);
                });
        } else {
            eventsDiv.textContent = 'В этот день не назначено никаких мероприятий.';
        }
    }

    loadCalendar();
});
