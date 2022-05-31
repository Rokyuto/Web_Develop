// When the HTML document is completely loaded
document.addEventListener('DOMContentLoaded', () => {
    // Get the first element that matches the specified selector (grid)
    const gridDisplay = document.querySelector('.grid')

    // Get the first element that have id 'score'
    const scoreDisplay = document.getElementById('score')
    // SAME for result id
    const resultDisplay = document.getElementById('result')

    const width = 4 // Board width
    const boardArea = width * width
    let squares = [] // Board squares

    // Create the playing board
    function f_createBoard() {
        for (let i = 0; i < width*width; i++) {
            // Create new div Element which is part from the board
            square = document.createElement('div')
            // innerHTML returns HTML content of the HTML element
            square.innerHTML = 0 // Add number to the square element
            gridDisplay.appendChild(square) // Add the square to the grid as child    
            squares.push(square) // Add the square to the array of squares
        }
        f_generateRandomSquare() // Call generate Random Square Function
        f_generateRandomSquare() // Call generate Random Square Function
    }

    f_createBoard() // Call createBoard function

    // Generate Random Square and set his content to 2
    function f_generateRandomSquare() {
        let randomNumber = Math.floor(Math.random() * squares.length) // Generate Random Square
        if(squares[randomNumber].innerHTML == 0) // If the Square content is 0
        {
            squares[randomNumber].innerHTML = 2 // Update the Square content to 2
        }else{ // Else 
            f_generateRandomSquare() // Try again
        }
    }

    // Move Right Mechanic
    function f_moveRight(){
        for(var i = 0; i < boardArea; i++){ 
            // Each row first element will be true
            if(i % 4 === 0){ // === is strictly equation  
                // Get Row Elements
                let totalOne = squares[i].innerHTML // Row element 1 content
                let totalTwo = squares[i+1].innerHTML // Row element 2 content
                let totalThree = squares[i+2].innerHTML // Row element 3 content
                let totalFour = squares[i+3].innerHTML // Row element 4 content
                let row = [parseInt(totalOne), parseInt(totalTwo), parseInt(totalThree), parseInt(totalFour)] // Create array with the row elements' content
                console.log(row)

                // Filter the different elements in row array
                let filteredRow = row.filter(num => num) // Create array with the different elements
                console.log("filter " + filteredRow)

                let missing = 4 - filteredRow.length // Calculate how many elements from the row are missing (are not filtered)
                console.log("Missing "+missing)

                let zeros = Array(missing).fill(0) // Create array 'zeros' with length of missing elements quantity and fill with zeros
                console.log("Zeros " + zeros)

                // Create new Row with the different elements placed in the end of the array / row
                let newRow = zeros.concat(filteredRow) // Append filteredRow to zeros array
                console.log("New row " + newRow)

                // Move the different elements in the right (last position of the row)
                squares[i].innerHTML = newRow[0]
                squares[i+1].innerHTML = newRow[1]
                squares[i+2].innerHTML = newRow[2]
                squares[i+3].innerHTML = newRow[3]
            }
        }
    }

    // Move Left Mechanic
    function f_moveLeft(){
        for(var i = 0; i < boardArea; i++){ 
            // Each row first element will be true
            if(i % 4 === 0){ // === is strictly equation  
                // Get Row Elements
                let totalOne = squares[i].innerHTML // Row element 1 content
                let totalTwo = squares[i+1].innerHTML // Row element 2 content
                let totalThree = squares[i+2].innerHTML // Row element 3 content
                let totalFour = squares[i+3].innerHTML // Row element 4 content
                let row = [parseInt(totalOne), parseInt(totalTwo), parseInt(totalThree), parseInt(totalFour)] // Create array with the row elements' content
                console.log(row)

                // Filter the different elements in row array
                let filteredRow = row.filter(num => num) // Create array with the different elements
                console.log("filter " + filteredRow)

                let missing = 4 - filteredRow.length // Calculate how many elements from the row are missing (are not filtered)
                console.log("Missing "+missing)

                let zeros = Array(missing).fill(0) // Create array 'zeros' with length of missing elements quantity and fill with zeros
                console.log("Zeros " + zeros)

                // Create new Row with the different elements placed in the end of the array / row
                let newRow = filteredRow.concat(zeros) // Append filteredRow to zeros array
                console.log("New row " + newRow)

                // Move the different elements in the right (last position of the row)
                squares[i].innerHTML = newRow[0]
                squares[i+1].innerHTML = newRow[1]
                squares[i+2].innerHTML = newRow[2]
                squares[i+3].innerHTML = newRow[3]
            }
        }
    }

    f_moveLeft()

})