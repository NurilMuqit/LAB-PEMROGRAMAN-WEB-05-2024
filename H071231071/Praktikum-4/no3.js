const hariDalamSeminggu = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];

let running = true;
let hariSekarang;
let jumlahHari;

while (running) {
    while (true) {
        hariSekarang = prompt("Masukkan hari sekarang").toLowerCase();
        if (hariDalamSeminggu.includes(hariSekarang)) {
            break; 
        } else {
            alert("Masukkan inputan hari yang valid.");
        }
    }

    while (true) {    
        jumlahHari = prompt("Masukkan berapa hari kedepan yang ingin anda ketahui harinya");
        jumlahHari = Number(jumlahHari); 
        if (jumlahHari>0) {
            break; 
        } else {
            alert("Masukkan inputan angka yang valid.");
        }
    }

    if (isNaN(jumlahHari)) {
        alert("Masukkan inputan hari yang valid.");
    } else {
        const indeksHariSekarang = hariDalamSeminggu.indexOf(hariSekarang);
        const totalHari = (indeksHariSekarang + jumlahHari) % 7;
        console.log(`${jumlahHari} hari yang akan datang dari hari ${hariSekarang} adalah ${hariDalamSeminggu[totalHari]}.`);
        running = false;
    }
}
