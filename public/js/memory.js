let flippedCards = [];
let matchedCount = 0;
let totalPairs = 15;
let timer = 180;
let timerInterval;

const cards = document.querySelectorAll('.card');
const timerElement = document.getElementById('timer');
const message = document.getElementById('message');

function startTimer() {
    timerInterval = setInterval(() => {
        timer--;
        timerElement.textContent = timer;

        if (timer <= 0) {
            clearInterval(timerInterval);
            message.textContent = "GAME OVER (╯°□°）╯︵ ┻━┻";
            disableAll();
        }
    }, 1000);
}

function disableAll() {
    cards.forEach(card => card.style.pointerEvents = 'none');
}

cards.forEach(card => {
    card.addEventListener('click', () => {
        if (card.classList.contains('flipped') || card.classList.contains('matched') || flippedCards.length === 2) return;

        card.classList.add('flipped');
        flippedCards.push(card);

        if (flippedCards.length === 2) {
            const [card1, card2] = flippedCards;
            if (card1.dataset.flag === card2.dataset.flag) {
                setTimeout(() => {
                    card1.classList.add('matched');
                    card2.classList.add('matched');
                    flippedCards = [];
                    matchedCount++;
                    if (matchedCount === totalPairs) {
                        clearInterval(timerInterval);
                        message.textContent = "Congrats, you won! (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧";
                        disableAll();
                    }
                }, 500);
            } else {
                setTimeout(() => {
                    card1.classList.remove('flipped');
                    card2.classList.remove('flipped');
                    flippedCards = [];
                }, 1000);
            }
        }
    });
});

window.onload = startTimer;