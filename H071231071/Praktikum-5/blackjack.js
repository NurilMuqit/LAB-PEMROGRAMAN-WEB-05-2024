let dealerSum = 0;
let yourSum = 0;

let dealerAceCount = 0;
let yourAceCount = 0;

let hidden;
let deck;
let money = 5000;

let myBetInput = document.getElementById("bet-amount");

let canHit = true;

window.onload = function () {
    buildDeck();
    shuffleDeck();
    document.getElementById("start").addEventListener("click", startGame);
}

function buildDeck() {
    let values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
    let types = ["C", "D", "H", "S"];
    deck = [];

    for (let i = 0; i < types.length; i++) {
        for (let j = 0; j < values.length; j++) {
            deck.push(values[j] + "-" + types[i]);
        }
    }
}

function shuffleDeck() {
    for (let i = 0; i < deck.length; i++) {
        let j = Math.floor(Math.random() * deck.length);
        let temp = deck[i];
        deck[i] = deck[j];
        deck[j] = temp;
    }
}

function startGame() {
    myBet = Number(myBetInput.value);

    if (money <= 0) {
        window.alert("Game over! You have no more money to bet.");
        document.getElementById("start").disabled = true; // Disable the start button to prevent further gameplay
        return;
    }
    
    if (myBet >= 100 && myBet <= money) {
        document.getElementById("start").textContent = 'Try Again';
        resetGame(); // Reset game state

        money -= myBet;
        document.getElementById("myMoney").textContent = `Player's money: $${money}`

        // Deal two cards to the dealer
        hidden = deck.pop(); // This is the hidden card
        let visibleCard = deck.pop(); // This is the visible card
        
        // Update dealer's sum with only the visible card
        dealerSum += getValue(visibleCard);
        dealerAceCount += checkAce(visibleCard);
        
        // Display the card back for the hidden card
        let hiddenCardImg = document.createElement("img");
        hiddenCardImg.src = "./cards/BACK.png"; // Use cardback image for hidden card
        hiddenCardImg.id = "hidden"; // Assign ID to reveal later
        document.getElementById("dealer-cards").append(hiddenCardImg);
        
        // Display only the visible card for the dealer
        let visibleCardImg = document.createElement("img");
        visibleCardImg.src = "./cards/" + visibleCard + ".png";
        document.getElementById("dealer-cards").append(visibleCardImg);

        // Now deal two cards to the player
        for (let i = 0; i < 2; i++) {
            let cardImg = document.createElement("img");
            let card = deck.pop();
            cardImg.src = "./cards/" + card + ".png";
            yourSum += getValue(card);
            yourAceCount += checkAce(card);
            document.getElementById("your-cards").append(cardImg);
        }   

        document.getElementById("start").disabled = true;

        updateSums(); // Update displayed sums
        document.getElementById("hit").addEventListener("click", hit);
        document.getElementById("stay").addEventListener("click", stay);

    } else if (myBet < 100) {
        window.alert("Minimal uang taruhan adalah $100");
    } else if (myBet > money) {
        window.alert("Uang kamu tidak cukup :(");
    } else {
        window.alert("Silahkan menginput jumlah uang yang ingin dipertaruhkan");
    }
}

function hit() {
    if (!canHit) {
        return;
    }

    let cardImg = document.createElement("img");
    let card = deck.pop(); // Draw a new card
    cardImg.src = "./cards/" + card + ".png";
    
    console.log(`Drawing card for player: ${card}`); // Debugging

    yourSum += getValue(card);
    yourAceCount += checkAce(card);

    document.getElementById("your-cards").append(cardImg);
    
    updateSums(); // Update displayed sums after hitting

    // Check if player busts or hits 21
    const adjustedYourSum = reduceAce(yourSum, yourAceCount);
    if (adjustedYourSum > 21) {
        canHit = false;
        document.getElementById("results").innerText = "You busted!";
        revealDealerCard();
        disableButtons();
        document.getElementById("start").disabled = false;
        return;
    } else if (adjustedYourSum === 21) {
        canHit = false;
        document.getElementById("results").innerText = "You hit 21! You win!";
        revealDealerCard();
        disableButtons();
        document.getElementById("start").disabled = false;
        return;
    }
}


function stay() {
    canHit = false; // Disable Hit button
    revealDealerCard(); // Reveal dealer's hidden card

    // Dealer will keep drawing cards until the sum is 17 or higher
    while (dealerSum < 17 || (dealerSum === 17 && dealerAceCount > 0)) {
        let cardImg = document.createElement("img");
        let card = deck.pop();
        cardImg.src = "./cards/" + card + ".png";

        dealerSum += getValue(card);
        dealerAceCount += checkAce(card);
        document.getElementById("dealer-cards").append(cardImg);

        // Adjust for Aces after dealer draws a card
        dealerSum = reduceAce(dealerSum, dealerAceCount);
        
        updateSums(); // Update displayed sums after each draw
    }

    determineOutcome(); // Determine game outcome after dealer finishes
}

function revealDealerCard() {
    // Show the dealer's hidden card by changing its image source
    document.getElementById("hidden").src = "./cards/" + hidden + ".png";
    
    // Update dealer's sum displayed after revealing the card
    dealerSum += getValue(hidden); 
    dealerAceCount += checkAce(hidden); 
    updateSums(); 
}

function determineOutcome() {
    let message = "";

    const finalYourSum = reduceAce(yourSum, yourAceCount);
    const finalDealerSum = reduceAce(dealerSum, dealerAceCount); 

    if (finalYourSum > 21) {
        message = "You Lose!"; // Player busted
    } else if (finalDealerSum > 21) {
         money += (myBet * 2);
         message = "You win! Dealer busted"; // Dealer busted
    } else if (finalYourSum === finalDealerSum) {
         money += myBet;
         message = "Tie!"; // It's a tie
    } else if (finalYourSum > finalDealerSum) {
         money += (myBet * 2);
         message = "You Win!"; // Player has higher total
    } else {
         message = "You Lose!"; // Dealer has higher total
    }

    document.getElementById("myMoney").textContent = `Player's money: $${money}`;
    updateSums();

    document.getElementById("results").innerText = message;
    disableButtons();
    document.getElementById("start").disabled = false;
}

function disableButtons() {
    document.getElementById("hit").disabled = true;
    document.getElementById("stay").disabled = true;
}

function getValue(card) {
    let data = card.split("-"); 
    let value = data[0];

    if (isNaN(value)) {
        if (value === "A") {
            return 11; 
        }
        return 10; 
    }

    return parseInt(value); 
}

function checkAce(card) {
    if (card[0] === "A") {
        return 1; 
    }
    return 0;
}

function reduceAce(playerSum, playerAceCount) {
    while (playerSum > 21 && playerAceCount > 0) {
        playerSum -= 10; 
        playerAceCount -= 1;
    }
    return playerSum;
}

function updateSums() {
    const adjustedDealerSum = reduceAce(dealerSum, dealerAceCount);
    const adjustedYourSum = reduceAce(yourSum, yourAceCount);

    document.getElementById("dealer-sum").innerText = adjustedDealerSum;
    document.getElementById("your-sum").innerText = adjustedYourSum;
}

// Reset game state
function resetGame() {
    dealerSum = 0;
    yourSum = 0;
    dealerAceCount = 0;
    yourAceCount = 0;

    canHit = true;

    // Remove displayed cards
    document.getElementById("dealer-cards").innerHTML = '';
    document.getElementById("your-cards").innerHTML = '';

    // Reset bet input
    myBetInput.value = '';

    // Clear results display
    document.getElementById("results").innerText = '';

    // Re-enable buttons for a new game
    document.getElementById("hit").disabled = false;
    document.getElementById("stay").disabled = false;
}
