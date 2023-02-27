
player = game.add.sprite(0,0,"player")
player.scale.setTo(2)
player.frame = 4
player.animations.add("left",[0,1,2,3],10,true)
player.animations.add("right",[5,6,7,8],10,true)
player.animations.add("up",[4],10,true)
player.animations.add("down",[4],10,true)