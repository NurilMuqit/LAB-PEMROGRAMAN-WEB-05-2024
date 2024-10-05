function countEvenNumber(start, end) {
    let array = []
    let count = 0;
    for (let i = start; i <= end; i++) {
        if (i % 2 === 0) {
            array.push(i)
            count++;
        }
    }
    
    console.log(count + "("+ array + ")");
}

countEvenNumber(10,10)