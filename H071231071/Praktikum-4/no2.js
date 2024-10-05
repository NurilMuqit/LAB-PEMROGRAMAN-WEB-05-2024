function hitungDiskon() {
    const kategoriValid = ["elektronik", "pakaian", "makanan", "lainnya"];
    let harga;
    let kategoriInput;
    let diskon;
    let running = true;

    while (running) {
        while (true) {
            harga = parseFloat(prompt("Masukkan harga barang: "));
            if (isNaN(harga)) {
                alert("Masukkan harga yang valid (harus berupa angka).");
            } else if (harga < 1) {
                alert("Masukkan harga yang valid");
            } else {
                break; 
            }
        }
        
        kategoriInput = prompt("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ").toLowerCase();


        if (kategoriInput === "elektronik") {
            diskon = 10;
        } else if (kategoriInput === "pakaian") {
            diskon = 20;
        } else if (kategoriInput === "makanan") {
            diskon = 5;
        } else {
            diskon = 0;
        }

        let hargaSetelahDiskon = harga - (harga * diskon / 100);

        console.log(`Harga awal: Rp${harga}`);
        console.log(`Diskon: ${diskon}%`);
        console.log(`Harga setelah Diskon: Rp${hargaSetelahDiskon}`);
        
        running = false; 
    }
}

hitungDiskon();
