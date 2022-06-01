// When the HTML document is completely loaded
document.addEventListener('DOMContentLoaded', () => {
    // Get the first element that matches the specified selector (grid)
    const gridDisplay = document.querySelector('.grid')

    // Get the first element that have id 'score'
    const scoreDisplay = document.getElementById('score')
    // SAME for result id
    const resultDisplay = document.getElementById('result')

    const boardWidth = 4 // Board width
    const boardArea = boardWidth * boardWidth
    let squares = [] // Board squares
    let score = 0 // Player Score

    // Create the playing board
    function f_createBoard() {
        for (let i = 0; i < boardWidth*boardWidth; i++) {
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
            f_checkForGameOver() // Call Game Over function
        }else{ // Else 
            f_generateRandomSquare() // Try again
        }
    }

    // Swipe Right Mechanic
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
                let missing = 4 - filteredRow.length // Calculate how many elements from the row are missing (are not filtered)
                let zeros = Array(missing).fill(0) // Create array 'zeros' with length of missing elements quantity and fill with zeros
                // Create new Row with the different elements placed in the end of the array / row
                let newRow = zeros.concat(filteredRow) // Append filteredRow to zeros array

                // Move the different elements in the right (last position of the row)
                squares[i].innerHTML = newRow[0]
                squares[i+1].innerHTML = newRow[1]
                squares[i+2].innerHTML = newRow[2]
                squares[i+3].innerHTML = newRow[3]
            }
        }
    }

    // Swipe Left Mechanic
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
                let missing = 4 - filteredRow.length // Calculate how many elements from the row are missing (are not filtered)
                let zeros = Array(missing).fill(0) // Create array 'zeros' with length of missing elements quantity and fill with zeros
                // Create new Row with the different elements placed in the end of the array / row
                let newRow = filteredRow.concat(zeros) // Append filteredRow to zeros array

                // Move the different elements in the right (last position of the row)
                squares[i].innerHTML = newRow[0]
                squares[i+1].innerHTML = newRow[1]
                squares[i+2].innerHTML = newRow[2]
                squares[i+3].innerHTML = newRow[3]
            }
        }
    }

    // Swipe Down Mechanic
    function f_moveDown(){
        for (let i = 0; i < 4; i++){
            // Get Column squares
            let totalOne = squares[i].innerHTML
            let totalTwo = squares[i+boardWidth].innerHTML
            let totalThree = squares[i+(boardWidth * 2)].innerHTML
            let totalFour = squares[i+(boardWidth * 3)].innerHTML
            let column = [parseInt(totalOne), parseInt(totalTwo), parseInt(totalThree), parseInt(totalFour)]
            // Filter the different elements in column array
            let filteredColumn = column.filter(num => num) // Create array with the different elements
            let missing = 4 - filteredColumn.length // Calculate how many elements from the column are missing (are not filtered)
            let zeros = Array(missing).fill(0)
            // Create new Column with the different elements placed in the end of the array / column
            let newColumn = zeros.concat(filteredColumn) // Append filteredColumn to zeros array

            squares[i].innerHTML = newColumn[0]
            squares[i+boardWidth].innerHTML = newColumn[1]
            squares[i+( boardWidth * 2)].innerHTML = newColumn[2]
            squares[i+( boardWidth * 3)].innerHTML = newColumn[3]
        }
    }

    // Swipe Up Mechanic
    function f_moveUp(){
        for (let i = 0; i < 4; i++){
            // Get Column squares
            let totalOne = squares[i].innerHTML
            let totalTwo = squares[i+boardWidth].innerHTML
            let totalThree = squares[i+(boardWidth * 2)].innerHTML
            let totalFour = squares[i+(boardWidth * 3)].innerHTML
            let column = [parseInt(totalOne), parseInt(totalTwo), parseInt(totalThree), parseInt(totalFour)]
            // Filter the different elements in column array
            let filteredColumn = column.filter(num => num) // Create array with the different elements

            let missing = 4 - filteredColumn.length // Calculate how many elements from the column are missing (are not filtered)
            let zeros = Array(missing).fill(0)
            // Create new Column with the different elements placed in the end of the array / column
            let newColumn = filteredColumn.concat(zeros) // Append filteredColumn to zeros array

            squares[i].innerHTML = newColumn[0]
            squares[i+boardWidth].innerHTML = newColumn[1]
            squares[i+( boardWidth * 2)].innerHTML = newColumn[2]
            squares[i+( boardWidth * 3)].innerHTML = newColumn[3]
        }
    }

    // Combine two Squares on Row Function
    function f_combineRow() {
        for (let i = 0; i < 15; i++) {
            if(squares[i].innerHTML === squares[i+1].innerHTML){ // If the two squares in the row are equal
                let combineTotal = parseInt(squares[i].innerHTML) + parseInt(squares[i+1].innerHTML) // Combine them
                squares[i].innerHTML = combineTotal // Update the first square to the result
                squares[i+1].innerHTML = 0 // Reset the second square to 0
                score += combineTotal
                scoreDisplay.innerHTML = score
            }
        }
        f_checkForWin()
    }

    // Combine two Squares on Column Function
    function f_combineColumn() {
        for (let i = 0; i < 12; i++) {
            if(squares[i].innerHTML === squares[i+boardWidth].innerHTML){ // If the two squares in the row are equal
                let combinedTotal = parseInt(squares[i].innerHTML) + parseInt(squares[i+boardWidth].innerHTML) // Combine them
                squares[i].innerHTML = combinedTotal // Update the first square to the result
                squares[i+boardWidth].innerHTML = 0 // Reset the second square to 0
                score += combinedTotal
                scoreDisplay.innerHTML = score
            }
        }
        f_checkForWin()
    }

    // Keybindings
    function f_Keybinding(e) {
        if(e.keyCode === 39) // On Right Arrow Button Click
        {
            f_KeyRight() // Call Right Key Funtion
        }
        else if(e.keyCode === 37) // On Left Arrow Button Click
        {
            f_KeyLeft() // Call Left Key Funtion
        }
        else if(e.keyCode === 38) // On Up Arrow Button Click
        {
            f_KeyUp() // Call Up Key Funtion
        }
        else if(e.keyCode === 40) // On Down Arrow Button Click
        {
            f_KeyDown() // Call Down Key Funtion
        }
    }

    document.addEventListener('keyup', f_Keybinding) // Keys Event Listenener

    // Right Key Funtion
    function f_KeyRight() {
        f_moveRight()
        f_combineRow()
        f_moveRight()
        f_generateRandomSquare()
    }

    // Left Key Funtion
    function f_KeyLeft() {
        f_moveLeft()
        f_combineRow()
        f_moveLeft()
        f_generateRandomSquare()
    }

    // Down Key Funtion
    function f_KeyDown() {
        f_moveDown()
        f_combineColumn()
        f_moveDown()
        f_generateRandomSquare()
    }

    // Up Key Funtion
    function f_KeyUp() {
        f_moveUp()
        f_combineColumn()
        f_moveUp()
        f_generateRandomSquare()
    }

    // Win Check Mechanic
    function f_checkForWin() {
        for (let i = 0; i < squares.length; i++) { // Iterate the board
            if (squares[i].innerHTML == 2048) { // If Square content is equal to 2048
                resultDisplay.innerHTML = "You win!" // You win! message/print
                document.removeEventListener('keyup',f_Keybinding) // Remove Key Listenener
            }
        }
    }

    // Check for Lose Function
    function f_checkForGameOver() {
        let zeros = 0 // Each time when Function is called zeros will be 0
        for (let i = 0; i < squares.length; i++) // Iterate the board
        { 
            if (squares[i].innerHTML == 0) { // If there is square with content equal to 0
                zeros++ // Increment temp variable zeros
            }
        }
        if(zeros === 0){ // If there is no square with content 0 (All squares are busy ( and there is no square with content 2048 - obviously) )
            resultDisplay.innerHTML = 'You Lose' // You Lose Print
            document.removeEventListener('keyup',f_Keybinding) // Remove Key Listener
        }

    }

})