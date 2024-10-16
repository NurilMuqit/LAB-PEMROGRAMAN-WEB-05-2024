const countEvenNumbers = (start,end) => {
    let arr = [];

    for (let i = start; i <= end; i++) {
        if (i % 2 === 0) {
            arr.push(i)
        }
    }

    return arr
}

let hasil = countEvenNumbers(10,10);
console.log("output : "+hasil.length + "(" + hasil.join(',')+")");