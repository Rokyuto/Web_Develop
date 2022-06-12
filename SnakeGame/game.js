//import {f_Update as f_snakeUpdate , f_Draw as f_snakeDraw , SNAKE_SPEED } from './snake.js'

const GRID_SIZE = 21 // Grid size
const SNAKE_SPEED = 2 // Snake moves 2 times per second
let lastRenderTime = 0
const EXPANSION_RATE = 1 // How much the snake grow when eats food - 1 piece
let newSegments = 0
let gameOver = false

let inputDirection = {x: 0, y: 0} // Initial snake position
let lastInputDirection = {x: 0, y: 0} // Last snake position
const snakeBody = [{ x: 10, y: 11 }] // Array with snake's segments and their XY positions in the grid

let food = f_randomFoodPosition() // Generate random food position on game start

const gameBoard = document.getElementById('gameBoard') // Get the game board from the main document/page (index.html)

// Loop Function
function f_mainLoop(currentTime) {

    if(gameOver) { // If game over is true then
        // Game Over Alert
        if(confirm("Game Over! Press OK to restart the game.")){ // If OK pressed, then restart the game
            window.location.reload(); // Reload the page
        }
        return 
    }

    window.requestAnimationFrame(f_mainLoop) // Request when is the Next Frame Render

    // Calculate seconds since the last Render
    const secondsSinceLastRender = (currentTime - lastRenderTime) / 1000 // Divide to 1000 to convert the milliseconds to seconds

    // Check if seconds since last render are less than the time between the two renders
    if (secondsSinceLastRender < 1 / SNAKE_SPEED) return // 1 seconds is the time between the two moves/renders (delay)

    lastRenderTime = currentTime // Update the last render time
    console.log(currentTime)

    f_Update() // Update the game/page logyc (snake' movement, snake' food, snake' length)
    f_Draw(gameBoard) // Draw everything on the screen based on update information (draw snake on the correct position, food position)
}

window.requestAnimationFrame(f_mainLoop) // Call Loop Function

// Update Function - Update Snake Lenght, Snake Movement
function f_Update() {

    f_addSegment() // Call Function to add segment to the snake on eaten food

    const inputDirect = f_getInputDirection() // Update the Snake Direction based on the Inputed Direction
    f_SnakeUpdate() // Call Function to Update the Snake Fragments' positions

    // Snake Moving Direction
    snakeBody[0].x += inputDirect.x // X Direction
    snakeBody[0].y += inputDirect.y // Y Direction

    f_FoodUpdate() // Call Function to Update the Food

    f_checkDeath() // Call Function to check for Death

}

// Draw Function - Draw Snake, 
function f_Draw(gameBoard) {

    // Remove the previous pieces
    gameBoard.innerHTML = ''

    f_DrawSnake(gameBoard) // Call Draw Snake Function
    f_DrawFood(gameBoard) // Call DrAw Food Function
}

// Function to Iterate the snakeBody and update the fragments positions
function f_SnakeUpdate(){

    // Second-to-last segment of the snake body loop 
    for (var i = snakeBody.length - 2; i >= 0; i--) // From bottom to top of the snake
    {
        // SNAKE_BODY[i + 1] -> Get the segment after the current segment (BOTTOM after Current)
        // ... is to duplicate a Object - to prevent any reference problems
        snakeBody[i + 1] = { ...snakeBody[i] }; // {...SNAKE_BODY[i] } is going to create a duplicate of our snake at position i and set it to the next segment
    }
}

function f_FoodUpdate() {
    if(f_onSnake(food)) { // Call Function to check if the food is on any snake segment -> If TRUE, continue
        f_expandSnake(EXPANSION_RATE) // Call Function to expand the snake by one
        food = f_randomFoodPosition() // New Food Position
    }
}

// Function to increase the snake segments by one
function f_expandSnake(amount) {
    newSegments += amount // Increment new segments quantity bt one (expansion rate)
}

// Function to check if the food is on the position of any snake segment
function f_onSnake(position, {ignoreHead = false} = {}){
    return snakeBody.some(( segment, index ) =>{ // Will iterate over all snake segments
        if( ignoreHead && index === 0 ) return false // If ignoreHead is true and segment index is 0 then return false (snake Head is on snake Head postion) -> snake Head doesn't touch other snake segment
        return f_equalPosition(position, segment) // Call Function to Compare Food and Segment Positions 
    })
}

// Function to Compare the food and Segment Positions
function f_equalPosition(pos1,pos2) {
    return pos1.x === pos2.x && pos1.y === pos2.y // Will Return True if Food and Segment positions are equal
}

function f_addSegment(){
    for (let i = 0; i < newSegments; i++) {
        snakeBody.push( {...snakeBody[snakeBody.length - 1] } ) // Add new segment (duplicate of the last snake segment) at the end of the snake
    }
    newSegments = 0 // Reset the new segments quantity
}

window.addEventListener('keydown',e => {
    switch (e.key) {
        case 'ArrowUp':
            if(lastInputDirection.y !== 0) break; // If already moving in any Y direction -> do nothing || Can't make 180 degrees rotation
            inputDirection = {x:0, y: -1} // Change the direction
            break
        case 'ArrowDown':
            if(lastInputDirection.y !== 0) break; // If already moving in any Y direction -> do nothing || Can't make 180 degrees rotation
            inputDirection = {x:0, y:1} // Change the direction
            break
        case 'ArrowLeft':
            if(lastInputDirection.x !== 0) break; // If already moving in any X direction -> do nothing || Can't make 180 degrees rotation
            inputDirection = {x:-1, y:0} // Change the direction
            break
        case 'ArrowRight':
            if(lastInputDirection.x !== 0) break; // If already moving in any X direction -> do nothing || Can't make 180 degrees rotation
            inputDirection = {x:1, y:0} // Change the direction
            break
    }
})


function f_getInputDirection(){
    lastInputDirection = inputDirection // Update the last input direction
    return inputDirection // Return the direction
}

// Draw Snake Function
function f_DrawSnake(gameBoard){
    // Draw snake fragments
    snakeBody.forEach(currentSegment => {
        const snakeElement = document.createElement("div") // Create div element (snake segment) on the main document (gameBoard)
        snakeElement.style.gridRowStart = currentSegment.y // Draw the Current Snake Segment on a row with x location
        snakeElement.style.gridColumnStart = currentSegment.x // Draw the Current Snake Segment on a column with y location
        snakeElement.classList.add('snake') // Add the snake element to the snake class list to be sure it will be visualized
        gameBoard.appendChild(snakeElement) // Append the current snake element to the gameBoard as child
    })
}

// Draw Food Function
function f_DrawFood(gameBoard){
    const foodElement = document.createElement("div") // Create div element (food segment) on the main document (gameBoard)
    foodElement.style.gridRowStart = food.y // Draw the Current foodfood Segment on a row with x location
    foodElement.style.gridColumnStart = food.x // Draw the Current food Segment on a column with y location
    foodElement.classList.add('food') // Add the food element to the food class list to be sure it will be visualized
    gameBoard.appendChild(foodElement) // Append the current food element to the gameBoard as child
}

// Function to Generate Random Food Location
function f_randomFoodPosition(){
    let newFoodPosition
    while (newFoodPosition == null || f_onSnake(newFoodPosition)){ // While new food position is null or any snake segment is on the current food position, then
        newFoodPosition = f_randomGridPosition() // Call Function to Generate random new food position
    }
    return newFoodPosition // Return the new food position
}

// Function to Generate Random Grid Postion
function f_randomGridPosition(){
    return {
        x: Math.floor(Math.random() * GRID_SIZE) + 1, // X position
        y: Math.floor(Math.random() * GRID_SIZE) + 1 // Y position
    }
}

// Function to check for death
function f_checkDeath(){
    // Game Over when Snake Head is out of the grid or 
    gameOver = f_outsideGrid(f_getSnakeHead())      ||   f_snakeIntersection()
}

// Function to check for outside of grid position
function f_outsideGrid(position){
    return( position.x < 1 || position.x > GRID_SIZE || 
            position.y < 1 || position.y > GRID_SIZE )
}

// Function to get snake head
function f_getSnakeHead(){
    return snakeBody[0] // Get the snake head postion
}

// Function to check if the snake head is touching other snake segment
function f_snakeIntersection() {
    return f_onSnake(snakeBody[0] , {ignoreHead: true}); // Return true if the snake head is touching other snake segment
}