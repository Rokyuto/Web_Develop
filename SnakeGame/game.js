//import {f_Update as f_snakeUpdate , f_Draw as f_snakeDraw , SNAKE_SPEED } from './snake.js'

const SNAKE_SPEED = 1 // Snake moves 1 times per second
let lastRenderTime = 0
const snakeBody = [ 
    { x: 10, y: 11 },
    { x: 11, y: 11 },
    { x: 12, y: 11 } ] // Array with snake's segments and their XY positions in the grid
const gameBoard = document.getElementById('gameBoard') // Get the game board from the main document/page (index.html)

// Loop Function
function f_mainLoop(currentTime){

    window.requestAnimationFrame(f_mainLoop) // Request when is the Next Frame Render

    // Calculate seconds since the last Render
    const secondsSinceLastRender = (currentTime - lastRenderTime) / 1000 // Divide to 1000 to convert the milliseconds to seconds

    // Check if seconds since last render are less than the time between the two renders
    if(secondsSinceLastRender < 1 / SNAKE_SPEED) return // 1 seconds is the time between the two moves/renders (delay)

    lastRenderTime = currentTime // Update the last render time
    console.log(currentTime)

    f_Update() // Update the game/page logyc (snake' movement, snake' food, snake' length)
    f_Draw(gameBoard) // Draw everything on the screen based on update information (draw snake on the correct position, food position)
}

window.requestAnimationFrame(f_mainLoop) // Call Loop Function

// Update Function - Update Snake Lenght, Snake Movement
function f_Update(){
    // Second-to-last segment of the snake body loop 
    for(var i = snakeBody.length - 2; i >= 0; i--) // From bottom to top of the snake
    {
        // SNAKE_BODY[i + 1] -> Get the segment after the current segment (BOTTOM after Current)
        // ... is to duplicate a Object - to prevent any reference problems
        snakeBody[i + 1] = {...snakeBody[i] }; // {...SNAKE_BODY[i] } is going to create a duplicate of our snake at position i and set it to the next segment
    } 

    // Snake Moving
    snakeBody[0].x +=1
    snakeBody[0].y += 0
}

// Draw Function - Draw Snake, 
function f_Draw(gameBoard){

    // Remove the previous pieces
    gameBoard.innerHTML = ''

    snakeBody.forEach(currentSegment => {
        const snakeElement = document.createElement("div") // Create div element (snake segment) on the main document (gameBoard)
        snakeElement.style.gridRowStart = currentSegment.y // Draw the Current Snake Segment on a row with x location
        snakeElement.style.gridColumnStart = currentSegment.x // Draw the Current Snake Segment on a column with y location
        snakeElement.classList.add('snake') // Add the snake element to the snake class list to be sure it will be visualized
        gameBoard.appendChild(snakeElement) // Append the current snake element to the gameBoard as child
    })
}