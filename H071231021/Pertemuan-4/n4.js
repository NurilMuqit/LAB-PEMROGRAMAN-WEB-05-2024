const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

const targetNumber = Math.floor(Math.random() * 100) + 1;
let attempts = 0;

function askGuess() {
    rl.question('Masukkan salah satu dari angka 1 sampai 100: ', (input) => {
        const guess = parseInt(input);

        if (isNaN(guess) || guess < 1 || guess > 100) {
            console.log('Error: Masukkan angka yang valid antara 1 dan 100.');
            askGuess();
            return;
        }

        if (guess < targetNumber) {
            attempts++;
            console.log('Terlalu rendah! Coba lagi. Percobaan ke-' + attempts);
            askGuess();
        } else if (guess > targetNumber) {
            attempts++;
            console.log('Terlalu tinggi! Coba lagi. Percobaan ke-' + attempts);
            askGuess();
        } else {
            console.log(`Selamat! Kamu berhasil menebak angka ${targetNumber} dengan benar.`);
            console.log(`Sebanyak ${attempts}x percobaan.`);
            rl.close();
        }
    });
}

askGuess();
