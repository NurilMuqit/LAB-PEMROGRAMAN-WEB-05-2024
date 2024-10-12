function countEvenNumber(awal, akhir){
    let count = 0;
    let anggota = []
    for (let i = awal; i <= akhir; awal++){
        if (i % 2 === 0)
            count++
            anggota.push(i)
    }
    return count, anggota
}

console.log(countEvenNumber(1, 10))

