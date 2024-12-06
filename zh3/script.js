document.getElementById('log-form').addEventListener('submit', function (e) {
    const temp = document.getElementById('temperature').value;
    if (temp < -10 || temp > 50) {
        e.preventDefault();
        alert('Érvénytelen hőmérséklet! (-10°C és 50°C között kell lennie)');
    }
});
