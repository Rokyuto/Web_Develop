var moves_count = 0;

// Generate Random Grit cell for each image
function start_game() {
    var tab_position = new Array();
    while (tab_position.length < 12) {
        var number = Math.round(Math.random() * 100);
        if((number == 11) || (number == 12) || (number == 13) || (number == 14) || (number == 21) || (number == 22) || (number == 23) || (number == 24) || (number == 31) || (number == 32) || (number == 33) || (number == 34)){
            if(!tab_position.includes(number)){
                tab_position[tab_position.length] = number;
            }
        }
    }

    document.getElementById('p11').textContent = tab_position[0];
    document.getElementById('p11').style.background = 'url(Images/p'+tab_position[0]+'.png)';

    document.getElementById('p12').textContent = tab_position[1];
    document.getElementById('p12').style.background = 'url(Images/p'+tab_position[1]+'.png)';

    document.getElementById('p13').textContent = tab_position[2];
    document.getElementById('p13').style.background = 'url(Images/p'+tab_position[2]+'.png)';

    document.getElementById('p14').textContent = tab_position[3];
    document.getElementById('p14').style.background = 'url(Images/p'+tab_position[3]+'.png)';

    document.getElementById('p21').textContent = tab_position[4];
    document.getElementById('p21').style.background = 'url(Images/p'+tab_position[4]+'.png)';

    document.getElementById('p22').textContent = tab_position[5];
    document.getElementById('p22').style.background = 'url(Images/p'+tab_position[5]+'.png)';

    document.getElementById('p23').textContent = tab_position[6];
    document.getElementById('p23').style.background = 'url(Images/p'+tab_position[6]+'.png)';

    document.getElementById('p24').textContent = tab_position[7];
    document.getElementById('p24').style.background = 'url(Images/p'+tab_position[7]+'.png)';

    document.getElementById('p31').textContent = tab_position[8];
    document.getElementById('p31').style.background = 'url(Images/p'+tab_position[8]+'.png)';

    document.getElementById('p32').textContent = tab_position[9];
    document.getElementById('p32').style.background = 'url(Images/p'+tab_position[9]+'.png)';

    document.getElementById('p33').textContent = tab_position[10];
    document.getElementById('p33').style.background = 'url(Images/p'+tab_position[10]+'.png)';

    document.getElementById('p34').textContent = tab_position[11];
    document.getElementById('p34').style.background = 'url(Images/p'+ tab_position[11]+'.png)';

    document.getElementById('moves').textContent = "Moves: 0";
    moves_count = 0;

}

// Cell Movement

function switching(cell) {
    console.log(cell);
    if(document.getElementById(cell).textContent != '34')
    {
        switch(cell){
            case 'p11':
                if(document.getElementById('p12').textContent =='34'){
                    var temp_val=document.getElementById('p12').textContent;
                    document.getElementById('p12').textContent = document.getElementById('p11').textContent;
                    document.getElementById('p11').textContent = temp_val;

                    document.getElementById('p11').style.background = 'url(Images/p'+document.getElementById('p11').textContent+'.png)';
                    document.getElementById('p12').style.background = 'url(Images/p'+document.getElementById('p12').textContent+'.png)';
                    moves_count++;
                    document.getElementById('moves').textContent="Moves:"+moves_count
                }
                if(document.getElementById('p21').textContent =='34'){
                    var temp_val = document.getElementById('p21').textContent;
                    document.getElementById('p21').textContent = document.getElementById('p11').textContent;
                    document.getElementById('p11').textContent = temp_val;

                    document.getElementById('p11').style.background = 'url(Images/p'+document.getElementById('p11').textContent+'.png)';
                    document.getElementById('p21').style.background = 'url(Images/p'+document.getElementById('p21').textContent+'.png)';
                    moves_count++;
                    document.getElementById('moves').textContent="Moves:" + moves_count;
                }
            break;
            case 'p12':
                if(document.getElementById('p11').textContent =='34'){
                    var temp_val = document.getElementById('p11').textContent;
                    document.getElementById('p11').textContent = document.getElementById('p12').textContent;
                    document.getElementById('p12').textContent = temp_val;

                    document.getElementById('p12').style.background = 'url(Images/p'+document.getElementById('p12').textContent+'.png)';
                    document.getElementById('p11').style.background = 'url(Images/p'+document.getElementById('p11').textContent+'.png)';
                    moves_count++;
                    document.getElementById('moves').textContent="Moves:" + moves_count;
                }
                if(document.getElementById('p13').textContent =='34'){
                    var temp_val = document.getElementById('p13').textContent;
                    document.getElementById('p13').textContent = document.getElementById('p12').textContent;
                    document.getElementById('p12').textContent = temp_val;

                    document.getElementById('p13').style.background = 'url(Images/p'+document.getElementById('p13').textContent+'.png)';
                    document.getElementById('p12').style.background = 'url(Images/p'+document.getElementById('p12').textContent+'.png)';
                    moves_count++;
                    document.getElementById('moves').textContent="Moves:" + moves_count;
                }
                if(document.getElementById('p22').textContent =='34'){
                    var temp_val = document.getElementById('p22').textContent;
                    document.getElementById('p22').textContent = document.getElementById('p12').textContent;
                    document.getElementById('p12').textContent = temp_val;

                    document.getElementById('p22').style.background = 'url(Images/p'+document.getElementById('p22').textContent+'.png)';
                    document.getElementById('p12').style.background = 'url(Images/p'+document.getElementById('p12').textContent+'.png)';
                    moves_count++;
                    document.getElementById('moves').textContent="Moves:" + moves_count;
                }
            break;
            case 'p13':
                if(document.getElementById('p12').textContent =='34'){
                    var temp_val = document.getElementById('p12').textContent;
                    document.getElementById('p12').textContent = document.getElementById('p13').textContent;
                    document.getElementById('p13').textContent = temp_val;

                    document.getElementById('p12').style.background = 'url(Images/p'+document.getElementById('p12').textContent+'.png)';
                    document.getElementById('p13').style.background = 'url(Images/p'+document.getElementById('p13').textContent+'.png)';
                    moves_count++;
                    document.getElementById('moves').textContent="Moves:" + moves_count;
                }
                if(document.getElementById('p23').textContent =='34'){
                    var temp_val = document.getElementById('p23').textContent;
                    document.getElementById('p23').textContent = document.getElementById('p13').textContent;
                    document.getElementById('p13').textContent = temp_val;

                    document.getElementById('p13').style.background = 'url(Images/p'+document.getElementById('p13').textContent+'.png)';
                    document.getElementById('p23').style.background = 'url(Images/p'+document.getElementById('p23').textContent+'.png)';
                    moves_count++;
                    document.getElementById('moves').textContent="Moves:" + moves_count;
                }
                if(document.getElementById('p14').textContent =='34'){
                    var temp_val = document.getElementById('p14').textContent;
                    document.getElementById('p14').textContent = document.getElementById('p13').textContent;
                    document.getElementById('p13').textContent = temp_val;

                    document.getElementById('p14').style.background = 'url(Images/p'+document.getElementById('p14').textContent+'.png)';
                    document.getElementById('p13').style.background = 'url(Images/p'+document.getElementById('p13').textContent+'.png)';
                    moves_count++;
                    document.getElementById('moves').textContent="Moves:" + moves_count;
                }
            break;
            case 'p14':
                if(document.getElementById('p13').textContent =='34'){
                    var temp_val = document.getElementById('p13').textContent;
                    document.getElementById('p13').textContent = document.getElementById('p14').textContent;
                    document.getElementById('p14').textContent = temp_val;

                    document.getElementById('p14').style.background = 'url(Images/p'+document.getElementById('p14').textContent+'.png)';
                    document.getElementById('p13').style.background = 'url(Images/p'+document.getElementById('p13').textContent+'.png)';
                    moves_count++;
                    document.getElementById('moves').textContent="Moves:" + moves_count;
                }
                if(document.getElementById('p24').textContent =='34'){
                    var temp_val = document.getElementById('p24').textContent;
                    document.getElementById('p24').textContent = document.getElementById('p14').textContent;
                    document.getElementById('p14').textContent = temp_val;

                    document.getElementById('p14').style.background = 'url(Images/p'+document.getElementById('p14').textContent+'.png)';
                    document.getElementById('p24').style.background = 'url(Images/p'+document.getElementById('p24').textContent+'.png)';
                    moves_count++;
                    document.getElementById('moves').textContent="Moves:" + moves_count;
                }
            


            case 'p34':

                if(check_win())
                {
                    setTimeout(function() {
                        document.getElementById('p11').style.visibility = 'hidden';
                        document.getElementById('p12').style.visibility = 'hidden';
                        document.getElementById('p13').style.visibility = 'hidden';
                        document.getElementById('p14').style.visibility = 'hidden';
                        document.getElementById('p21').style.visibility = 'hidden';
                        document.getElementById('p22').style.visibility = 'hidden';
                        document.getElementById('p23').style.visibility = 'hidden';
                        document.getElementById('p24').style.visibility = 'hidden';
                        document.getElementById('p31').style.visibility = 'hidden';
                        document.getElementById('p32').style.visibility = 'hidden';
                        document.getElementById('p33').style.visibility = 'hidden';
                        document.getElementById('p34').style.visibility = 'hidden';

                        // Congrats background image

                        setTimeout(back_to_normal,5000);

                    },500);
                }
        }
    }
}

function check_win(){
    var cell1 = document.getElementById('p11').textContent;
    var cell2 = document.getElementById('p12').textContent;
    var cell3 = document.getElementById('p13').textContent;
    var cell4 = document.getElementById('p14').textContent;

    var cell5 = document.getElementById('p21').textContent;
    var cell6 = document.getElementById('p22').textContent;
    var cell7 = document.getElementById('p23').textContent;
    var cell8 = document.getElementById('p24').textContent;

    var cell9 = document.getElementById('p31').textContent;
    var cell10 = document.getElementById('p32').textContent;
    var cell11 = document.getElementById('p33').textContent;
    var cell12 = document.getElementById('p34').textContent;
    
    if((cell1 == '11' && cell2 == '12') && (cell3 == '13') && (cell4 == '14') && (cell5 == '21') && (cell6 == '22') && (cell7 == '23') && (cell8 == '24') && (cell9 == '31') && (cell10 == '32') && (cell11 == '33') && (cell12 == '34')){
        return true;
    }
    else{
        return false;
    }
}

function back_to_normal()
{
    // reset background
    setTimeout(reset_images,5000);
}

function reset_images(){
    document.getElementById('p11').style.visibility = 'visible';
    document.getElementById('p12').style.visibility = 'visible';
    document.getElementById('p13').style.visibility = 'visible';
    document.getElementById('p14').style.visibility = 'visible';
    document.getElementById('p21').style.visibility = 'visible';
    document.getElementById('p22').style.visibility = 'visible';
    document.getElementById('p23').style.visibility = 'visible';
    document.getElementById('p24').style.visibility = 'visible';
    document.getElementById('p31').style.visibility = 'visible';
    document.getElementById('p32').style.visibility = 'visible';
    document.getElementById('p33').style.visibility = 'visible';
    document.getElementById('p34').style.visibility = 'visible';

    document.getElementById('launch').textContent = 'Start Game';
    moves_count = 0;
    document.getElementById('moves').textContent = 'Moves: ';
}