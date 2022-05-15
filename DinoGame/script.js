var player = document.getElementById("player")
var block = document.getElementById("block")

function playerJump(){
    if(player.classList != "playerJump"){
        player.classList.add("player_animation")
    }
    setTimeout(function(){
        player.classList.remove("player_animation")
    },500)
}

var checkDeath = setInterval(function(){
    var playerTop = parseInt(window.getComputedStyle(player).getPropertyValue("top")); // Top Position of the player
    var blockLeft = parseInt(window.getComputedStyle(block).getPropertyValue("left")); // Left Position of the block
    if(blockLeft < 40 && blockLeft > 0 && playerTop >= 720)
    {
        block.style.animation="none";
        block.style.display = "none";
        alert("You're DEATH.");
    }

},10);
