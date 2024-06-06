class FormValidator {
    constructor(form) {
        this.form = form;
        this.errors = {};

        this.form.addEventListener('input', (event) => {
            this.validateField(event.target);
        });

        this.form.addEventListener('submit', (event) => {
            if (!this.validateForm()) {
                event.preventDefault();
            }
        });
    }

    validateField(field) {
        const name = field.name;
        let errorMessage = '';

        switch (name) {
            case 'name':
                if (this.emptyInputCheck(field.value)) {
                    errorMessage = 'Заполните все поля!';
                } else if (!this.checkEventNameLetters(field.value)) {
                    errorMessage = 'Название мероприятия должно содержать только буквы и пробелы!';
                } else if (this.isEventNameTooShort(field.value)) {
                    errorMessage = 'Слишком короткое название мероприятия!';
                } else if (this.isEventNameTooLong(field.value)) {
                    errorMessage = 'Слишком длинное название мероприятия!';
                }
                break;
            case 'start-date':
            case 'end-date':
                const startDate = document.getElementById('start-date').value;
                const endDate = document.getElementById('end-date').value;
                if (!this.checkEventDateFormat(field.value)) {
                    errorMessage = 'Неправильный формат даты мероприятия!';
                } else if (startDate && endDate && !this.checkEventDateOrder(startDate, endDate)) {
                    errorMessage = 'Дата начала мероприятия должна быть раньше даты его окончания!';
                }
                break;
            case 'venue':
                if (!this.checkEventVenue(field.value)) {
                    errorMessage = 'Выберите место проведения мероприятия из предоставленного списка!';
                }
                break;
            case 'frequency':
                if (!this.checkEventFrequency(field.value)) {
                    errorMessage = 'Выберите частоту проведения мероприятия из предоставленного списка!';
                }
                break;
        }

        this.errors[name] = errorMessage;
        this.displayErrors();
    }

    validateForm() {
        const fields = this.form.elements;
        for (let field of fields) {
            if (field.name) {
                this.validateField(field);
            }
        }
        return Object.values(this.errors).every(error => error === '');
    }

    emptyInputCheck(value) {
        return value.trim() === '';
    }

    checkEventNameLetters(value) {
        return /^[a-zA-Zа-яА-Я\s\-]+$/u.test(value);
    }

    isEventNameTooShort(value) {
        return value.length < 3;
    }

    isEventNameTooLong(value) {
        return value.length > 100;
    }

    checkEventDateFormat(value) {
        return /^\d{4}-\d{2}-\d{2}$/.test(value);
    }

    checkEventDateOrder(startDate, endDate) {
        return new Date(startDate) < new Date(endDate);
    }

    checkEventVenue(value) {
        const validVenues = [
            "Выездное",
            "Учебный театр",
            "Концертный зал",
            "Холл",
            "137 аудитория",
            "32 аудитория",
            "113 аудитория",
            "132 аудитория",
            "50 аудитория",
            "400 аудитория",
            "302 аудитория"
        ];
        return validVenues.includes(value);
    }

    checkEventFrequency(value) {
        const validFrequencies = ["Ежегодное", "Разовое"];
        return validFrequencies.includes(value);
    }

    displayErrors() {
        for (let key in this.errors) {
            const errorElement = document.getElementById(`${key}Error`);
            if (errorElement) {
                errorElement.textContent = this.errors[key];
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('eventForm');
    new FormValidator(form);
});