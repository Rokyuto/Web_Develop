var returnFlightDatePicker = document.getElementById("returnFlightDate"); // Get Return Flight Date Picker Element
var noReturnLabel = document.getElementById("Container_NoReturnFlightDate"); // Get No Return Label Element
var flightType = document.getElementById("Selector_FlightType"); // Get Flight Type Selector Element

// Function to show/hide (toggle) Return Flight Date Picker | Function is called when Flight Type Selector's Value is changed (client choose Return Option)
function flightTypeChoice(){
    toggleNoReturn(); // Call function to change No Return Element Visibility
    returnFlightDatePicker.classList.toggle("returnFlightDate"); // Toggle (show/hide) the element for Return Date Picker
}

// Function to handle No Return Element visibility, when Flight Type is changed to Return
function toggleNoReturn(){
    if(Selector_FlightType.value == "Return"){ // If Flight Type is changed to 'Return'
        noReturnLabel.style.display = "none"; // Hide No Return Label
    }
    else{
        noReturnLabel.style.display = "block"; // If Flight Type is 'One way' return/show 'No Return' Element
    }
}
