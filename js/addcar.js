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
        event.target.style.backgroundColor = 'lightblue';
    }

    function validateForm() {
        let isValid = true;

        // Check each input field for empty values
        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                alert('Please fill in all fields.');
                return;
            }
        });

        return isValid;
    }

    // Add event listeners for input fields
    inputs.forEach(input => {
        input.addEventListener('focus', handleInputFocus);
        input.addEventListener('blur', handleInputBlur);
    });

    // Add event listener for button mouseover
    button.addEventListener('mouseover', handleButtonMouseover);

    // Event listener for form submission
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Validate form
        if (!validateForm()) {
            return; // Stop form submission if validation fails
        }

        // If all fields are filled, display success message and reset form
        alert('Car advertisement added successfully!');
        form.reset();
    });
});
