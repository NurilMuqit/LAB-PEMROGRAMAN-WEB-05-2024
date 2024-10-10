function countEvenNumbers (start, end) {
    let count = 0
    let evenNumbers = []

    for (let i = start; i <= end; i++) {
        if (i % 2 === 0) {
            count++
            evenNumbers.push(i)
        }
    }
    return `${count} (${evenNumbers})`
}

console.log(countEvenNumbers(10,10))