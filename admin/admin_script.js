document.addEventListener("DOMContentLoaded", function () {
    const btnConfirm = document.querySelectorAll('.btnConfirm');
    const formCalculatorModal = document.getElementsByClassName('payment-calculator')[0];
    const formCalculator = document.getElementById('formCalculator');

    let totalCost = 0;

    btnConfirm.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            formCalculatorModal.style.display = 'flex';

            const buses = this.getAttribute('data-buses');
            const days = this.getAttribute('data-days');
            const bookingID = this.getAttribute('data-id');

            document.getElementById('numberOfBus').value = buses;
            document.getElementById('numberOfDays').value = days;
            document.getElementById('bookingID').value = bookingID;
        });
    });

    document.getElementById('getTotalCost').addEventListener('click', (event) => {
        event.preventDefault();

        const buses = document.getElementById('numberOfDays').value;
        const days = document.getElementById('numberOfBus').value;
        const toll = document.getElementById('tollFees').value;
        const diesel = document.getElementById('diesel').value;
        const distance = document.getElementById('distance').value;

        totalCost = (diesel * distance * buses * days) + (toll * days * buses);

        const formattedTotalCost = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP'
        }).format(totalCost);

        document.getElementById('totalCost').textContent = formattedTotalCost;
        document.getElementById('totalFees').value = totalCost;
    });

    // cancel button
    document.getElementById('cancel').addEventListener('click', ()  => {
        formCalculatorModal.style.display = 'none';
        formCalculator.reset();
        document.getElementById('totalCost').textContent = "₱0.00";
    });

    document.addEventListener('click', (event) => {
        if (event.target == formCalculatorModal) {
            formCalculatorModal.style.display = 'none'; 
            formCalculator.reset();
            document.getElementById('totalCost').textContent = "₱0.00";
        }
    });

    // confirm button
    document.getElementById('formCalculator').addEventListener('submit', () => {
        if (totalCost == 0) return;
    });
});