const inputTopup = document.getElementById("input-topup");
const btnSubmit = document.getElementById("submit");
const resultTopUp = document.getElementById("result-topup")

btnSubmit.addEventListener("click", function () {
    if (isNaN(inputTopup.value) || inputTopup.value < 100) {
        alert("Please enter a valid depo money (min. 100)");
        return;
    }

    setTimeout(() => {
        const topupAmount = parseInt(inputTopup.value);
        const currentSums = parseInt(yourMoney.textContent);
        yourMoney.textContent = currentSums + topupAmount;

        inputTopup.value = "";
        resultTopUp.textContent = "Yeay top-up.Ingat bayar!"
    }, 100)
});