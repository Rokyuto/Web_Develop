// VARIABLES
var OptionsListToShow; // Variable to store the Menu List Element which will be shown
var OptionsListToHide; // Variable to store the Menu List Element which will be hidden
let hiddenAirport = null; // Variable to store which Airport Option is HIDDEN
var SelectField_FromAirport_Text = document.getElementById("SelectField_FromAirport_Text"); // Initialize From Airport Selector Element's Text
var SelectField_ToAirport_Text = document.getElementById("SelectField_ToAirport_Text"); // Initialize To Airport Selector Element's Text

// Click Functionality for From & To Airport Select Fields
function onClick_SelectField(OptionListToShow_ID,OptionListToHide_ID){
    OptionsListToShow = document.getElementById(OptionListToShow_ID); // Initialize the Menu List Element which will be shown
    OptionsListToHide = document.getElementById(OptionListToHide_ID); // Initialize the Menu List Element which will be hidden
    OptionsListToShow.classList.toggle(OptionListToShow_ID); // Toggle (show) the OptionsList which we want to show
    hideOpositeAirportField(OptionsListToHide,OptionListToHide_ID); // Call Function to hide the OptionsList which we want to hide if he is opened
}

// Function to hide the given Airport Option List if he is opened (visible) | Function is called when the client open the other (opposite) Airport Option List
function hideOpositeAirportField(optionsList,optionsListId){
    if(!optionsList.className) { // Check if the ul (Options List) has class value (name) | If he has, then the ul is hidden, if he isn't having className, then he is vissible
        optionsList.classList.toggle(optionsListId); // Toggle (hide) the Given Options List
    }
}

// Click Functionality for all Airport Options (in From & To Airport Menus)
function onClick_MenuAirportOption(Airport,Airport_SelectField_Text,OptionsList,OppositeOptionsList,Opposite_Airoprt_SelectField_Text){    
    Airport_SelectField_Text.value = Airport; // Change the Given AirportSelectField's Text in HTML page to clicked Airport Option Element's Text
    hideChosenAirport(Airport,OppositeOptionsList); // Call Function to hide from Opposite Airport Menu, the chosen (clicked) Airport from the opened Airport Menu
    document.getElementById(OptionsList.id).classList.toggle(OptionsList.id.toString()); // Toggle (hide) the Given Airport Options List Visibility

    clearSelectField(Airport_SelectField_Text,Opposite_Airoprt_SelectField_Text)
}

// Funtion to HIDE, from the Opposite Airport Menu, the chosen/selected/clicked Airport Option from the active Airport Menu
function hideChosenAirport(airportCityName,OppositeMenuToHideFrom){
    returnOldChosenAirport(); // Call Function to return Old Hidden Airport
    // Find the same as clicked Airport Option in the Opposite Airport Menu to hide | Update Hidden Airport Option Variable with the new Airport's data for hidding
    hiddenAirport = OppositeMenuToHideFrom.children[airportCityName];
    hiddenAirport.style.display = "none"; // HIDE the Opposite Menu's Airport Option equal to the chosen (clicked) Airport Option from the opened Airport Menu
}

// Function to return the old hidden Chosen Airport
function returnOldChosenAirport(){
    if(hiddenAirport){ // Check If there has already been chosen Airport before (client choose Airport for 2 or more times)
        hiddenAirport.style.display = "block"; // Show the past hidden Airport Option
    }
}

// Function to Clear the Opposite Select Field's Text if it's the same as the value in the active Select Field's Text
function clearSelectField(Active_Airport_SelectField_Text,Opposite_Airoprt_SelectField_Text){
    if(Active_Airport_SelectField_Text.value.toUpperCase() == Opposite_Airoprt_SelectField_Text.value.toUpperCase()){ // Check IF the Current Active Select Field's Text is equal (the same as) the Opposite Select Field's Text
        Opposite_Airoprt_SelectField_Text.value = null; // Clear the Opposite Select Field's Text
    }
}

// Swap Airports Choices Button's Function
function swapAirports(){
    if(SelectField_FromAirport_Text.value != null && SelectField_ToAirport_Text.value == null){ // If To Select Field is empty
        SelectField_ToAirport_Text.value = SelectField_FromAirport_Text.value;
        SelectField_FromAirport_Text.value = null;
    }
    else if(SelectField_ToAirport_Text.value != null && SelectField_FromAirport_Text.value == null){ // If From Select Field is empty
        SelectField_FromAirport_Text.value = SelectField_ToAirport_Text.value;
        SelectField_ToAirport_Text.value = null;
    }
    else if(SelectField_FromAirport_Text.value != null && SelectField_ToAirport_Text.value != null){ // If the two Select Fields are filled
        var cityNameForSwap = SelectField_ToAirport_Text.value; // TEMP Variable to store the city's Name from ToAirport SelectField
        SelectField_ToAirport_Text.value = SelectField_FromAirport_Text.value;
        SelectField_FromAirport_Text.value= cityNameForSwap;
    }
}