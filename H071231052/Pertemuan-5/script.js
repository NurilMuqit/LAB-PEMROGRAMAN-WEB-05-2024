const playerCardsEl = document.getElementById('player-cards');
const dealerCardsEl = document.getElementById('dealer-cards');
const playerTotalEl = document.getElementById('player-total');
const dealerTotalEl = document.getElementById('dealer-total');
const playerMoneyEl = document.getElementById('player-money');
const betAmountEl = document.getElementById('bet-amount');
const placeBetBtn = document.getElementById('place-bet');
const hitBtn = document.getElementById('hit');
const stayBtn = document.getElementById('stay');
const resultEl = document.getElementById('result');
const gameOverEl = document.getElementById('game-over');
const increaseBetBtn = document.getElementById('increase-bet');
const decreaseBetBtn = document.getElementById('decrease-bet');

let deck = [];
let playerCards = [];
let dealerCards = [];
let playerMoney = 5000;
let currentBet = 0;
let gameInProgress = false;

function createDeck() {
    const suits = ['♠', '♥', '♦', '♣'];
    const values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    deck = [];
    for (let suit of suits) {
        for (let value of values) {
            deck.push({ suit, value });
        }
    }
}

function shuffleDeck() {
    for (let i = deck.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [deck[i], deck[j]] = [deck[j], deck[i]];
    }
}

function dealCard() {
    return deck.pop();
}

function calculateHandValue(hand) {
    let total = 0;
    let aces = 0;
    for (let card of hand) {
        if (card.value === 'A') {
            aces++;
            total += 11;
        } else if (['K', 'Q', 'J'].includes(card.value)) {
            total += 10;
        } else {
            total += parseInt(card.value);
        }
    }
    while (total > 21 && aces > 0) {
        total -= 10;
        aces--;
    }
    return total;
}

function updateUI() {
    playerCardsEl.innerHTML = playerCards.map(card => {
        let suitClass = (card.suit === '♥' || card.suit === '♦') ? 'red-suit' : 'black-suit';
        return `
        <div class="card ${suitClass}">
            <div class="card-value">${card.value}</div>
            <div class="card-suit">${card.suit}</div>
            <div class="card-value card-value-bottom">${card.value}</div>
        </div>
        `;
    }).join('');

    dealerCardsEl.innerHTML = dealerCards.map((card, index) => {
        let suitClass = (card.suit === '♥' || card.suit === '♦') ? 'red-suit' : 'black-suit';
        return index === 0 || !gameInProgress
            ? `
            <div class="card ${suitClass}">
                <div class="card-value">${card.value}</div>
                <div class="card-suit">${card.suit}</div>
                <div class="card-value card-value-bottom">${card.value}</div>
            </div>
            `
            : '<div class="card closed">.</div>';
    }).join('');

    playerTotalEl.textContent = calculateHandValue(playerCards);
    dealerTotalEl.textContent = gameInProgress ? calculateHandValue([dealerCards[0]]) : calculateHandValue(dealerCards);
    playerMoneyEl.textContent = playerMoney;
}

function startGame() {
    if (currentBet < 100 || currentBet > playerMoney) {
        alert('Taruhan harus minimal $100 dan tidak melebihi uang Anda.');
        return;
    }
    gameInProgress = true;
    createDeck();
    shuffleDeck();
    playerCards = [dealCard(), dealCard()];
    dealerCards = [dealCard(), dealCard()];
    updateUI();
    hitBtn.disabled = false;
    stayBtn.disabled = false;
    increaseBetBtn.disabled = true;
    decreaseBetBtn.disabled = true;
    placeBetBtn.disabled = true;
    betAmountEl.disabled = true;
    resultEl.textContent = '';
}

function hit() {
    playerCards.push(dealCard());
    updateUI();
    if (calculateHandValue(playerCards) > 21) {
        playerMoney = playerMoney - currentBet;
        updateUI()
        endGame('Anda bust! Bandar menang.');
    }
}

function stay() {
    gameInProgress = false;
    while (calculateHandValue(dealerCards) < 17) {
        dealerCards.push(dealCard());
        updateUI();
    }
    determineWinner();
}

function determineWinner() {
    const playerTotal = calculateHandValue(playerCards);
    const dealerTotal = calculateHandValue(dealerCards);
    if (playerTotal > 21) {
        playerMoney = playerMoney - currentBet;
        betAmountEl.value = 0
        endGame('Anda bust! Bandar menang.');
    } else if (dealerTotal > 21) {
        playerMoney = playerMoney + (currentBet * 2);
        betAmountEl.value = 0
        endGame('Bandar bust! Anda menang!');
    } else if (playerTotal > dealerTotal) {
        playerMoney = playerMoney + (currentBet * 2);
        betAmountEl.value = 0
        endGame('Anda menang!');
    } else if (dealerTotal > playerTotal) {
        playerMoney = playerMoney - currentBet;
        betAmountEl.value = 0
        endGame('Bandar menang.');
    } else {
        betAmountEl.value = 0
        endGame('Seri!');
    }
}

function endGame(message) {
    hitBtn.disabled = true;
    stayBtn.disabled = true;
    increaseBetBtn.disabled = false;
    decreaseBetBtn.disabled = false;
    placeBetBtn.disabled = false;
    betAmountEl.disabled = false;
    gameInProgress = false;
    currentBet = 0;
    if (playerMoney <= 0) {
        gameOverEl.style.display = 'flex';
    }
    if (playerMoney >= 5000) {
        playerMoneyEl.style.color = "green"
    } else {
        playerMoneyEl.style.color = "red"
    }
    updateUI()
    setTimeout(function () {
        alert(message)
    }, 1000)
}

placeBetBtn.addEventListener('click', () => {
    // betAmountEl = parseInt(betAmountEl.value)
    if (isNaN(parseInt(betAmountEl.value))) {
        alert("Taruhan Harus Berisi Angka")
    } else {
        currentBet = parseInt(betAmountEl.value);
        startGame();
    }
});

function updateBetValue(delta) {
    let currentBet = parseInt(betAmountEl.value); // Pastikan ada nilai default 100
    currentBet += delta;
    if (currentBet < 100) {
        currentBet = 100;
    }
    betAmountEl.value = currentBet;
}

// Event listener untuk tombol +100
increaseBetBtn.addEventListener('click', () => {
    updateBetValue(100);
});

// Event listener untuk tombol -100
decreaseBetBtn.addEventListener('click', () => {
    updateBetValue(-100);
});


hitBtn.addEventListener('click', hit);
stayBtn.addEventListener('click', stay);

updateUI();