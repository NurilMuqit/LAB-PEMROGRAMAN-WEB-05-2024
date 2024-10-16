function countEvenNumbers(start,end){
    let array = []
    for (let i = start; i<= end; i++){
        if (i % 2 == 0){
            array.push(i);
        }
    }
    console.log("output:"+ array.length,array);
}   
countEvenNumbers(1,10);

