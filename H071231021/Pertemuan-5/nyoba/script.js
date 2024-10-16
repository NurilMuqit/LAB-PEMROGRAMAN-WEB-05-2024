// script.js
document.addEventListener('DOMContentLoaded', () => {
    const statusDiv = document.getElementById('status');
    const playerMoneyDiv = document.getElementById('player-money');
    const betSection = document.getElementById('bet-section');
    const betInput = document.getElementById('bet-input');
    const placeBetButton = document.getElementById('place-bet');
    const allInButton = document.getElementById('all-in');
    const gameSection = document.getElementById('game-section');
    const playerHandDiv = document.getElementById('player-hand');
    const dealerHandDiv = document.getElementById('dealer-hand');
    const playerTotalSpan = document.getElementById('player-total');
    const dealerTotalSpan = document.getElementById('dealer-total');
    const controlsDiv = document.getElementById('controls');
    const gameOverDiv = document.getElementById('game-over');
    const gameOverMessage = document.getElementById('game-over-message');
    const restartButton = document.getElementById('restart');
    const muteButton = document.getElementById('mute-button');

    const backgroundMusic = document.getElementById('background-music');
    const winSound = document.getElementById('win-sound');
    const loseSound = document.getElementById('lose-sound');
    const pushSound = document.getElementById('push-sound');
    const gameOverSound = document.getElementById('game-over-sound');

    let isMuted = false;

    function playBackgroundMusic() {
        backgroundMusic.volume = 0.5;
        backgroundMusic.play().catch(error => {
            console.error('Error playing background music:', error);
        });
    }

    function toggleMute() {
        isMuted = !isMuted;
        backgroundMusic.muted = isMuted;
        muteButton.textContent = isMuted ? 'Sepi amat' : 'Berisik njir';
    }

    muteButton.addEventListener('click', toggleMute);

    let playerMoney = 5000;
    let currentBet = 0;
    let deck = [];
    let playerHand = [];
    let dealerHand = [];
    let roundOver = false;

    function shuffleDeck() {
        for (let i = deck.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [deck[i], deck[j]] = [deck[j], deck[i]];
        }
    }

    function initializeDeck() {
        const suits = ['♠', '♥', '♦', '♣'];
        const values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
        deck = [];
        suits.forEach(suit => {
            values.forEach(value => {
                deck.push({ value, suit });
            });
        });
        shuffleDeck();
    }

    function drawCard() {
        if (deck.length === 0) {
            initializeDeck();
        }
        return deck.pop();
    }

    function calculateTotal(hand) {
        let total = 0;
        let aces = 0;
        hand.forEach(card => {
            if (card.value === 'A') {
                aces += 1;
                total += 11;
            } else if (['K', 'Q', 'J'].includes(card.value)) {
                total += 10;
            } else {
                total += parseInt(card.value);
            }
        });
        while (total > 21 && aces > 0) {
            total -= 10;
            aces -= 1;
        }
        return total;
    }

    function displayHands(showDealerHole = false) {
        playerHandDiv.innerHTML = '';
        dealerHandDiv.innerHTML = '';

        playerHand.forEach(card => {
            const cardDiv = document.createElement('div');
            cardDiv.classList.add('card');
            cardDiv.textContent = `${card.value}${card.suit}`;
            playerHandDiv.appendChild(cardDiv);
        });
        playerTotalSpan.textContent = calculateTotal(playerHand);

        dealerHand.forEach((card, index) => {
            const cardDiv = document.createElement('div');
            cardDiv.classList.add('card');
            if (index === 1 && !showDealerHole) {
                cardDiv.textContent = '🂠';
            } else {
                cardDiv.textContent = `${card.value}${card.suit}`;
            }
            dealerHandDiv.appendChild(cardDiv);
        });

        dealerTotalSpan.textContent = showDealerHole ? calculateTotal(dealerHand) : calculateTotal([dealerHand[0]]);
    }

    function updateControls(state) {
        controlsDiv.innerHTML = '';
        
        if (state === 'playing') {
            controlsDiv.innerHTML = `
                <button id="hit">Hit</button>
                <button id="stay">Stay</button>
            `;
            document.getElementById('hit').addEventListener('click', hitAction);
            document.getElementById('stay').addEventListener('click', stayAction);
        } else if (state === 'roundEnd') {
            controlsDiv.innerHTML = `
                <button id="continue">Continue</button>
                <button id="round-restart">Restart</button>
            `;
            document.getElementById('continue').addEventListener('click', continueGame);
            document.getElementById('round-restart').addEventListener('click', restartGame);
        }
    }

    function startGame() {
        roundOver = false;
        initializeDeck();
        playerHand = [drawCard(), drawCard()];
        dealerHand = [drawCard(), drawCard()];
        displayHands();
        statusDiv.textContent = "Pilih 'Hit' atau 'Stay'";
        statusDiv.className = '';
        gameSection.classList.remove('hidden');
        updateControls('playing');
        playBackgroundMusic();

        const playerTotal = calculateTotal(playerHand);
        if (playerTotal === 21) {
            statusDiv.textContent = 'Anda mendapatkan 21! Menentukan hasil...';
            revealDealerHand();
            dealerTurn();
        }
    }

    function hitAction() {
        if (roundOver) return;
        try {
            playerHand.push(drawCard());
            displayHands();
            const total = calculateTotal(playerHand);
            if (total > 21) {
                statusDiv.textContent = 'Anda Bust! Bandar Menang.';
                statusDiv.classList.add('status-lose');
                loseSound.play();
                endRound(false);
            } else if (total === 21) {
                statusDiv.textContent = 'Anda mendapatkan 21! Menentukan hasil...';
                revealDealerHand();
                dealerTurn();
            }
        } catch (error) {
            console.error('Error during Hit action:', error);
            alert('Terjadi kesalahan saat mencoba Hit. Silakan coba lagi.');
        }
    }

    function stayAction() {
        if (roundOver) return;
        try {
            revealDealerHand();
            dealerTurn();
        } catch (error) {
            console.error('Error during Stay action:', error);
            alert('Terjadi kesalahan saat mencoba Stay. Silakan coba lagi.');
        }
    }

    function revealDealerHand() {
        displayHands(true);
    }

    function dealerTurn() {
        try {
            let dealerTotal = calculateTotal(dealerHand);
            while (dealerTotal < 17) {
                dealerHand.push(drawCard());
                dealerTotal = calculateTotal(dealerHand);
                displayHands(true);
            }
            determineWinner();
        } catch (error) {
            console.error('Error during dealer turn:', error);
            alert('Terjadi kesalahan saat giliran bandar. Silakan coba lagi.');
        }
    }

    function determineWinner() {
        try {
            const playerTotal = calculateTotal(playerHand);
            const dealerTotal = calculateTotal(dealerHand);

            if (dealerTotal > 21) {
                statusDiv.textContent = 'Bandar Bust! Anda Menang.';
                statusDiv.classList.add('status-win');
                winSound.play();
                endRound(true);
            } else if (dealerTotal > playerTotal) {
                statusDiv.textContent = 'Bandar Menang.';
                statusDiv.classList.add('status-lose');
                loseSound.play();
                endRound(false);
            } else if (dealerTotal < playerTotal) {
                statusDiv.textContent = 'Anda Menang!';
                statusDiv.classList.add('status-win');
                winSound.play();
                endRound(true);
            } else {
                statusDiv.textContent = 'Push (Seri).';
                statusDiv.classList.add('status-push');
                pushSound.play();
                pushRound();
            }
        } catch (error) {
            console.error('Error determining winner:', error);
            alert('Terjadi kesalahan saat menentukan pemenang. Silakan coba lagi.');
        }
    }

    function endRound(playerWin) {
        roundOver = true;
        if (playerWin) {
            playerMoney += currentBet * 2;
        }
        updateMoneyDisplay();
        updateControls('roundEnd');
        betSection.classList.add('hidden');
        
        if (playerMoney < 100) {
            setTimeout(() => {
                showGameOver('Awokokwaowkoawok tobat bang jan maen judol');
            }, 2000);
        }
    }

    function pushRound() {
        roundOver = true;
        playerMoney += currentBet;
        updateMoneyDisplay();
        updateControls('roundEnd');
        betSection.classList.add('hidden');
        
        if (playerMoney < 100) {
            setTimeout(() => {
                showGameOver('Awokokwaowkoawok tobat bang jan maen judol');
            }, 2000);
        }
    }

    function showGameOver(message) {
        gameOverDiv.classList.remove('hidden');
        gameOverMessage.textContent = message;
        gameSection.classList.add('hidden');
        betSection.classList.add('hidden');
        gameOverSound.play();
    }

    function continueGame() {
        betSection.classList.remove('hidden');
        updateControls('playing');
        gameSection.classList.add('hidden');
        statusDiv.textContent = '';
        statusDiv.className = '';
        currentBet = 0;
    }

    function restartGame() {
        playerMoney = 5000;
        updateMoneyDisplay();
        continueGame();
    }

    function handleGameOverRestart() {
        playerMoney = 5000;
        currentBet = 0;
        updateMoneyDisplay();
        gameOverDiv.classList.add('hidden');
        betSection.classList.remove('hidden');
        gameSection.classList.add('hidden');
        statusDiv.textContent = '';
        statusDiv.className = '';
        
        playerHand = [];
        dealerHand = [];
        
        playerHandDiv.innerHTML = '';
        dealerHandDiv.innerHTML = '';
        playerTotalSpan.textContent = '0';
        dealerTotalSpan.textContent = '0';
        
        updateControls('playing');
    }

    function updateMoneyDisplay() {
        playerMoneyDiv.textContent = `Uang Anda: $${playerMoney}`;
    }

placeBetButton.addEventListener('click', () => {
    try {
        if (!betInput.value.match(/^\d+$/)) {
            alert('Masukkan hanya angka untuk taruhan!');
            betInput.value = '100';
            return;
        }

        const bet = parseInt(betInput.value);
        if (isNaN(bet) || bet < 100) {
            alert('Taruhan minimal adalah $100');
            betInput.value = '100';
            return;
        }
        if (bet > playerMoney) {
            alert('Uang tidak cukup untuk taruhan ini');
            betInput.value = playerMoney.toString();
            return;
        }
        currentBet = bet;
        playerMoney -= bet;
        updateMoneyDisplay();
        betSection.classList.add('hidden');
        startGame();
    } catch (error) {
        console.error('Error placing bet:', error);
        alert('Terjadi kesalahan saat memasang taruhan. Silakan coba lagi.');
        betInput.value = '100';
    }
});


    allInButton.addEventListener('click', () => {
        try {
            if (playerMoney < 100) {
                alert('Uang tidak cukup untuk melakukan All In.');
                return;
            }
            currentBet = playerMoney;
            playerMoney = 0;
            updateMoneyDisplay();
            betSection.classList.add('hidden');
            startGame();
        } catch (error) {
            console.error('Error during All In:', error);
            alert('Terjadi kesalahan saat melakukan All In. Silakan coba lagi.');
        }
    });

    restartButton.addEventListener('click', handleGameOverRestart);

    updateMoneyDisplay();
    updateControls('playing');
});
