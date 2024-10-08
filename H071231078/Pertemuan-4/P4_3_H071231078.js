const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

let hari = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];

const daysCount = (jumlahHari, indexHari) => {
    return (jumlahHari + indexHari) % 7;
};

function cekHari(hariYangDicari) {
    return hari => hari.toLowerCase() === hariYangDicari.toLowerCase();
}

rl.question('Masukkan hari awal (misal: senin): ', (hariAwal) => {
    let hariSebenarnya = hari.findIndex(cekHari(hariAwal));

    if (hariSebenarnya === -1) {
        console.log("Hari tidak valid. Pastikan ejaan benar.");
        rl.close();
        return;
    }

    rl.question('Masukkan jumlah hari: ', (jumlahHari) => {
        jumlahHari = parseInt(jumlahHari);

        if (isNaN(jumlahHari)) {
            console.log("Jumlah hari harus berupa angka.");
            rl.close();
            return;
        }

        let hariMendatang = hari[daysCount(jumlahHari, hariSebenarnya)];

        console.log(`Setelah ${jumlahHari} hari dari ${hariAwal}, hari berikutnya adalah ${hariMendatang}.`);
        rl.close();
    });
});
