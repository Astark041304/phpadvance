const lastname = document.getElementById('lastname')
        const firstname = document.getElementById('firstname')
        const middle = document.getElementById('middle')
        const form = document.getElementById('form')
        const errorElement = document.getElementById('error')

        form.addEventListener('submit', (e) => {
            let messages = []
            if(lastname.value === '' || lastname.value == null){
                messages.push(' Last name is required')
            }

            if(firstname.value === '' || firstname.value == null){
                messages.push(' First name is required')
            } 

            if(middle.value === '' || middle.value == null){
                messages.push(' Middle name is required')
            } 

            if(messages.length > 0){
                e.preventDefault()
                errorElement.innerText = messages.join(', ')
            }
        })

        function toggleOthersField() {
            var status = document.getElementById("civil_status").value;
            var othersField = document.getElementById("others_input");
            if (status === "Others") {
                othersField.style.display = "block";
            } else {
                othersField.style.display = "none";
            }
        }
    

// Array of countries
const countries = [
    "United States", "Canada", "United Kingdom", "Australia", "Germany", 
    "France", "Japan", "China", "India", "Philippines", "Brazil", "Mexico"
];

// Function to populate the dropdown
function populateCountries() {
    const countryDropdown = document.getElementById("country");

    // Check if the element exists
    if (!countryDropdown) {
        console.error("Dropdown element not found!");
        return;
    }

    // Clear existing options
    countryDropdown.innerHTML = "";

    // Default option
    const defaultOption = document.createElement("option");
    defaultOption.text = "Select a country";
    defaultOption.value = "";
    defaultOption.disabled = true;
    defaultOption.selected = true;
    countryDropdown.appendChild(defaultOption);

    // Add countries to dropdown
    countries.forEach(country => {
        const option = document.createElement("option");
        option.value = country;
        option.text = country;
        countryDropdown.appendChild(option);
    });
}

// Ensure the function runs when the page loads
document.addEventListener("DOMContentLoaded", populateCountries);



const moveButton = document.getElementById('moveButton');

moveButton.addEventListener('click', () => {
    // Randomly move the button within a certain range
    const randomX = Math.floor(Math.random() * 200) - 100; // Random X offset
    const randomY = Math.floor(Math.random() * 200) - 100; // Random Y offset

    // Get the current position
    const currentLeft = moveButton.parentElement.offsetLeft;
    const currentTop = moveButton.parentElement.offsetTop;

    // Set the new position
    moveButton.parentElement.style.left = `${currentLeft + randomX}px`;
    moveButton.parentElement.style.top = `${currentTop + randomY}px`;
});