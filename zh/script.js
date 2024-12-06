document.addEventListener('DOMContentLoaded', () => {
    const scoreInput = document.getElementById('score');
    const indicator = document.createElement('span');
    indicator.textContent = '⭐';
    indicator.style.marginLeft = '10px';
    scoreInput.parentElement.appendChild(indicator);

    scoreInput.addEventListener('input', () => {
        const score = parseInt(scoreInput.value, 10);
        if (score >= 1 && score <= 5) {
            indicator.textContent = '⭐'.repeat(score);
        } else {
            indicator.textContent = '';
        }
    });
});
