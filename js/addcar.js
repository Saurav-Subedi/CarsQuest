document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addCarForm');
    const inputs = form.querySelectorAll('input');
    const button = form.querySelector('button');

    function handleInputFocus(event) {
        event.target.style.backgroundColor = 'yellow';
    }

    function handleInputBlur(event) {
        event.target.style.backgroundColor = 'white';
    }

    function handleButtonMouseover(event) {
        event.target.style.transition = 'background-color 0.3s ease'; 
        event.target.style.backgroundColor = 'lightblue';
    }

    function handleButtonMouseout(event) {
        event.target.style.transition = 'background-color 0.3s ease'; 
        event.target.style.backgroundColor = '';
    }

    function validateForm() {
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                alert('Please fill in all fields.');
                return;
            }
        });

        return isValid;
    }

    inputs.forEach(input => {
        input.addEventListener('focus', handleInputFocus);
        input.addEventListener('blur', handleInputBlur);
    });

    button.addEventListener('mouseover', handleButtonMouseover);
    button.addEventListener('mouseout', handleButtonMouseout);

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        if (!validateForm()) {
            return;
        }

        alert('Car advertisement added successfully!');
        form.reset();
    });
});
