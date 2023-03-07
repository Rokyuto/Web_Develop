'use strict'
const game = new Phaser.Game(1000, 900, Phaser.AUTO, 'game-canvas', { preload, create, update })

let space;
let spaceVeloctiry = 2;

let playButton;
let isGameStarted = false;

let leftButton;
let rightButton;
let fireButton;

let speed = 15;
let player;
var lifes = []
let score;
let scoreLabel;

let bullets;
let bulletTime = 0;

let enemies;
let explosion;
let enemyPassLabel;

let timer;

function preload() {
    game.load.image("bgd","pictures/backgrounds/background-starfield.png");
    game.load.image("player","pictures/backgrounds/ship (3).png");
    game.load.image("bullet","pictures/backgrounds/bullet.png");
    game.load.image("enemy","pictures/backgrounds/ship (1).png");
    game.load.spritesheet("explosion","pictures/spriteSheet/explosion.320x320.5x5.png",320/5,320/5);
    game.load.image("lifeIcon","pictures/backgrounds/ship (3).png");
    game.load.image("startButton","pictures/backgrounds/button.png");

}
    
function create() {
    playButton = game.add.button(game.world.centerX,game.world.centerY,"startButton", gameStart, this, 2, 1, 0);
    playButton.scale.setTo(0.75);
    playButton.anchor.setTo(0.5,0.5);
}

function update(){
    if(isGameStarted){
        bgdMovement();
        playerMovement();
        shootBullet();
        enemyMovement(4);

        game.physics.arcade.overlap(bullets,enemies,collisionHandler,null,this); // Call Overlap Event
        game.physics.arcade.overlap(player,enemies,takeLife,null,this);
    }
}

// -------------- GAME FUNCTIONS --------------

function gameStart(){
    isGameStarted = true;
    createBgd();
    createButtons();
    createPlayer();
    playerLifeSet();
    createPlayerScore();
    createBullets();
    createEnemies();
    game.physics.setBoundsToWorld();
}

function gameOver() {
    var style = { font: "bold 32px Arial", fill: "#fff", boundsAlignH: "center", boundsAlignV: "middle" };
    let gameOverLabel = game.add.text(game.world.centerX, game.world.centerY - 150, "GAME OVER :(",style);
    gameOverLabel.anchor.setTo(0.5);
    let scoreLabel = game.add.text(game.world.centerX, game.world.centerY - 100, "Score: " + score,style);
    scoreLabel.anchor.setTo(0.5);

    isGameStarted = false;
    create();
}

// Bullet & Enemy Overlap Collision Handler
function collisionHandler(bullet,enemy){
    bullet.kill();
    spawnExplosion(enemy.x,enemy.y);
    enemy.kill();
    updateScore();
}

// Explosion
function spawnExplosion(spawnX,spawnY){
    explosion = game.add.sprite(spawnX,spawnY,"explosion");
    explosion.anchor.setTo(0.5);
    explosion.scale.setTo(2)
    explosion.animations.add("explosion",[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25],10,true);
    explosion.animations.play("explosion",60,false,true);
}

// -------------- ENEMY FUNCTIONS --------------

function createEnemies() {
    enemies = game.add.group();
    enemies.enableBody = true;
    enemies.physicsBodyType = Phaser.Physics.ARCADE;
    //enemies.setAll('outOfBoundsKill',true);
    createTimer();
}

function spawnEnemies() {
    var enemiesCount = game.rnd.integerInRange(1,5);
    for(var currentEnemy = 0; currentEnemy < enemiesCount; currentEnemy++) {
        var randomXLocation = game.rnd.integerInRange(1,10);
        var enemy = game.add.sprite(randomXLocation*100 - 45,-40,'enemy'); // enemies.create
        enemy.anchor.setTo(0.5,0.5);
        enemy.scale.setTo(0.75);
        enemies.add(enemy);
        enemy.checkWorldBounds = true;
        enemy.events.onOutOfBounds.add(enemyPassPlayer, this);
    }
}

function createTimer() {
    timer = game.time.create(false);
    timer.loop(3500, spawnEnemies, this);
    timer.start();
}

function enemyMovement(velocitySpeed){
    enemies.forEach(function(enemy){
        enemy.y += velocitySpeed;
    })
    //enemyPassPlayer();
}

function enemyPassPlayer(){
    var style = { font: "bold 48px Arial", fill: "#fff", boundsAlignH: "center", boundsAlignV: "middle" };
    enemyPassLabel = game.add.text(game.width / 2, game.height /2 - 300, "ENEMY PASSED ",style);
    enemyPassLabel.anchor.setTo(0.5)
    game.time.events.add(Phaser.Timer.SECOND * 2, removeEnemyPassLabel, this);
    takeLife();
}

function removeEnemyPassLabel(){
    enemyPassLabel.destroy();
}

// -------------- BULLET FUNCTIONS --------------

function createBullets(){
    bullets = game.add.group();
    bullets.enableBody = true;
    bullets.physicsBodyType = Phaser.Physics.ARCADE;
    bullets.createMultiple(30,'bullet');
    bullets.setAll('anchor.x',0.5);
    bullets.setAll('anchor.y',0.5);
    bullets.setAll('scale.x',2)
    bullets.setAll('scale.y',2)
    bullets.setAll('outOfBoundsKill',true);
    bullets.setAll('checkWorldBounds',true);
}

function shootBullet(){
    if(fireButton.isDown){
        if(game.time.now > bulletTime){
            let bullet = bullets.getFirstExists(false);

            if(bullet){
                bullet.reset(player.x,player.y - 25);
                bullet.body.velocity.y -=2500;
                bulletTime = game.time.now + 200;
            }
        }
    }
}

// -------------- PLAYER FUNCTIONS --------------

function createPlayer(){
    player = game.add.sprite(game.world.centerX,game.world.centerY + 400,"player");
    player.scale.setTo(0.75);
    player.anchor.setTo(0.5,0.5);
    game.physics.enable(player,Phaser.Physics.ARCADE);
}

function playerMovement(){
    if(leftButton.isDown && player.x > 25){
        player.x -= speed
    }else if(rightButton.isDown && player.x < 975){
        player.x += speed
    }
}

function createButtons(){
    leftButton = game.input.keyboard.addKey(Phaser.Keyboard.LEFT)
    rightButton = game.input.keyboard.addKey(Phaser.Keyboard.RIGHT)
    fireButton = game.input.keyboard.addKey(Phaser.Keyboard.UP)
}

function playerLifeSet(){
    var style = { font: "bold 32px Arial", fill: "#fff", boundsAlignH: "center", boundsAlignV: "middle" };
    game.add.text(15, 15, "Lifes: ",style);
    var initialLifeIconXLocation = 130;
    for (var i = 0; i <3;i++){
        var life = game.add.sprite(initialLifeIconXLocation,40,"lifeIcon");
        life.scale.setTo(0.45);
        life.anchor.setTo(0.5,0.5);
        lifes.push(life);
        initialLifeIconXLocation += 15;
    }
}

function takeLife(){
    if(lifes.length >= 0){
        var lifeToRemove = lifes[lifes.length-1]
        lifeToRemove.destroy();
        lifes.pop(lifes.length - 1);
    }
    enemies.forEach(function(enemy){
        enemy.kill();
    })
    player.kill();
    createPlayer();
    if(lifes.length <= 0){
        gameOver();
    }
}

function createPlayerScore(){
    score = 0;
    var style = { font: "bold 32px Arial", fill: "#fff", boundsAlignH: "center", boundsAlignV: "middle" };
    scoreLabel = game.add.text(game.width - 15,10, "Score: " + score,style);
    scoreLabel.anchor.setTo(1,0);
}

function updateScore(){
    score += 10;
    scoreLabel.text = "Score: " + score;
}

// -------------- BACKGROUND FUNCTIONS --------------

function createBgd(){
    space = game.add.tileSprite(0,0,game.width,game.height,"bgd")
}

function bgdMovement() {
    space.tilePosition.y += spaceVeloctiry;
}