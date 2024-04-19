const cars = [
    { make: 'Toyota', model: 'Camry', year: 2018, mileage: '30,000 miles', location: 'New York', price: '$15,000' },
    { make: 'Honda', model: 'Civic', year: 2019, mileage: '25,000 miles', location: 'Los Angeles', price: '$14,000' },
    { make: 'Ford', model: 'Escape', year: 2017, mileage: '40,000 miles', location: 'Chicago', price: '$12,000' },
    // Add more cars as needed
];
function handleSearch(event) {
    event.preventDefault();

    const modelInput = document.getElementById('model').value.trim().toLowerCase();
    const locationInput = document.getElementById('location').value.trim().toLowerCase();
    const searchResultsContainer = document.getElementById('searchResults');
    searchResultsContainer.innerHTML = ''; // Clear previous results

    if (!modelInput && !locationInput) {
        searchResultsContainer.textContent = 'Please enter a car model or location to search.';
        return;
    }

    const filteredCars = cars.filter(car => {
        const modelMatch = modelInput ? car.model.toLowerCase().includes(modelInput) : true;
        const locationMatch = locationInput ? car.location.toLowerCase().includes(locationInput) : true;
        
        return modelMatch && locationMatch;
    });

    if (filteredCars.length === 0) {
        searchResultsContainer.textContent = 'No matching car found.';
    } else {
        filteredCars.forEach(car => {
            const carInfo = `
                <div>
                    <p>Make: ${car.make}</p>
                    <p>Model: ${car.model}</p>
                    <p>Year: ${car.year}</p>
                    <p>Mileage: ${car.mileage}</p>
                    <p>Location: ${car.location}</p>
                    <p>Price: ${car.price}</p>
                </div>
            `;
            searchResultsContainer.innerHTML += carInfo;
        });
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const inputFields = document.querySelectorAll('input[type="text"]');
    const submitButton = document.querySelector('button[type="submit"]');

    // Add event listeners for input fields
    inputFields.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.backgroundColor = 'yellow'; // Change background color to yellow on focus
        });

        input.addEventListener('blur', () => {
            input.style.backgroundColor = 'white'; // Change background color to white on blur
        });
    });

    // Add event listener for submit button
    submitButton.addEventListener('mouseover', () => {
        submitButton.style.backgroundColor = 'blue'; // Change background color to blue on mouseover
    });

    submitButton.addEventListener('mouseout', () => {
        submitButton.style.backgroundColor = ''; // Reset background color on mouseout
    });
});

