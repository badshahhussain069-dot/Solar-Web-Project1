
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Energy Generated (kWh)',
            data: [12, 19, 10, 15, 22, 17, 25]
        }]
    }
});


