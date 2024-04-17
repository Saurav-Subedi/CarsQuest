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
function goToHomePage() {
    window.location.href = '../html/index.html'; 
}