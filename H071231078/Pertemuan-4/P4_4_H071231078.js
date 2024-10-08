const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

const jawaban = Math.floor(Math.random() * 101);
let count = 0;

const tanyaTebakan = () => {
    rl.question('Masukkan tebakan (antara 0 sampai 100): ', (input) => {
        const tebakan = parseInt(input);
        count += 1;

        if (isNaN(tebakan)) {
            console.log("Harap masukkan angka yang valid.");
            tanyaTebakan();
        } else if (tebakan === jawaban) {
            console.log(`Selamat! Kamu berhasil menebak angka ${jawaban} dengan benar dalam ${count} percobaan.`);
            rl.close();
        } else if (tebakan > jawaban) {
            console.log("Terlalu tinggi! Coba lagi.");
            tanyaTebakan();
        } else if (tebakan < jawaban) {
            console.log("Terlalu rendah! Coba lagi.");
            tanyaTebakan();
        }
    });
};

tanyaTebakan();
