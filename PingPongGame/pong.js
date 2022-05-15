const myCanvas = document.getElementById("pong"); // Get the Canvas object from the html page
const ctx = myCanvas.getContext("2d"); // Get all Methods and Properties of the canvas
// User Paddle Data
const user = {
    x: 0,
    y: (myCanvas.height - 100 ) / 2,
    width: 10,
    height: 100,
    score: 0,
    color: "WHITE"
}
// Computer Paddle Data
const com = {
    x: myCanvas.width - 10,
    y: (myCanvas.height - 100 ) / 2,
    width: 10,
    height: 100,
    score: 0,
    color: "WHITE"
}
// Net
const net = {
    x : (myCanvas.width - 2) / 2,
    y : 0,
    width : 2,
    height : 10,
    color: "WHITE",
}
//Ball
const ball = {
    x : myCanvas.width / 2,
    y : myCanvas.height / 2,
    radius : 10,
    velocityX: 5, // Velocity = speed + direction
    velocityY: 5, // Velocity = speed + direction
    speed : 5,
    color: "WHITE"
}

//Draw Rect
function f_drawRect(x, y, width, height, color) {
    ctx.fillStyle = color;
    ctx.fillRect(x, y, width, height);
}

// Draw Circle
function f_drawCircle(x, y, radius, color) {
    ctx.fillStyle = color;
    ctx.beginPath();
    // x , y , radius , start Angle , End Angle (360), direction
    ctx.arc(x, y,radius,0,Math.PI * 2,true); // Arc will take the Center of the circle
    ctx.closePath();
    ctx.fill();
}

function f_resetBall(){
    ball.x = myCanvas.width/2;
    ball.y = myCanvas.height/2;
    ball.speed = 5;
    ball.velocityX = -ball.velocityX; // Going to the Paddle who scored
}

myCanvas.addEventListener("mousemove",f_MovePaddle)

function f_MovePaddle(e) {
    let rect = myCanvas.getBoundingClientRect()
    // Update User Paddle Y Location to User Mouse Y Location in myCanvas borders
    user.y = e.clientY - rect.top - user.height/2;
}

function f_drawNet(){
    for(let i=0;i<=myCanvas.height;i+=15){
        f_drawRect(net.x, net.y + i, net.width, net.height, net.color);
    }
}

//Draw Text
function f_drawText(text, x, y){
    ctx.fillStyle = "#FFF";
    ctx.font = "75px fantasy";
    ctx.fillText(text, x, y);
}

function collision(ball,player) {
    //Player Coordinates
    player.top = player.y;
    player.bottom = player.y + player.height;
    player.left = player.x;
    player.right = player.x + player.width;

    //Ball Coordinates
    ball.top = ball.y - ball.radius;
    ball.bottom = ball.y + ball.radius;
    ball.left = ball.x - ball.radius;
    ball.right = ball.x + ball.radius;

    return ball.right > player.left && ball.top < player.bottom && ball.left < player.right && ball.bottom > player.top;
}

function update(){

    if (ball.x - ball.radius < 0){
        com.score++;
        f_resetBall();
    }else if(ball.x + ball.radius > myCanvas.width)
    {
        user.score++;
        f_resetBall();
    }

    ball.x += ball.velocityX; // X+
    ball.y += ball.velocityY; // Y+

    // computer plays for itself, and we must be able to beat it
    // simple AI
    com.y += ((ball.y - (com.y + com.height/2)))*0.1;

    if (ball.y + ball.radius > myCanvas.height || ball.y - ball.radius < 0 ){
        ball.velocityY =- ball.velocityY;
    }
    // Set when the ball is in the left field the player is User, when it is in the right field the player is Com
    let player = (ball.x + ball.radius < myCanvas.width/2) ? user : com; // player or computer
    
    if(collision(ball, player)){
        // Find Collide Point between Paddle and Ball
        let collidePoint = ( ball.y - (player.y + player.height/2))
        collidePoint = collidePoint / (player.height / 2);
        // Ball Rebound Angle
        let angleRad = (Math.PI / 4) * collidePoint;
        
        //Get Ball Direction - +1 or -1
        let direction = (ball.x + ball.radius < myCanvas.width/2) ? 1 : -1; // If the ball is in the left field or in the right field

        // Update Ball Direction and Rebound/Position
        ball.velocityX = direction *  ball.speed * Math.cos(angleRad);
        ball.velocityY = direction * ball.speed * Math.sin(angleRad);

        ball.speed += 0.1;
    }
}

function render() {
    //Draw Canvas
    f_drawRect(0,0,myCanvas.width,myCanvas.height,"#000");
    // Draw Scores
    f_drawText(user.score,myCanvas.width/4, myCanvas.height/5);
    f_drawText(com.score,3*myCanvas.width/4, myCanvas.height/5);
    f_drawNet();
    // Draw Paddles
    f_drawRect(user.x,user.y,user.width,user.height,user.color);
    f_drawRect(com.x,com.y,com.width,com.height,com.color);
    //Draw Circle
    f_drawCircle(ball.x, ball.y, ball.radius, ball.color);
}

function game() {
    update();
    render();
}

let framePerSecond = 50;

// Call Game Funtion 50 times every Second
let loop = setInterval(game,1000/framePerSecond);
