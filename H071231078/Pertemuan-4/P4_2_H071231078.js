const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

const discountCount = (hargaBarang, jenisBarang) => {
    switch (jenisBarang.toLowerCase()) {
        case "elektronik":
            console.log("Harga awal: " + hargaBarang);
            console.log("Besaran diskon: 10%");
            console.log("Harga setelah diskon: " + (hargaBarang - hargaBarang * 0.1));
            break;
        case "pakaian":
            console.log("Harga awal: " + hargaBarang);
            console.log("Besaran diskon: 20%");
            console.log("Harga setelah diskon: " + (hargaBarang - hargaBarang * 0.2));
            break;
        case "makanan":
            console.log("Harga awal: " + hargaBarang);
            console.log("Besaran diskon: 5%");
            console.log("Harga setelah diskon: " + (hargaBarang - hargaBarang * 0.05));
            break;
        case "lainnya":
            console.log("Harga awal: " + hargaBarang);
            console.log("Besaran diskon: 0%");
            console.log("Harga setelah diskon: " + hargaBarang);
            break;
        default:
            console.log("Jenis barang tidak dikenali.");
            break;
    }
};

rl.question('Masukkan harga barang: ', (hargaInput) => {
    const hargaBarang = parseFloat(hargaInput);

    if (isNaN(hargaBarang)) {
        console.log("Harga barang harus berupa angka.");
        rl.close();
        return;
    }

    if (hargaBarang < 0){
        console.log("harga tidak boleh minus")
        rl.close()
        return;
    }

    rl.question('Masukkan jenis barang (elektronik, pakaian, makanan, lainnya): ', (jenisBarang) => {
        discountCount(hargaBarang, jenisBarang);
        rl.close(); 
    });
});
