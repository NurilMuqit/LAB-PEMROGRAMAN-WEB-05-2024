const Cards = [
    { name: "10-C", src: "cards/10-C.png", value: 10 },
    { name: "10-D", src: "cards/10-D.png", value: 10 },
    { name: "10-H", src: "cards/10-H.png", value: 10 },
    { name: "10-S", src: "cards/10-S.png", value: 10 },
    { name: "2-C", src: "cards/2-C.png", value: 2 },
    { name: "2-D", src: "cards/2-D.png", value: 2 },
    { name: "2-H", src: "cards/2-H.png", value: 2 },
    { name: "2-S", src: "cards/2-S.png", value: 2 },
    { name: "3-C", src: "cards/3-C.png", value: 3 },
    { name: "3-D", src: "cards/3-D.png", value: 3 },
    { name: "3-H", src: "cards/3-H.png", value: 3 },
    { name: "3-S", src: "cards/3-S.png", value: 3 },
    { name: "4-C", src: "cards/4-C.png", value: 4 },
    { name: "4-D", src: "cards/4-D.png", value: 4 },
    { name: "4-H", src: "cards/4-H.png", value: 4 },
    { name: "4-S", src: "cards/4-S.png", value: 4 },
    { name: "5-C", src: "cards/5-C.png", value: 5 },
    { name: "5-D", src: "cards/5-D.png", value: 5 },
    { name: "5-H", src: "cards/5-H.png", value: 5 },
    { name: "5-S", src: "cards/5-S.png", value: 5 },
    { name: "6-C", src: "cards/6-C.png", value: 6 },
    { name: "6-D", src: "cards/6-D.png", value: 6 },
    { name: "6-H", src: "cards/6-H.png", value: 6 },
    { name: "6-S", src: "cards/6-S.png", value: 6 },
    { name: "7-C", src: "cards/7-C.png", value: 7 },
    { name: "7-D", src: "cards/7-D.png", value: 7 },
    { name: "7-H", src: "cards/7-H.png", value: 7 },
    { name: "7-S", src: "cards/7-S.png", value: 7 },
    { name: "8-C", src: "cards/8-C.png", value: 8 },
    { name: "8-D", src: "cards/8-D.png", value: 8 },
    { name: "8-H", src: "cards/8-H.png", value: 8 },
    { name: "8-S", src: "cards/8-S.png", value: 8 },
    { name: "9-C", src: "cards/9-C.png", value: 9 },
    { name: "9-D", src: "cards/9-D.png", value: 9 },
    { name: "9-H", src: "cards/9-H.png", value: 9 },
    { name: "9-S", src: "cards/9-S.png", value: 9 },
    { name: "A-C", src: "cards/A-C.png", value: 11 },
    { name: "A-D", src: "cards/A-D.png", value: 11 },
    { name: "A-H", src: "cards/A-H.png", value: 11 },
    { name: "A-S", src: "cards/A-S.png", value: 11 },
    { name: "J-C", src: "cards/J-C.png", value: 10 },
    { name: "J-D", src: "cards/J-D.png", value: 10 },
    { name: "J-H", src: "cards/J-H.png", value: 10 },
    { name: "J-S", src: "cards/J-S.png", value: 10 },
    { name: "K-C", src: "cards/K-C.png", value: 10 },
    { name: "K-D", src: "cards/K-D.png", value: 10 },
    { name: "K-H", src: "cards/K-H.png", value: 10 },
    { name: "K-S", src: "cards/K-S.png", value: 10 },
    { name: "Q-C", src: "cards/Q-C.png", value: 10 },
    { name: "Q-D", src: "cards/Q-D.png", value: 10 },
    { name: "Q-H", src: "cards/Q-H.png", value: 10 },
    { name: "Q-S", src: "cards/Q-S.png", value: 10 }
];


document.addEventListener("DOMContentLoaded", function() {
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    myModal.show();
});

//variabel
let deposit = document.getElementById("deposit")
let depositCount = document.getElementById("depositCount")
let startBtn = document.getElementById("Start")
let playBtn = document.getElementById("playGame")
let playAgain = document.getElementById("playAgain")
let bet = document.getElementById("bet")
let holdd = document.getElementById("hold")
let chip_50 = document.getElementById("chip_50")
let chip_100 = document.getElementById("chip_100")
let chip_200 = document.getElementById("chip_200")
let chip_500 = document.getElementById("chip_500")
let container1 = document.getElementById("container1")
let container2_1 = document.getElementById("container2-1")
let container2_2 = document.getElementById("container2-2")
let container3 = document.getElementById("container3")
let loseButton = document.getElementById("loseBtn")


let playerCardarr = [];
let botCardarr = [];
let depositSum;
let betSum = 0;
let playerCardSum = 0
let botCardSum = 0
let winStatus = 0;
let playStatus = false;
let depositStatus = 0;



function handleChipClick(chip) {
    chip.addEventListener("click", function() {
        if (depositStatus === 1) { 
            let chipValue = parseInt(chip.value);
            if (chipValue > depositSum) {
                alert("deposit tidak cukup");
            } else {
                depositSum -= chipValue;
                betSum += chipValue;
                bet.innerHTML = betSum;
                updateDeposit();
            }
        } else {
            alert("Silakan masukkan deposit terlebih dahulu!");
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        }
    });
}

handleChipClick(chip_50);
handleChipClick(chip_100);
handleChipClick(chip_200);
handleChipClick(chip_500);


function playerCardload() {
    container2_2.innerHTML = '';  
    for (let i = 0; i < playerCardarr.length; i++) {
        let playerCard = document.createElement("img");
        playerCard.setAttribute("src", playerCardarr[i].src);
        playerCard.classList.add("card-animated"); 
        container2_2.appendChild(playerCard);
    }
}

function botCardload(hideSecondCard = true) {
    container2_1.innerHTML = '';  

    for (let i = 0; i < botCardarr.length; i++) {
        let botCard = document.createElement("img");

        if (hideSecondCard && i === 1) {
            botCard.setAttribute("src", "cards/BACK.png");
        } else {
            botCard.setAttribute("src", botCardarr[i].src); 
        }
        
        botCard.classList.add("card-animated");  
        container2_1.appendChild(botCard);
    }
}


startBtn.addEventListener("click", function() {
    if (deposit.value > 0) {
        depositSum = parseInt(deposit.value);
        depositCount.innerHTML = depositSum;
        depositStatus = 1;
    } else {
        alert("input harus berupa angka!");
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.show();
    }
});


playBtn.addEventListener("click", function() {
    if (betSum == 0) {
        alert("masukkan bet terlebih dahulu");
    } else {
        for (let i = 0; i < 2; i++) {
            let botDrawCard = draw();
            let playerDrawCard = draw();
            botCardarr.push(botDrawCard);
            playerCardarr.push(playerDrawCard);
        }
        
        botSecondCardValue = botCardarr[1].value;
        botSecondCardHidden = true;

        playerCardload();
        botCardload(); 
        playerUpdateCount();
        botUpdateCount();
        playStatus = true;
    }
    winStatus = 3;
});


function revealBotSecondCard() {
    botCardload(false);  
}

function draw() {
    let card = Cards.splice(Math.floor(Math.random() * Cards.length), 1)[0];
    return card;
}


let addcard = document.getElementById("addcard")
addcard.addEventListener('click', function(){
    if (playStatus == false || playerCardSum >= 21) {
        alert("fitur tidak tersedia sekarang");
    } else {
        let playerDrawCard = draw();
        if (["A-C", "A-H", "A-D", "A-S"].includes(playerDrawCard.name)) {
            if (playerDrawCard.value + playerCardSum > 21) {
                playerDrawCard.value = 1;
            }
        }
        playerCardarr.push(playerDrawCard);
        playerCardload();
        playerUpdateCount();
    }
});


function playerCardCount() {
    let value = 0;
    let aceCount = 0;

    for (let i = 0; i < playerCardarr.length; i++) {
        if (["A-C", "A-H", "A-D", "A-S"].includes(playerCardarr[i].name)) {
            aceCount += 1;
            value += 11;  
        } else {
            value += playerCardarr[i].value;
        }
    }
    while (value > 21 && aceCount > 0) {
        value -= 10;  
        aceCount -= 1;
    }

    return value;
}

function botCardCount(excludeSecondCard = true) {
    let value = 0;
    let aceCount = 0;

    for (let i = 0; i < botCardarr.length; i++) {
        if (excludeSecondCard && i === 1 && botSecondCardHidden) {
            continue;  
        }
        
        if (["A-C", "A-H", "A-D", "A-S"].includes(botCardarr[i].name)) {
            aceCount += 1;
            value += 11;  
        } else {
            value += botCardarr[i].value;
        }
    }
    while (value > 21 && aceCount > 0) {
        value -= 10;  
        aceCount -= 1;
    }

    return value;
}

function playerUpdateCount() {
    container3.innerHTML = '';
    
    let value = document.createElement("h3");
    let cardSum = playerCardCount();
    value.innerHTML = cardSum;
    playerCardSum = cardSum;
    container3.appendChild(value);  
    playerCardload();

    setTimeout(() => {
        if (cardSum > 21) {
            setTimeout(() => {
                winStatus = 1;
                setTimeout(() => {
                    gameEnd();  
                    resetGame();  
                }, 500);  
            }, 500);  
        }
    }, 500);  
}


function botUpdateCount() {
    container1.innerHTML = '';
    let value = document.createElement("h3");
    let cardSum = botCardCount(); 
    value.innerHTML = cardSum;
    botCardSum = cardSum;
    container1.appendChild(value); 
    botCardload();

    setTimeout(() => {
        if (cardSum > 21) {
            revealBotSecondCard();

            setTimeout(() => {
                winStatus = 1;
                setTimeout(() => {
                    gameEnd();
                    resetGame();
                }, 1000);
            }, 1500);
        }
    }, 500);
}

holdd.addEventListener("click", function() {
    if (playStatus == false) {
        alert("fitur tidak tersedia");
    } else {
        while (botCardSum < 17) {
            let botDrawCard = draw();
            botCardarr.push(botDrawCard);
            botCardload();  
            botUpdateCount();
        }

        
        setTimeout(() => {
            revealBotSecondCard();  
        }, 1500);  

        setTimeout(() => {
            if (botCardSum < playerCardSum) {
                alert("menang");
                winStatus = 0;
                gameEnd();
                resetGame();
            } else if (botCardSum === playerCardSum) {
                if (botCardSum !== 0 || playerCardSum !== 0) {
                    alert("tie");
                    winStatus = 2;
                    resetGame();
                }
            } else if (botCardSum > playerCardSum) {
                if (botCardSum <= 21) {
                    winStatus = 1;
                    gameEnd();
                    resetGame();
                } else {
                    alert("menang");
                    winStatus = 0;
                    gameEnd();
                    resetGame();
                }
            }
        }, 2500);
    }
});


function gameEnd (){
    if (winStatus == 0) {
        depositSum += betSum * 2
    }else if(winStatus == 1){
        depositSum = parseInt(depositSum)
    } else if(winStatus == 2){
        depositSum += betSum   
    }
    updateDeposit()
    
}

function updateDeposit() {
    depositCount.innerHTML = depositSum
}
playAgain.addEventListener("click", function(){
    resetGame()
})

function resetGame() {
    if (depositStatus == 0 || playStatus == false) {
        alert("fitur ini tidak tersedia. Mulai game terlebih dahulu")
    } else{
        for (let i = 0; i < playerCardarr.length; i++) {
            Cards.push(playerCardarr[i])
        }
        for (let i = 0; i < botCardarr.length; i++) {
            Cards.push(botCardarr[i])
        }
        playerCardarr.length = 0;
        botCardarr.length = 0;
        if (winStatus == 3 || winStatus == 2) {
            depositSum += betSum
        }
        betSum = 0;
        bet.innerHTML = betSum
        playerCardSum = 0
        botCardSum = 0
        playerCardload();
        botCardload();
        playerUpdateCount()
        botUpdateCount()
        updateDeposit()
        playStatus = false
        if (depositSum <= 0) {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal2'));
            myModal.show();
        }
    }
}


loseButton.addEventListener("click", function () {
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    myModal.show();
})
    


