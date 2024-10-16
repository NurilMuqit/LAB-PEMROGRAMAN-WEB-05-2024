const minNum = 1;
const maxNum = 100;
const answer = Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum;

let attempts = 0;
let guess;
let running = true;

while (running) {
    guess = prompt(`Masukkan salah satu dari angka ${minNum} sampai ${maxNum}`);
    guess = Number(guess);

    if (isNaN(guess)) {
        alert("Masukkan tebakan yang valid (harus berupa angka).");
    } else if (guess < minNum || guess > maxNum) {
        alert(`Pilih angka dari ${minNum} sampai ${maxNum}.`);
    } else {
        attempts++;
        if (guess > answer) {
            alert("Masih terlalu tinggi! Coba lagi...");
        } else if (guess < answer) {
            alert("Masih terlalu rendah! Coba lagi...");
        } else if (guess === answer) {
            alert(`Selamat! Kamu berhasil menebak angka ${answer} dengan benar dalam ${attempts} percobaan.`);
            running = false;
        }
    }
}