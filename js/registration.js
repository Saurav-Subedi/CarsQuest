document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('sellerRegistrationForm');
    const inputs = form.querySelectorAll('input');

    function handleInputFocus(event) {
        event.target.style.transition = 'background-color 0.3s ease';
        event.target.style.backgroundColor = 'yellow';
    }

    function handleInputBlur(event) {
        event.target.style.transition = 'background-color 0.3s ease'; 
        event.target.style.backgroundColor = 'white';
    }

    function handleButtonMouseover(event) {
        event.target.style.transition = 'background-color 0.3s ease'; 
        event.target.style.backgroundColor = 'lightblue';
    }

    function validatePassword(password) {
        if (password.length < 6 || password.length > 10) {
            return false;
        }
    
        const hasDigit = /[0-9]/.test(password);
        const hasSpecialChar = /[_$#@?]/.test(password);
    
        return hasDigit && hasSpecialChar;
    }
    
    inputs.forEach(input => {
        input.addEventListener('focus', handleInputFocus);
        input.addEventListener('blur', handleInputBlur);
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        const name = form.querySelector('#name').value;
        const address = form.querySelector('#address').value;
        const phone = form.querySelector('#phone').value;
        const email = form.querySelector('#email').value;
        const username = form.querySelector('#username').value;
        const password = form.querySelector('#password').value;

        if (username === email || !/^[a-zA-Z]+$/.test(username)) {
            alert('Username must not be the same as email and should only contain alphabetic characters.');
            return;
        }

        if (!validatePassword(password)) {
            alert('Password must be between 6 to 10 characters and contain at least one digit and one special character (_$#@?).');
            return;
        }

        alert('Registration successful!\nName: ' + name + '\nAddress: ' + address + '\nPhone: ' + phone + '\nEmail: ' + email);
        form.reset();
    });
});
