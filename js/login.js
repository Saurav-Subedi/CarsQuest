document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('sellerLoginForm');
    const inputs = form.querySelectorAll('input');

    function handleInputFocus(event) {
        event.target.style.backgroundColor = 'yellow';
    }

    function handleInputBlur(event) {
        event.target.style.backgroundColor = 'white';
    }

    function validatePassword(password) {
        if (password.length < 6 || password.length > 10) {
            return false;
        }
    
        const hasAlphabet = /[a-zA-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecialChar = /[_$#@?]/.test(password);
    
        return hasAlphabet && hasNumber && hasSpecialChar;
    }
        inputs.forEach(input => {
        input.addEventListener('focus', handleInputFocus);
        input.addEventListener('blur', handleInputBlur);
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const username = form.querySelector('#username').value;
        const password = form.querySelector('#password').value;

        if (!/^[a-zA-Z]+$/.test(username)) {
            alert('Username should only contain alphabetic characters (A-Z, a-z).');
            return;
        }

        if (!validatePassword(password)) {
            alert('Password must be between 6 to 10 characters and contain alphabets, numbers, and special characters (_$#@?).');
            return;
        }

        alert('Login successful!');
        form.reset();
    });
});


