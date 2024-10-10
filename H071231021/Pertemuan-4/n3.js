const { read } = require('fs');

const daysOfWeek = ["minggu", "senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];

function calculateFutureDay(currentDay, daysToAdd) {
    const currentIndex = daysOfWeek.indexOf(currentDay.toLowerCase());
    const futureIndex = (currentIndex + daysToAdd) % 7;
    return daysOfWeek[futureIndex];
}

const readline = require('readline').createInterface({
    input: process.stdin,
    output: process.stdout
});

readline.question('Masukkan hari saat ini (Minggu, Senin, Selasa, Rabu, Kamis, Jumat, Sabtu): ', (currentDay) => {
    const lowerCaseDay = currentDay.toLowerCase();
    if (!daysOfWeek.includes(lowerCaseDay)) {
        console.log('Error: Nama hari tidak valid.');
        readline.close();
        return;
    }

    readline.question('Masukkan jumlah hari yang akan datang: ', (daysToAdd) => {
        if (isNaN(daysToAdd) || parseInt(daysToAdd) <= 0) {
            console.log('Error: Jumlah hari harus berupa angka positif dan bukan 0.');
            readline.close();
            return;
        }

        const futureDay = calculateFutureDay(lowerCaseDay, parseInt(daysToAdd));
        console.log(`Hari ini adalah hari ${currentDay}, maka ${daysToAdd} hari dari sekarang adalah hari ${futureDay}`);
        readline.close();
        return;
    });
});
