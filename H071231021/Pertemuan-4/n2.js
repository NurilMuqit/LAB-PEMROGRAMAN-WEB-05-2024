function calculateTotalPrice(price, itemType) {
    let discount = 0;

    switch (itemType.toLowerCase()) {
        case "elektronik":
            discount = 10;
            break;
        case "pakaian":
            discount = 20;
            break;
        case "makanan":
            discount = 5;
            break;
        case "lainnya":
            discount = 0;
            break;
        default:
            console.log('Error: Jenis barang tidak valid.');
            return;
    }

    let discountPrice = (price * discount) / 100;
    let totalPrice = price - discountPrice;

    console.log(`Harga awal: Rp${price}`);
    console.log(`Diskon: Rp${discountPrice}`);
    console.log(`Harga setelah diskon: Rp${totalPrice}`);
}

// Menggunakan input dari user
const readline = require('readline').createInterface({
    input: process.stdin,
    output: process.stdout
});



readline.question('Masukkan harga barang: ', (price) => {
    if (isNaN(price) || parseFloat(price) <= 0) {
        console.log('Error: Harga harus berupa angka positif dan bukan 0.');
        readline.close();
        return;
    }

    readline.question('Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ', (itemType) => {
        if (!itemType) {
            console.log('Error: Jenis barang tidak boleh kosong.');
            readline.close();
            return;
        }

        calculateTotalPrice(parseFloat(price), itemType);
        readline.close();
    });
});