document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('sellerLoginForm');
    const inputs = form.querySelectorAll('input');

    function handleInputFocus(event) {
        event.target.style.backgroundColor = 'yellow';
    }

    function handleInputBlur(event) {
        event.target.style.backgroundColor = 'white';
    }

    // Function to validate password
    function validatePassword(password) {
        // Check if password length is between 6 to 10 characters
        if (password.length < 6 || password.length > 10) {
            return false;
        }
    
        // Check for at least one alphabet character, one numeric character,
        // and one of the specified special characters in the password
        const hasAlphabet = /[a-zA-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecialChar = /[_$#@?]/.test(password);
    
        // Ensure that all required characters are present in the password
        return hasAlphabet && hasNumber && hasSpecialChar;
    }
    
    // Add event listeners for input fields
    inputs.forEach(input => {
        input.addEventListener('focus', handleInputFocus);
        input.addEventListener('blur', handleInputBlur);
    });

    // Event listener for form submission
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Retrieve username and password from input fields
        const username = form.querySelector('#username').value;
        const password = form.querySelector('#password').value;

        // Validate username against alphabetic characters
        if (!/^[a-zA-Z]+$/.test(username)) {
            alert('Username should only contain alphabetic characters (A-Z, a-z).');
            return;
        }

        // Validate password using custom function
        if (!validatePassword(password)) {
            alert('Password must be between 6 to 10 characters and contain alphabets, numbers, and special characters (_$#@?).');
            return;
        }

        // If validation passes, display success message and reset form
        alert('Login successful!');
        form.reset();
    });
});


