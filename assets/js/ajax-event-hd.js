document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('eventForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", form.action, true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert(response.message);
                    form.reset();
                    clearErrors();
                } else {
                    displayError(response.error);
                }
            } else {
                alert('Произошла ошибка при отправке формы.');
            }
        };

        xhr.send(formData);
    });

    function displayError(error) {
        const errorElement = document.querySelector('.errors');
        errorElement.textContent = error;
        errorElement.classList.add('error');
    }

    function clearErrors() {
        const errorElements = document.querySelectorAll('.error');
        errorElements.forEach(element => {
            element.textContent = '';
        });
    }
});