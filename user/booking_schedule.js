document.addEventListener('DOMContentLoaded', function () {
    const fullPaymentButton = document.querySelectorAll('.full-payment');
    const partialPaymentButton = document.querySelectorAll('.partial-payment');

    fullPaymentButton.forEach(button => {
        button.addEventListener('click', function () {
            const bookingID = this.getAttribute('data-id');
            const totalCost = this.getAttribute('data-cost');

            const total = new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP'
            }).format(totalCost);

            document.querySelector('.amount').textContent = total;
        });
    });
    partialPaymentButton.forEach(button => {
        button.addEventListener('click', function () {
            const bookingID = this.getAttribute('data-id');
            const totalCost = this.getAttribute('data-cost');

            const total = new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP'
            }).format(totalCost / 2);

            document.querySelector('.amount').textContent = total;
        });
    });

    const totalCosts = Array.from(document.querySelectorAll('.total-cost')).map(cost => cost.textContent);

    console.log(totalCosts[0].textContent)
    
    document.querySelectorAll('.total-cost').forEach((cost, i) => {
        const formattedCost = new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP'
        }).format(totalCosts[i]);

        cost.textContent = formattedCost;
        console.log(cost)
    });
});