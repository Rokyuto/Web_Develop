'use strict'
const game = new Phaser.Game(500, 500, Phaser.AUTO, 'game-canvas', { preload, create, update })

let space;
let spaceVeloctiry = 5;

let leftButton;
let rightButton;
let fireButton;

let speed = 10;
let player;

let bullets;
let bulletTime = 0;

function preload() {
    game.load.image("bgd","pictures/backgrounds/background-starfield.png")
    game.load.spritesheet("player","pictures/backgrounds/ship (3).png")
    game.load.image("bullet","pictures/backgrounds/bullet.png")
}
    
function create() {
    createBgd();
    createButtons();
    createPlayer();
    createBullets();
}

function update(){
    playerMovement();
    bgdMovement();
    shootBullet();
}

function shootBullet(){
    if(fireButton.isDown){
        if(game.time.now > bulletTime){
            let bullet = bullets.getFirstExists(false);

            if(bullet){
                bullet.reset(player.x,player.y - 25);
                bullet.body.velocity.y -=1000;
                bulletTime = game.time.now + 200;
            }
        }
    }
}

function playerMovement(){
    if(leftButton.isDown && player.x > 25){
        player.x -= speed
    }else if(rightButton.isDown && player.x < 475){
        player.x += speed
    }
}

function bgdMovement() {
    space.tilePosition.y += spaceVeloctiry;
}

function createBullets(){
    bullets = game.add.group();
    bullets.enableBody = true;
    bullets.physicsBodyType = Phaser.Physics.ARCADE;
    bullets.createMultiple(30,'bullet');
    bullets.setAll('anchor.x',0.5);
    bullets.setAll('anchor.y',0.5);
    bullets.setAll('outOfBoundsKill',true);
    bullets.setAll('checkWorldBounds',true);
}

function createPlayer(){
    player = game.add.sprite(game.world.centerX,game.world.centerY + 200,"player");
    player.scale.setTo(0.5);
    player.anchor.setTo(0.5,0.5);
    //game.physic.enable(player,Phaser.Physics.ARCADE);

}

function createButtons(){
    leftButton = game.input.keyboard.addKey(Phaser.Keyboard.LEFT)
    rightButton = game.input.keyboard.addKey(Phaser.Keyboard.RIGHT)
    fireButton = game.input.keyboard.addKey(Phaser.Keyboard.UP)
    //cursor = game.input.keyboard.createCursorKeys();
}

function createBgd(){
    space = game.add.tileSprite(0,0,game.width,game.height,"bgd")
}